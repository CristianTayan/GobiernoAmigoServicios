<?php
namespace GobiernoAmigoMovil\Repository\Impl;

use GobiernoAmigoMovil\Model\UsuarioDenunciaReporteViewDTO;
use GobiernoAmigoMovil\Repository\UsuarioDenunciaReporteViewRepositoryInterface;
use OkayBueno\Repositories\src\EloquentRepository;

class UsuarioDenunciaReporteViewRepository extends EloquentRepository implements UsuarioDenunciaReporteViewRepositoryInterface  {
    
    public function __construct( UsuarioDenunciaReporteViewDTO $usuarioUsuarioDenunciaReporteReporteViewDTO ) {
        parent::__construct( $usuarioUsuarioDenunciaReporteReporteViewDTO );
    }
    
    // methods that your repository should implement...
}