<?php
namespace GobiernoAmigoMovil\Repository\Impl;


use GobiernoAmigoMovil\Repository\CategoriaRepository;
use OkayBueno\Repositories\src\EloquentRepository;
use GobiernoAmigoMovil\Model\CategoriaDTO;
use GobiernoAmigoMovil\Model\UsuarioDTO;


class CategoriaRepositoryImpl extends EloquentRepository implements CategoriaRepository 
{
    
    public function __construct( CategoriaDTO $categoriaDTO ) {
        parent::__construct( $categoriaDTO );
    }
    
    // methods that your repository should implement...
}

