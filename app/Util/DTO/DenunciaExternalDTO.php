<?php

namespace GobiernoAmigoMovil\Util\DTO;


class DenunciaExternalDTO 
{
    protected $regCedula='';
    protected $regCedula_label='';
    protected $regDependencia='';
    protected $regDetalle='';
    protected $regMail='';
    protected $regNombre='';
    protected $regServidor='';
    protected $regTelefono='';
    protected $regTipo='';
    protected $regTipoEspecifico='';
    /**
     * @return string
     */
    public function getRegCedula()
    {
        return $this->regCedula;
    }

    /**
     * @return string
     */
    public function getRegDependencia()
    {
        return $this->regDependencia;
    }

    /**
     * @return string
     */
    public function getRegDetalle()
    {
        return $this->regDetalle;
    }

    /**
     * @return string
     */
    public function getRegMail()
    {
        return $this->regMail;
    }

    /**
     * @return string
     */
    public function getRegNombre()
    {
        return $this->regNombre;
    }

    /**
     * @return string
     */
    public function getRegServidor()
    {
        return $this->regServidor;
    }

    /**
     * @return string
     */
    public function getRegTelefono()
    {
        return $this->regTelefono;
    }

    /**
     * @return string
     */
    public function getRegTipo()
    {
        return $this->regTipo;
    }

    /**
     * @return string
     */
    public function getRegTipoEspecifico()
    {
        return $this->regTipoEspecifico;
    }

    /**
     * @param string $regCedula
     */
    public function setRegCedula($regCedula)
    {
        $this->regCedula = $regCedula;
    }

    /**
     * @param string $regDependencia
     */
    public function setRegDependencia($regDependencia)
    {
        $this->regDependencia = $regDependencia;
    }

    /**
     * @param string $regDetalle
     */
    public function setRegDetalle($regDetalle)
    {
        $this->regDetalle = $regDetalle;
    }

    /**
     * @param string $regMail
     */
    public function setRegMail($regMail)
    {
        $this->regMail = $regMail;
    }

    /**
     * @param string $regNombre
     */
    public function setRegNombre($regNombre)
    {
        $this->regNombre = $regNombre;
    }

    /**
     * @param string $regServidor
     */
    public function setRegServidor($regServidor)
    {
        $this->regServidor = $regServidor;
    }

    /**
     * @param string $regTelefono
     */
    public function setRegTelefono($regTelefono)
    {
        $this->regTelefono = $regTelefono;
    }

    /**
     * @param string $regTipo
     */
    public function setRegTipo($regTipo)
    {
        $this->regTipo = $regTipo;
    }

    /**
     * @param string $regTipoEspecifico
     */
    public function setRegTipoEspecifico($regTipoEspecifico)
    {
        $this->regTipoEspecifico = $regTipoEspecifico;
    }

    
    

    
    
    
}
