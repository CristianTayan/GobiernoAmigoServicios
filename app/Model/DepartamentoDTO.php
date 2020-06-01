<?php

namespace GobiernoAmigoMovil\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_departamento
 * @property int $id_departamentos
 * @property string $nombre
 * @property string $atribuciones
 * @property string $competencias
 * @property string $ubicacion
 * @property int $nivel
 * @property string $univel
 * @property string $estado
 * @property string $ambito
 * @property string $siglas
 * @property int $secuencia
 */
class DepartamentoDTO extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'nom_departamento';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_departamento';

    /**
     * @var array
     */
    protected $fillable = ['id_departamentos', 'nombre', 'atribuciones', 'competencias', 'ubicacion', 'nivel', 'univel', 'estado', 'ambito', 'siglas', 'secuencia'];

}
