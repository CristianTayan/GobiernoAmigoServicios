<?php
namespace GobiernoAmigoMovil\Util;

use GobiernoAmigoMovil\Util\VO\DenunciaVO;
use Illuminate\Support\Facades\Log;


class ModelToArray {
    
    protected $denunciaVO;
    
    public function __construct(DenunciaVO $denunciaVO) {
        
        $this->denunciaVO=$denunciaVO;
    }
    
    /**
     * @return mixed
     */
    public function getDenunciaVO()
    {
        return $this->denunciaVO;
    }

    /**
     * @param mixed $denunciaVO
     */
    public function setDenunciaVO($denunciaVO)
    {
        $this->denunciaVO = $denunciaVO;
    }

   
    
    

    
    public function getArrayForExternalRest() {
        $array = array(array(
            'regUsudesti'   => Enum::regUsudesti,
            'regUsulogin'   => Enum::regUsulogin,    
            'idTramite'   => Enum::idTramite,    
            'regCedula'   => $this->denunciaVO->getUsuarioDTO()->identificacion,
            'regCedula_label'   => $this->denunciaVO->getUsuarioDTO()->identificacion,
            'regNombre'   => $this->denunciaVO->getUsuarioDTO()->nombre,
            'regNombre_label'   => $this->denunciaVO->getUsuarioDTO()->nombre,
            'regMail'   => $this->denunciaVO->getUsuarioDTO()->correo,
            'regMail_label'   => $this->denunciaVO->getUsuarioDTO()->correo,
            'regTelefono'   => $this->denunciaVO->getUsuarioDTO()->movil,
            'regTelefono_label'   => $this->denunciaVO->getUsuarioDTO()->movil,
            'regTipo'   => $this->denunciaVO->getDenunciaDTO()->tipo_for_rest_external,
            'regTipo_label'   => $this->denunciaVO->getDenunciaDTO()->tipo_for_rest_external,
            'regTipoEspecifico'   => $this->denunciaVO->getReferenciadDepartamentoForRest(),
            'regTipoEspecifico_label'   => $this->denunciaVO->getDepartamentoForRest(),           
            'regDetalle'   => $this->denunciaVO->getDenunciaDTO()->detalle,
            'regDetalle_label'   => $this->denunciaVO->getDenunciaDTO()->detalle,
        ));
        
        Log::info('getArrayForExternalRest return: ',[$array]);
        return $array;
    }
    
    
    
}
