<?php
namespace GobiernoAmigoMovil\Repository\Impl;

use GobiernoAmigoMovil\Repository\LogRepositoryInterface;
use OkayBueno\Repositories\src\EloquentRepository;
use  GobiernoAmigoMovil\Model\LogDTO;

class LogRepository extends EloquentRepository implements LogRepositoryInterface  {
    
    public function __construct( LogDTO $logDTO ) {
        parent::__construct( $logDTO );
    }
    
    // methods that your repository should implement...
}

