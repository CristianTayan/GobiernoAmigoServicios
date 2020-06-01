<?php
namespace GobiernoAmigoMovil\Repository\Impl;


use GobiernoAmigoMovil\Repository\TipoRepository;
use OkayBueno\Repositories\src\EloquentRepository;
use GobiernoAmigoMovil\Model\UsuarioDTO;
use GobiernoAmigoMovil\Model\TipoDTO;


class TipoRepositoryImpl extends EloquentRepository implements TipoRepository 
{
    
    public function __construct( TipoDTO $tipoDTO ) {
        parent::__construct( $tipoDTO );
    }
    
    // methods that your repository should implement...
}

