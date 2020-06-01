<?php

namespace GobiernoAmigoMovil\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $idtipo
 * @property string $nombre
 * @property string $detalle
 * @property string $estado
 * @property int $id_departamento
 * @property integer $idusuario
 */
class TipoDTO extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'gob_tipo';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'idtipo';
    
    protected $casts = [
        'id_departamento' => 'int',
        'idusuario' => 'int'
    ];

    /**
     * @var array
     */
    protected $fillable = ['nombre', 'detalle', 'estado', 'id_departamento', 'idusuario'];

    
    public function gob_categorias()
    {
        return $this->hasMany(\GobiernoAmigoMovil\Model\CategoriaDTO::class, 'idtipo');
    }
}
