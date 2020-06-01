<?php

namespace GobiernoAmigoMovil\DAO\Impl;
use GobiernoAmigoMovil\DAO\UsuarioFilterByUsuario;
use GobiernoAmigoMovil\DAO\UsuarioFilterByEmail;

/**
 * Class FilterByColumns
 * @package OkayBueno\Repositories\Criteria\src
 */
class UsuarioFilterByEmailImpl implements UsuarioFilterByEmail
{
    private $filter;
     public function __construct( $filter )
    {
        $this->filter = $filter;
    }
    
    /*  public function __construct( array $filter )
     {
     $this->filter = $filter;
     }*/
    /**
     * @param $modelOrBuilder
     * @return mixed
     */
    public function apply( $modelOrBuilder )
    {
        $modelOrBuilder = $modelOrBuilder->where('correo','=',  $this->filter);
        return $modelOrBuilder;
        /*Log::info('filter dentro', $this->filter);
         foreach( $this->filter as $filter )
         {
         $nElements = count( $filter );
         Log::info('$nElements', [$nElements]);
         // Apply filter based on then number of items in the array.
         if ( $nElements === 1 )
         {
         $column = $filter[2][0];
         Log::info('$nElements', [$column]);
         // $operation = NULL;
         // $value = $filter[1];
         }if ( $nElements === 2 )
         {
         $column = $filter[0];
         $operation = NULL;
         $value = $filter[1];
         } else if ( $nElements === 3 )
         {
         $column = $filter[0];
         $operation = $filter[1];
         $value = $filter[2];
         } else continue;
         $modelOrBuilder = $this->applyFilter( $modelOrBuilder, $column, $value, $operation );
         Log::info('modelOrBuilder', [$modelOrBuilder]);
         }
         
         return $modelOrBuilder;*/
    }
    /**
     * @param $modelOrBuilder
     * @param $column
     * @param $value
     * @param null $operation
     */
    private function applyFilter( $modelOrBuilder, $column, $value, $operation = NULL )
    {
        if ( is_null( $operation ) ) $modelOrBuilder = $modelOrBuilder->where( $column, $value );
        else $modelOrBuilder = $modelOrBuilder->where( $column, $operation, $value );
        return $modelOrBuilder;
    }
}

