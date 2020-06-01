<?php
namespace GobiernoAmigoMovil\Service\Impl;
use GobiernoAmigoMovil\Util\DTO\DenunciaExternalSeguimientoDTO;
use GobiernoAmigoMovil\Service\ExternalService;
use GobiernoAmigoMovil\Util\Enum;
use Illuminate\Support\Facades\Log;
use GobiernoAmigoMovil\Util\Excepcion;
use GobiernoAmigoMovil\Util\VO\DenunciaVO;
use GobiernoAmigoMovil\Util\ModelToArray;
use Exception;


class ExternalServiceImpl implements ExternalService
{
   
    protected $url_server;
    public function setServerRest($metodo_rest){
        Log::info('$URL_SERVER_EXTERNAL: ',[Enum::URL_SERVER_EXTERNAL]);
        if(Enum::PORT_SERVER_EXTERNAL==Enum::PORT_DEFAULT)
            $this->url_server=Enum::URL_SERVER_EXTERNAL_80_PORT;
            else
                $this->url_server=Enum::URL_SERVER_EXTERNAL.$metodo_rest; 
    }
    
    public function setServerRes2($metodo_rest, $parametro){
        
        $this->url_server=Enum::URL_SERVER_EXTERNAL.$metodo_rest.$parametro;
    }
    
    public function setServerRest3($metodo_rest){
        Log::info('$URL_SERVER_EXTERNAL: ',[Enum::URL_SERVER_EXTERNAL]);        
            $this->url_server=Enum::URL_MOVIL_EXTERNAL.$metodo_rest;
           
    }
    
    public function setServerRest4($metodo_rest1, $parametro, $metodo_rest2){
        
        $this->url_server=Enum::URL_SERVER_EXTERNAL.$metodo_rest1.$parametro.$metodo_rest2;
    }
    
    public function getTocken(){
       // session(['tocken_rest_external' => str_random(10)]);
        session(['tocken_rest_external'=>""]);
        
        $this->setServerRest(Enum::rest_autencion);
        $client = new \GuzzleHttp\Client();
        
        $dataArray = array(
            'grant_type'    => "password",
            'scope'         => "*",       //set to 'view_process' if not changing the process
            'client_id'     => Enum::client_id,
            'client_secret' => Enum::client_secret,
            'username'      => Enum::user_process_maker,
            'password'      => Enum::pass_process_maker
        );
        Log::info('url_server: ',[$this->url_server]);
        Log::info('dataArray: ',[$dataArray]);       
        $response = $client->post($this->url_server, [ \GuzzleHttp\RequestOptions::JSON => $dataArray ]); 
        $response =$response->getBody()->getContents();
        
        return $response;
    }
    
    
    
    
    
    public function createDenunciaRest1(DenunciaVO $denunciaVO){      
        
        $modelToArray=new ModelToArray($denunciaVO);
        $app_number=null;
        $variables= $modelToArray->getArrayForExternalRest();
        session()->put('tocken_rest_external', "");
        if(empty(session('tocken_rest_external'))){
            $res=$this->getTocken();
            $res = json_decode($res,true);
            session()->put('tocken_rest_external', $res['access_token']);
            Log::info('TockenDef: ',[session('tocken_rest_external')]);
        }else{
            Log::info('TockenDef: ',["tocken no vacio"]);
        }
        $this->setServerRest(Enum::rest_new_denuncia);
        
        
        
        $client = new \GuzzleHttp\Client();
        
        $dataArray = array(
            
            'pro_uid'   => Enum::pro_uid,
            'tas_uid'   => Enum::tas_uid,
            'usr_uid'   => Enum::usr_uid,
            'variables' => $variables
        );
        
        /**
         * crear denuncia
         * 
         */
        $oResponse =$client->request('POST', $this->url_server,
            ['headers'         => ['Authorization' => 'Bearer ' . session('tocken_rest_external')],
                'body' => json_encode($dataArray)
            ]);
        $oResponse =json_decode($oResponse->getBody()->getContents());
        Log::info('createDenunciaRest1:oResponse:Crear Denuncia ',[$oResponse]);
        if ($oResponse!=null && $oResponse->app_uid!=null && $oResponse->app_number!=null) {
            
            $denunciaVO->getDenunciaDTO()->app_uid=$oResponse->app_uid;
            $denunciaVO->getDenunciaDTO()->app_number=$oResponse->app_number;
            $this->setServerRest4(Enum::rest_upload_file1,   $oResponse->app_uid, Enum::rest_upload_file2);
            
            $this->uploadImage($denunciaVO, $denunciaVO->getDenunciaDTO()->urlfoto,   $this->url_server );
            $app_number=$oResponse->app_number;
            Log::info('$oRet111: ',[$oResponse]);
            Log::info('$$oResponse->app_uid: ',[$oResponse->app_uid]);
            $this->setServerRes2(Enum::rest_change_state, $oResponse->app_uid);
            $dataArray = array(
                'status' => 'TO_DO'
            );
          
            $client = new \GuzzleHttp\Client();
            
            Log::info('url: ',[$this->url_server]);
            /**
             * Denuncia a borrador
             *
             */
            $oResponse =$client->request('PUT', $this->url_server,
                ['headers'         => ['Authorization' => 'Bearer ' . session('tocken_rest_external')],
                    'body' => json_encode([
                        'status' => 'TO_DO',
                        'del_index' => 1
                    ])
                ]);
         
            
            $oResponse =$oResponse->getBody()->getContents();
            
            Log::info('createDenunciaRest1:oResponse:Denuncia a borrador ',[$oResponse]);
           
            if ($oResponse == "" && $app_number!=null) {
                
                Log::info(' seguimiento $app_uid:  ',[$app_number]);
                $this->seguimiento( $denunciaVO, $app_number);
                
            }elseif (is_object($oResponse) and isset($oResponse->error)) {
                Log::info('createDenunciaRest1:error:Denuncia a borrador ',[ "Error code: {$oResponse->error->code}\n" .
                "Message: {$oResponse->error->message}\n"]);
            }
            else {
                Log::info('createDenunciaRest1:error:Denuncia a borrador ',["Error code: $oResponse"]);
            }
            
        }
        elseif (is_object($oResponse) and isset($oResponse->error)) {
            Log::info('createDenunciaRest1:error:Crear Denuncia ',["Error code: {$oResponse->error->code}\n" .
            "Message: {$oResponse->error->message}\n"]);
        }
        Log::info('createDenunciaRest1:$oResponse:Crear Denuncia ',[$oResponse]);
        
        return $denunciaVO;
    }
    
    private function seguimiento(DenunciaVO $denunciaVO, $app_number){
        
        $client = new \GuzzleHttp\Client();
        $this->setServerRest3(Enum::rest_seguimiento);
        
       
        $dataArray = array(
            'codtramite' => Enum::codtramite,//paramtro de seguridad del rest
            'usuario' => Enum::usuario,//paramtro de seguridad del rest
            'coddepa' => Enum::coddepa,//paramtro de seguridad del rest
            'codusu' => Enum::codusu,//paramtro de seguridad del rest
            'codlogin' => Enum::codlogin,//paramtro de seguridad del rest            
            'anio' => Enum::ANIO,
            'cedula' => $denunciaVO->getUsuarioDTO()->identificacion,
            'nombre' => $denunciaVO->getUsuarioDTO()->nombre,
            'telefono' => $denunciaVO->getUsuarioDTO()->movil,
            'correo' => $denunciaVO->getUsuarioDTO()->correo,
            'direccion' => $denunciaVO->getDireccion(),
            'caso' => strval($app_number),
            'detalle' =>    $denunciaVO->getTipoForRest()." - ".
                            $denunciaVO->getDenunciaDTO()->tipo_for_rest_external." - ".
                            $denunciaVO->getCategoriaForRest()." - ".
                            $denunciaVO->getDenunciaDTO()->detalle
        );
        
        Log::info('url seguimiento: ',[$this->url_server]);
        Log::info('$$dataArray: ',[json_encode($dataArray)]);
        $ch = curl_init($this->url_server);        
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($dataArray));
        $oRet = json_decode(curl_exec($ch));
        $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);      
        
        Log::info('$response seguimiento $oRet: ',[$oRet]);
        Log::info('$response seguimiento $status: ',[$status]);
        
       
    }
    
    
    private function uploadImage(DenunciaVO $denunciaVO , $path,  $url ){
        //try{
            if (empty(session('tocken_rest_external')) or isset(session('tocken_rest_external')->error))
                die("Error " . session('tocken_rest_external')->error->code .': '. session('tocken_rest_external')->error->message);
            
            $inputDocId = Enum::inp_doc_uid;
            $taskId     = Enum::tas_uid;
            
            
                $filename = $denunciaVO->getNombreFoto();
               
                    
                //rename file from temp name to real name:
               // rename($path, sys_get_temp_dir() .'/'. $filename); //reverse \ for windows systems
                
                $aVars = array(
                    'inp_doc_uid'     => $inputDocId,
                    'tas_uid'         => $taskId,
                    'app_doc_comment' => 'Adjunto App Gobierno Amigo',
                    
                    'form'            => (phpversion() >= "5.5") ? new \CurlFile($path) : '@'.$path
                );
                
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $this->url_server);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . session('tocken_rest_external')));
                curl_setopt($ch, CURLOPT_POSTFIELDS, $aVars);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $oResponse = json_decode(curl_exec($ch));
                Log::info('uploadImage:$error: ',[ curl_error($ch)]);
                $httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                curl_close($ch);
                
                if ($httpStatus == 200) {
                    $caseFileId = $oResponse->app_doc_uid;
                    Log::info('$response $caseFileId: ',[$caseFileId]);
                }
                elseif (is_object($oResponse) and isset($oResponse->error)) {
                    Log::info('$response upload: ',[ "Error code: {$oResponse->error->code}\n" .
                    "Message: {$oResponse->error->message}\n"]);
                }
                else {
                    Log::info('uploadImage:httpStatus ',[ "Error code: $httpStatus"]);
                }
                Log::info('uploadImage:oResponse ',[ $oResponse]);
    //} catch (Exception $e) {
      //  Log::info('Error usuarioByEmail: ',[$e]);
       // return response()->json(collect([]));
   // }
            
    }
    //no usada
    private function seguimiento0(DenunciaVO $denunciaVO, $app_number){
        
        $denunciaExternalSeguimientoDTO= new DenunciaExternalSeguimientoDTO();
        $denunciaExternalSeguimientoDTO->anio='2019';
        $denunciaExternalSeguimientoDTO->cedula=$denunciaVO->getUsuarioDTO()->identificacion;
        $denunciaExternalSeguimientoDTO->nombre=$denunciaVO->getUsuarioDTO()->nombre;
        $denunciaExternalSeguimientoDTO->telefono=$denunciaVO->getUsuarioDTO()->movil;
        $denunciaExternalSeguimientoDTO->correo=$denunciaVO->getUsuarioDTO()->correo;
        $denunciaExternalSeguimientoDTO->direccion="";
        $denunciaExternalSeguimientoDTO->caso=$app_number;
        $denunciaExternalSeguimientoDTO->detalle=$denunciaVO->getUsuarioDTO()->nombre;
        
        $client = new \GuzzleHttp\Client();
        $this->setServerRest3(Enum::rest_seguimiento);
        
        Log::info('url seguimiento: ',[$this->url_server]);
        Log::info('$denunciaExternalSeguimientoDTO: ',[json_encode($denunciaExternalSeguimientoDTO)]);
        
        
        $oResponse =$client->request('POST', $this->url_server,
            ['headers'         => ['Authorization' => 'Bearer ' . session('tocken_rest_external')],
                'body' => json_encode($denunciaExternalSeguimientoDTO)
            ]);
        
        $oResponse =json_decode($oResponse->getBody()->getContents());
        
        Log::info('$response: ',[$oResponse]);
        
        
    }
    
   //funcion opcional para ejecutar rest no usada
    private function pmRestRequest($method, $endpoint, $aVars = null, $accessToken = null) {
        global $pmServer;
        
        if (empty($accessToken) and isset($_COOKIE['access_token']))
            $accessToken = $_COOKIE['access_token'];
            
            if (empty($accessToken)) { //if the access token has expired
                //To check if the PM login session has expired: !isset($_COOKIE['PHPSESSID'])
                header("Location: loginForm.php"); //change to match your login method
                die();
            }
            
            //add beginning / to endpoint if it doesn't exist:
            if (!empty($endpoint) and $endpoint[0] != "/")
                $endpoint = "/" . $endpoint;
                
                $ch = curl_init($pmServer . $endpoint);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization: Bearer " . $accessToken));
                curl_setopt($ch, CURLOPT_TIMEOUT, 30);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $method = strtoupper($method);
                
                switch ($method) {
                    case "GET":
                        break;
                    case "DELETE":
                        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
                        break;
                    case "PUT":
                        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
                    case "POST":
                        curl_setopt($ch, CURLOPT_POST, 1);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($aVars));
                        break;
                    default:
                        throw new Excepcion("Error: Invalid HTTP method".$method."-".$endpoint);
                        return null;
                }
                
              //  $oRet = new StdClass;
                $response = json_decode(curl_exec($ch));
                $status   = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                curl_close($ch);
                
                if ($status == 401) { //if session has expired or bad login:
                    header("Location: loginForm.php"); //change to match your login method
                    die();
                }
                elseif ($status != 200 and $status != 201) { //if error
                    if ($response and isset($response->error)) {
                        print "Error in $pmServer:\nCode: {$response->error->code}\n" .
                        "Message: {$response->error->message}\n";
                    }
                    else {
                        print "Error: HTTP status code: $status\n";
                    }
                }
                
                return $response;
    }
}

