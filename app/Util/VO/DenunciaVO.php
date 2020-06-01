<?php

namespace GobiernoAmigoMovil\Util\VO;
use GobiernoAmigoMovil\Model\UsuarioDTO;
use GobiernoAmigoMovil\Model\DenunciaDTO;


class DenunciaVO 
{
    protected $usuarioDTO;
    protected $denunciaDTO;
    protected $direccion="";
    protected $nombreFoto="";
    protected $tipoForRest="";//referencia a la base de datos
    protected $categoriaForRest="";
    protected $departamentoForRest="";
    protected $referenciadDepartamentoForRest="";
    /**
     * @return string
     */
    public function getDepartamentoForRest()
    {
        return $this->departamentoForRest;
    }

    /**
     * @return string
     */
    public function getReferenciadDepartamentoForRest()
    {
        return $this->referenciadDepartamentoForRest;
    }

    /**
     * @param string $departamentoForRest
     */
    public function setDepartamentoForRest($departamentoForRest)
    {
        $this->departamentoForRest = $departamentoForRest;
    }

    /**
     * @param string $referenciadDepartamentoForRest
     */
    public function setReferenciadDepartamentoForRest($referenciadDepartamentoForRest)
    {
        $this->referenciadDepartamentoForRest = $referenciadDepartamentoForRest;
    }

    /**
     * @return string
     */
    public function getTipoForRest()
    {
        return $this->tipoForRest;
    }

    /**
     * @param string $tipoForRest
     */
    public function setTipoForRest($tipoForRest)
    {
        $this->tipoForRest = $tipoForRest;
    }

    /**
     * @return string
     */
    public function getCategoriaForRest()
    {
        return $this->categoriaForRest;
    }

    /**
     * @param string $categoriaForRest
     */
    public function setCategoriaForRest($categoriaForRest)
    {
        $this->categoriaForRest = $categoriaForRest;
    }

    /**
     * @return string
     */
    public function getNombreFoto()
    {
        return $this->nombreFoto;
    }

    /**
     * @param string $nombreFoto
     */
    public function setNombreFoto($nombreFoto)
    {
        $this->nombreFoto = $nombreFoto;
    }

    

    /**
     * @return mixed
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * @param mixed $direccion
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    }

   

    /**
     * @return \GobiernoAmigoMovil\Model\UsuarioDTO
     */
    public function getUsuarioDTO()
    {
        return $this->usuarioDTO;
    }

    /**
     * @return \GobiernoAmigoMovil\Model\DenunciaDTO
     */
    public function getDenunciaDTO()
    {
        return $this->denunciaDTO;
    }

    /**
     * @param \GobiernoAmigoMovil\Model\UsuarioDTO $usuarioDTO
     */
    public function setUsuarioDTO($usuarioDTO)
    {
        $this->usuarioDTO = $usuarioDTO;
    }

    /**
     * @param \GobiernoAmigoMovil\Model\DenunciaDTO $denunciaDTO
     */
    public function setDenunciaDTO($denunciaDTO)
    {
        $this->denunciaDTO = $denunciaDTO;
    }

    public function __construct(UsuarioDTO $usuarioDTO, DenunciaDTO $denunciaDTO) {
        $this->usuarioDTO = $usuarioDTO;
        $this->denunciaDTO=$denunciaDTO;
    }
    
    
    
  
   
    
    
   
}
