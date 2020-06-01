<?php
namespace GobiernoAmigoMovil\Repository\Impl;

use GobiernoAmigoMovil\Model\DenunciaDTO;
use GobiernoAmigoMovil\Repository\DenunciaRepositoryInterface;
use OkayBueno\Repositories\src\EloquentRepository;

class DenunciaRepository extends EloquentRepository implements DenunciaRepositoryInterface  {
    
    public function __construct( DenunciaDTO $denunciaDTO ) {
        parent::__construct( $denunciaDTO );
    }
    
    // methods that your repository should implement...
}