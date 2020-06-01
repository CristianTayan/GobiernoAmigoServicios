<?php
namespace GobiernoAmigoMovil\Repository\Impl;

use GobiernoAmigoMovil\Model\DenunciaViewDTO;
use GobiernoAmigoMovil\Repository\DenunciaViewRepositoryInterface;
use OkayBueno\Repositories\src\EloquentRepository;

class DenunciaViewRepository extends EloquentRepository implements DenunciaViewRepositoryInterface  {
    
    public function __construct( DenunciaViewDTO $denunciaViewDTO ) {
        parent::__construct( $denunciaViewDTO );
    }
    
    // methods that your repository should implement...
}