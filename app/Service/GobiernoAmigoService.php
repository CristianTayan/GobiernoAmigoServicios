<?php
namespace GobiernoAmigoMovil\Service;

use GobiernoAmigoMovil\Model\CategoriaDTO;
use GobiernoAmigoMovil\Model\DenunciaDTO;
use GobiernoAmigoMovil\Model\LogDTO;
use GobiernoAmigoMovil\Model\TipoDTO;
use GobiernoAmigoMovil\Model\UsuarioDTO;
use GobiernoAmigoMovil\Util\VO\DenunciaVO;

interface GobiernoAmigoMovilService
{
    public function readUsuarioDTOByUsuario($usuario);
    public function readUsuarioDTOByIdentificacion($usuario);
    public function readUsuarioDTOByEmail($usuario);
    public function readUsuarioDTOByMovil($usuario);
    public function readUsuarioDTOByIdFacebook($idfacebook);
    public function readDenunciaViewDTOByUsuarioDenuncia($idUsuario);    
    public function readUsuarioDenunciaReporteViewDTOByCorreo($correo);    
    public function readTipo(TipoDTO $tipoDTO);
    public function readCategoria(CategoriaDTO $categoriaDTO);
    public function createOrUpdateUsuario(UsuarioDTO $usuarioDTO);
    public function createDenuncia(DenunciaVO $denunciaVO);
    public function createOrUpdateLog(LogDTO $logDTO);
    
    
    
}

