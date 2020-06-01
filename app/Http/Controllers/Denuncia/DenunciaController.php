<?php
namespace GobiernoAmigoMovil\Http\Controllers\Denuncia;


use GobiernoAmigoMovil\Http\Controllers\Controller;
use GobiernoAmigoMovil\Service\Impl\GobiernoAmigoMovilServiceImpl;
use GobiernoAmigoMovil\Model\DenunciaDTO;
use GobiernoAmigoMovil\Model\UsuarioDTO;
use GobiernoAmigoMovil\Util\VO\DenunciaVO;



use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use DateTime;
use Exception;

use GobiernoAmigoMovil\Util\Excepcion;



class DenunciaController extends Controller
{
    
    public function create(Request $request){
        
        
        
        $file = base64_decode($request->url_foto_denuncia);
        $folderName = '/denuncias/';
        $safeName ="denuncia-".time().".jpg";
        $destinationPath = public_path() . $folderName;
        $path=public_path().'/denuncias/'.$safeName;
        $resultUplodad=file_put_contents(public_path().'/denuncias/'.$safeName, $file);
        
        if ($resultUplodad){
            Log::info('denuncia file $resultUplodad', [$resultUplodad]);
           
            
            $usuarioDTO=new UsuarioDTO();
            $usuarioDTO->idusuario=$request->id_usuario_denuncia;
            $usuarioDTO->identificacion=$request->identificacion_usuario_denuncia;
            
            
            $denuncia=new DenunciaDTO();
            
            $denuncia->idcategoria=$request->id_categoria;
            $denuncia->idtipo=$request->id_tipo;
            $denuncia->idusuario=$request->id_usuario_denuncia;
            $denuncia->fecha=Carbon::now('America/Guayaquil');
            $denuncia->detalle=$request->detalle_denuncia;
            $denuncia->estado=$request->estado_denuncia;
            $denuncia->urlfoto=$path;
            $denuncia->coordenadax=$request->coordenada_x_denuncia;
            $denuncia->coordenaday=$request->coordenada_y_denuncia;
            $denuncia->idusuario_asigna=$request->id_usuario_asigna_denuncia;
            $denuncia->fecha_asigna=$request->fecha_asigna_denuncia;
            $denuncia->fecha_finaliza=$request->fecha_finaliza_denuncia;
            $denuncia->tipo_for_rest_external=$request->tipo_for_rest_external_denuncia;
            $denuncia->sesion=$request->sesion_denuncia;
            $denuncia->creacion=Carbon::now('America/Guayaquil');
            
            
            
            $gobiernoAmigoMovilServiceImpl=new GobiernoAmigoMovilServiceImpl();
            
            $denunciaVO=new DenunciaVO($usuarioDTO, $denuncia);
            $denunciaVO->setNombreFoto($safeName);
            $denunciaVO->setTipoForRest($request->tipoForRest);
            $denunciaVO->setCategoriaForRest($request->categoriaForRest);
            $denunciaVO->setDepartamentoForRest($request->departamentoForRest);
            $denunciaVO->setReferenciadDepartamentoForRest($request->referenciadDepartamentoForRest);
            
            
            
            $usuarios=$gobiernoAmigoMovilServiceImpl->createDenuncia($denunciaVO);
            
            
            
            Log::info('denuncia APP', [$usuarios]);
            
            
            return response()->json(json_encode($usuarios));
        }
        else
            throw new Excepcion('No subió la foto');
            
            
    }
  
    
    public function getDenuncias(Request $request){
        try{
            
            Log::info('$denunciasView hhhhh: ',[$request->id_usuario_denuncia]);
          
            $gobiernoAmigoMovilServiceImpl=new GobiernoAmigoMovilServiceImpl();
            $denunciasView=$gobiernoAmigoMovilServiceImpl->readDenunciaViewDTOByUsuarioDenuncia($request->id_usuario_denuncia);        
            $denunciasView1=collect([]);
            if(!empty($denunciasView)){
                $denunciasView=$denunciasView->sortBy('id_denuncia',true);
                $denunciasView= $denunciasView->unique('id_denuncia');
                foreach($denunciasView as $denunciaView){
                    if($denunciaView->fecha_creacion_denuncia !=null){  
                        $date = DateTime::createFromFormat('Y-m-d', $denunciaView->fecha_creacion_denuncia);
                        $createdAt = Carbon::parse($denunciaView->fecha_creacion_denuncia);
                        $denunciaView->fecha_creacion_denuncia_string=$createdAt->format('Y-m-d');                        
                        $denunciaView->fecha_creacion_denuncia=null;
                    }
                    if($denunciaView->fecha_denuncia !=null){
                        $date = DateTime::createFromFormat('Y-m-d', $denunciaView->fecha_denuncia);
                        $createdAt = Carbon::parse($denunciaView->fecha_creacion_denuncia);
                        $denunciaView->fecha_denuncia_string=$createdAt->format('Y-m-d');
                         $denunciaView->fecha_denuncia=null;
                         
                    }
                }
                foreach ($denunciasView as $item) {                   
                    $denunciasView1->push($item);
                }
                Log::info('$denunciasView ultimos: ',[response()->json($denunciasView1)]);
            }
            
            return response()->json($denunciasView1);
       } catch (Exception $e) {
            Log::info('Error getDenuncias: ',[$e]);
            throw new Excepcion('Denucias no obtenidas intente mas tarde');
        }
        
    }
    
    
    
    
    
    public function getDenunciasCount(Request $request){
        try{
            
            Log::info('$denunciasView hhhhh: ',[$request->id_usuario_denuncia]);
            
            $gobiernoAmigoMovilServiceImpl=new GobiernoAmigoMovilServiceImpl();
            $denunciasView=$gobiernoAmigoMovilServiceImpl->readDenunciaViewDTOByUsuarioDenuncia($request->id_usuario_denuncia);
            Log::info('$denunciasView : ',[$denunciasView]);
            $counDenunciasView=0;
            if(!empty($denunciasView)){
                $denunciasView=$denunciasView->sortBy('id_denuncia',true);
                $denunciasView= $denunciasView->unique('id_denuncia');
                $counDenunciasView=$denunciasView->count();
            }
            return response()->json($counDenunciasView);
        } catch (Exception $e) {
            Log::info('Error getDenunciasCount: ',[$e]);
            throw new Excepcion('Denucias no obtenidas intente mas tarde');
        }
        
    }
    
    public function readReporteUsuarioDenuncias(Request $request){
        try{
            
            Log::info('correo_usuario: ',[$request->correo_usuario]);
            
            $gobiernoAmigoMovilServiceImpl=new GobiernoAmigoMovilServiceImpl();
            $usuarioDenunciasReporteView=$gobiernoAmigoMovilServiceImpl->readUsuarioDenunciaReporteViewDTOByCorreo($request->correo_usuario);
            Log::info('$$usuarioDenunciasReporteView : ',[$usuarioDenunciasReporteView]);
            //if(!empty($usuarioDenunciasReporteView)){
            //    return response()->json($usuarioDenunciasReporteView);
           // }
            return response()->json($usuarioDenunciasReporteView);
        } catch (Exception $e) {
            Log::info('Error readReporteUsuarioDenuncias: ',[$e]);
            throw new Excepcion('Reporte no obtenidos no obtenidas intente mas tarde');
        }
        
    }
    
    
}

