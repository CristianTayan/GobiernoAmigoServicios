<?php
namespace GobiernoAmigoMovil\Service\Impl;

use Carbon\Carbon;
use GobiernoAmigoMovil\Service\GobiernoAmigoMovilService;
use GobiernoAmigoMovil\Util\VO\DenunciaVO;
use GobiernoAmigoMovil\Model\CategoriaDTO;
use GobiernoAmigoMovil\Model\LogDTO;
use GobiernoAmigoMovil\Model\TipoDTO;
use GobiernoAmigoMovil\Model\UsuarioDTO;
use GobiernoAmigoMovil\Model\UsuarioDenunciaReporteViewDTO;
use GobiernoAmigoMovil\Repository\Impl\UsuarioRepositoryImpl;
use GobiernoAmigoMovil\DAO\Impl\UsuarioFilterByUsuarioImpl;
use GobiernoAmigoMovil\DAO\Impl\UsuarioFilterByEmailImpl;
use GobiernoAmigoMovil\DAO\Impl\UsuarioFilterByMovilImpl;
use GobiernoAmigoMovil\DAO\Impl\UsuarioDenunciaReporteViewFilterByCorreoImpl;
use GobiernoAmigoMovil\Repository\Impl\DenunciaRepository;
use GobiernoAmigoMovil\Repository\Impl\LogRepository;

use GobiernoAmigoMovil\Repository\Impl\DenunciaViewRepository;
use GobiernoAmigoMovil\Repository\Impl\UsuarioDenunciaReporteViewRepository;
use GobiernoAmigoMovil\Repository\Impl\TipoRepositoryImpl;
use GobiernoAmigoMovil\Repository\Impl\CategoriaRepositoryImpl;
use GobiernoAmigoMovil\Model\DenunciaViewDTO;
use GobiernoAmigoMovil\DAO\Impl\DenunciaViewFilterByIdUsuarioImpl;
use GobiernoAmigoMovil\DAO\Impl\UsuarioFilterByIdFacebookImpl;
use GobiernoAmigoMovil\DAO\Impl\UsuarioFilterByIdentificacionImpl;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

use Exception;

class GobiernoAmigoMovilServiceImpl implements  GobiernoAmigoMovilService
{
    private $logDTO;
    
    
    
    /**
     * @param \GobiernoAmigoMovil\Model\LogDTO $logDTO
     */
    public function setLogDTO($logDTO)
    {
        Log::info('qqqqqq: ',[$logDTO]);
        $this->logDTO = $logDTO;
        Log::info('this->logDTO: ',["antes de this qqq"]);
        Log::info('this->logDTO: ',[$this->logDTO]);
    }

    /**
     * @return mixed
     */
    public function getLogDTO()
    {
        return $this->logDTO=new LogDTO();
    }

    
    public function readUsuarioDTOByUsuario($usuario){
        $usuarioRepositoryImpl = new UsuarioRepositoryImpl(new UsuarioDTO());
        $usuarioFilterByUsuario = new UsuarioFilterByUsuarioImpl( $usuario );
        
        $usuarios= $usuarioRepositoryImpl
        ->addCriteria($usuarioFilterByUsuario )
        ->findAllBy();
        if($this->logDTO!=null){
            $this->logDTO->tabla_afectada="gob_usuarios";
            $this->logDTO->fecha=Carbon::now('America/Guayaquil');
            $this->createOrUpdateLog($this->logDTO);
        }
        
        if($usuarios!=null) return $usuarios;
        else
            return  collect([]);
    }
    
    public function readUsuarioDTOByEmail($email){
        $usuarioRepositoryImpl = new UsuarioRepositoryImpl(new UsuarioDTO());
        //   $filter =[ 'art_codigo', '==', $articuloViewDTO ];
        
        
        $usuarioFilterByEmailImpl = new UsuarioFilterByEmailImpl( $email );
        
        $usuarios= $usuarioRepositoryImpl
        ->addCriteria($usuarioFilterByEmailImpl )
        ->findAllBy();
        if($this->logDTO!=null){
            $this->logDTO->tabla_afectada="gob_usuarios";
            $this->logDTO->fecha=Carbon::now('America/Guayaquil');
            $this->createOrUpdateLog($this->logDTO);
        }
        
        
        if($usuarios!=null) return $usuarios;
        else
            return  collect([]);
    }
    
    
    public function readUsuarioDTOByIdentificacion($identificacon){
        $usuarioRepositoryImpl = new UsuarioRepositoryImpl(new UsuarioDTO());
        
        
        $usuarioFilterByIdentificacionImpl = new UsuarioFilterByIdentificacionImpl( $identificacon );
        
        $usuarios= $usuarioRepositoryImpl
        ->addCriteria($usuarioFilterByIdentificacionImpl )
        ->findAllBy();
        
        
        if($usuarios!=null) return $usuarios;
        else
            return  collect([]);
    }
    
    public function readDenunciaViewDTOByUsuarioDenuncia($idUsuario){
        $denunciaViewRepositoryImpl = new DenunciaViewRepository(new DenunciaViewDTO());
        //   $filter =[ 'art_codigo', '==', $articuloViewDTO ];
        
        
        $denunciaViewFilterByIdUsuarioImpl = new DenunciaViewFilterByIdUsuarioImpl( $idUsuario );
        
        $denunciaView= $denunciaViewRepositoryImpl
        ->addCriteria($denunciaViewFilterByIdUsuarioImpl )
        ->findAllBy();
        
        
        if($denunciaView!=null){             
            return $denunciaView;
        }
        else
            return  collect([]);
    }
    
    public function readUsuarioDenunciaReporteViewDTOByCorreo($correo){
        $usuarioDenunciaReporteViewRepositoryImpl = new UsuarioDenunciaReporteViewRepository(new UsuarioDenunciaReporteViewDTO());
        //   $filter =[ 'art_codigo', '==', $articuloViewDTO ];
        
        
        $usuarioDenunciaReporteViewFilterByCorreoImpl = new UsuarioDenunciaReporteViewFilterByCorreoImpl( $correo );
        
        $usuarioDenunciaReporteView= $usuarioDenunciaReporteViewRepositoryImpl
        ->addCriteria($usuarioDenunciaReporteViewFilterByCorreoImpl )
        ->findAllBy();
        
        
        if($usuarioDenunciaReporteView!=null) return $usuarioDenunciaReporteView;
        else
            return  collect([]);
    }
    
    public function readUsuarioDTOByMovil($movil){
        $usuarioRepositoryImpl = new UsuarioRepositoryImpl(new UsuarioDTO());
        
        
        
        $usuarioFilterByMovilImpl = new UsuarioFilterByMovilImpl( $movil );
        
        $usuarios= $usuarioRepositoryImpl
        ->addCriteria($usuarioFilterByMovilImpl )
        ->findAllBy();
        
        
        if($usuarios!=null) return $usuarios;
        else
            return  collect([]);
    }
    
    public function readUsuarioDTOByIdFacebook($idfacebook){
        $usuarioRepositoryImpl = new UsuarioRepositoryImpl(new UsuarioDTO());
        //   $filter =[ 'art_codigo', '==', $articuloViewDTO ];
        
        
        $usuarioFilterByIdFacebookImpl = new UsuarioFilterByIdFacebookImpl($idfacebook );
        
        $usuarios= $usuarioRepositoryImpl
        ->addCriteria($usuarioFilterByIdFacebookImpl )
        ->findAllBy();
        
        
        if($usuarios!=null) return $usuarios;
        else
            return  collect([]);
    }
    
    
    
    public function readTipo(TipoDTO $tipoDTO){
        $resquest=new TipoRepositoryImpl($tipoDTO);
        $datos=$resquest->findAll();
        if($datos!=null){
            return $datos;
        }        
        return  collect([]);
        
    }
    
    public function readCategoria(CategoriaDTO $categoriaDTO){
        $resquest=new CategoriaRepositoryImpl($categoriaDTO);
        $datos=$resquest->findAll();
        if($datos!=null){
            return $datos;
        }
        return  collect([]);
        
    }
    
    
    public function createDenuncia(DenunciaVO $denunciaVO){
        
        
        
        $usuarioDTO=$this->readUsuarioDTOByIdentificacion($denunciaVO->getUsuarioDTO()->identificacion)->first();
        $denunciaVO->setUsuarioDTO($usuarioDTO);        
        
        
        $externalServiceImpl=new ExternalServiceImpl();
        $denunciaVO=$externalServiceImpl->createDenunciaRest1($denunciaVO);
        
        $res=false;
        if($denunciaVO!=null && $denunciaVO->getDenunciaDTO()!=null 
            &&  $denunciaVO->getDenunciaDTO()->app_uid &&  $denunciaVO->getDenunciaDTO()->app_number){
                Log::info('respuesta createDenuncia:createDenunciaRest1 ',[$denunciaVO]);
            $denunciaRepository = new DenunciaRepository($denunciaVO->getDenunciaDTO());
            
            $denuncia=$denunciaRepository->create($denunciaVO->getDenunciaDTO()->attributesToArray());
            if($denuncia!=null){
                $res=true;
            }
            
        }else 
            $res=false;
        
            Log::info('createDenuncia:respueta: ',[$res]);
        
            return $res;
       
        
        
       // $denunciaCollection=collect([]);
        //if($denuncia!=null){
      //      return $denunciaCollection->push($denuncia);
        //}
        
   
        //return  collect([]);
    }
    
    public function createOrUpdateUsuario(UsuarioDTO $usuarioDTO){
        $usuarioDTO->acceso=$this->encriptPassword($usuarioDTO->acceso);
        $usuarioRepository = new UsuarioRepositoryImpl($usuarioDTO );
        $usuario=null;
        if($usuarioDTO->idusuario!=null){
            $usuario=$usuarioRepository->updateBy($usuarioDTO->attributesToArray(),$usuarioDTO->idusuario, 'idusuario');
            
        }else{   
            
            $usuario=$usuarioRepository->create($usuarioDTO->attributesToArray());
        }
       
        
        $usuarioCollection=collect([]);
        if($usuario!=null){
            return $usuarioCollection->push($usuario);
        }
        
        return  collect([]);
    }
    
    public function createOrUpdateLog(LogDTO $logDTO){
        $logCollection=collect([]);
        try{
            $logRepository = new LogRepository($logDTO );
            $log=null;
            if($logDTO->log_codigo==null){
                $log=$logRepository->create($logDTO->attributesToArray());
            }else{
                $log=$logRepository->updateBy($logDTO->attributesToArray(),$logDTO->idlog, 'idlog');
                
            }
            
            
            if($log!=null){
                return $logCollection->push($log);
            }
        } catch (\Exception $exception) {
            Log::info('Error en AdministracionService createOrUpdateLog', [$exception->getTraceAsString()]);
        }
        
        return  collect([]);
    }
    
    private function encriptPassword($pass){
        if($pass!=null){
            $pass = Hash::make($pass);
        }
        return $pass;
    }
    
   
}

