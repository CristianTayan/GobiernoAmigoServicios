<?php
namespace GobiernoAmigoMovil\Http\Controllers\Tipo;

use GobiernoAmigoMovil\Http\Controllers\Controller;
use GobiernoAmigoMovil\Service\Impl\GobiernoAmigoMovilServiceImpl;
use GobiernoAmigoMovil\Model\TipoDTO;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use Carbon\Carbon;
use GobiernoAmigoMovil\Model\DenunciaDTO;

class TipoController extends Controller
{
    
  
  
    
    public function getTipos(){
        $tipoDTO=new TipoDTO();        
        $gobiernoAmigoMovilServiceImpl=new GobiernoAmigoMovilServiceImpl();
        $tipos=$gobiernoAmigoMovilServiceImpl->readTipo($tipoDTO);        
        return response()->json($tipos);
    }
    
    
  
    
    
}

