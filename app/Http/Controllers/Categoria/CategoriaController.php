<?php
namespace GobiernoAmigoMovil\Http\Controllers\Categoria;

use GobiernoAmigoMovil\Http\Controllers\Controller;
use GobiernoAmigoMovil\Service\Impl\GobiernoAmigoMovilServiceImpl;
use GobiernoAmigoMovil\Model\TipoDTO;
use GobiernoAmigoMovil\Model\CategoriaDTO;
use Illuminate\Support\Facades\Log;
use GobiernoAmigoMovil\Util\Excepcion;
class CategoriaController extends Controller
{
    
  
  
    
    public function getCategorias(){       
        $categoriaDTO=new CategoriaDTO();        
        $gobiernoAmigoMovilServiceImpl=new GobiernoAmigoMovilServiceImpl();
        
        $categorias=$gobiernoAmigoMovilServiceImpl->readCategoria($categoriaDTO); 
        if($categorias==null){
            throw new Excepcion('Error al Obtener Catálogos');
        }
        return response()->json($categorias);
    }
    
    
  
    
    
}

