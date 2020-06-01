<?php
namespace GobiernoAmigoMovil\Util;


class Excepcion extends \Exception {

    public function __construct($mensaje) {
        $this->message = $mensaje;        
        $this->cod=404;
        parent::__construct();        
    }
    
}

