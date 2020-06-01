<?php

namespace GobiernoAmigoMovil\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $idcategoria
 * @property int $idtipo
 * @property string $nombre
 * @property string $detalle
 * @property string $estado
 * @property string $sesion
 * @property string $creacion
 */
class CategoriaDTO extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'gob_categoria';
    public $timestamps = false;

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'idcategoria';
    
    protected $casts = [
        'idtipo' => 'int'
    ];
    
    protected $dates = [
        'creacion'
    ];

    /**
     * @var array
     */
    protected $fillable = ['idtipo', 'nombre', 'detalle', 'estado', 'sesion', 'creacion', 'app_uid'];
    
    public function gob_tipo()
    {
        return $this->belongsTo(\GobiernoAmigoMovil\Model\TipoDTO::class, 'idtipo');
    }
    
    public function gob_denuncias()
    {
        return $this->hasMany(\GobiernoAmigoMovil\Model\DenunciaDTO::class, 'idcategoria');
    }

}
