<?php
namespace GobiernoAmigoMovil\Http\Controllers\Externo;

use GobiernoAmigoMovil\Http\Controllers\Controller;
use GobiernoAmigoMovil\Service\Impl\ExternalServiceImpl;
use GobiernoAmigoMovil\Model\TipoDTO;
use GobiernoAmigoMovil\Model\CategoriaDTO;
use Illuminate\Support\Facades\Log;
use Exception;

class ExternoController extends Controller
{
    
  
  
    
    public function getTocken(){
       // try{            
        //$externalServiceImpl=new ExternalServiceImpl();
        //$tocken=$externalServiceImpl->getTocken(); 
       // return response()->json($tocken);
       // } catch (Exception $e) {
        //    Log::info('Error getTocken: ',[$e]);
            return response()->json(collect([]));
       // }
    }
    
    
    public function updateDenunciaRest(){
        $externalServiceImpl=new ExternalServiceImpl();        
       // $denuncia=$externalServiceImpl->createDenunciaRest()->first();       
        
        $denuncia=$externalServiceImpl->createDenunciaRest();    
        Log::info('denuncia rest external result', [$denuncia]);
         
        return response()->json($denuncia);
    }
    
    
    
    
  
    
    
}

