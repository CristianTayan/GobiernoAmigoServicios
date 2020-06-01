<?php
namespace GobiernoAmigoMovil\Service;


use GobiernoAmigoMovil\Util\VO\DenunciaVO;

interface ExternalService
{
    public function createDenunciaRest1(DenunciaVO $denunciaVO);
    
}

