<?php
namespace GobiernoAmigoMovil\Repository\Impl;


use GobiernoAmigoMovil\Repository\UsuarioRepository;
use OkayBueno\Repositories\src\EloquentRepository;
use GobiernoAmigoMovil\Model\UsuarioDTO;


class UsuarioRepositoryImpl extends EloquentRepository implements UsuarioRepository 
{
    
    public function __construct( UsuarioDTO $tipoDTO ) {
        parent::__construct( $tipoDTO );
    }
    
    // methods that your repository should implement...
}

