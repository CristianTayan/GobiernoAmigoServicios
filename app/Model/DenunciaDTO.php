<?php

namespace GobiernoAmigoMovil\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $iddenuncia
 * @property int $idcategoria
 * @property int $idtipo
 * @property int $idusuario
 * @property string $fecha
 * @property string $detalle
 * @property string $estado
 * @property string $urlfoto
 * @property float $coordenadax
 * @property float $coordenaday
 * @property int $idusuario_asigna
 * @property string $fecha_asigna
 * @property string $fecha_finaliza
 * @property string $sesion
 * @property string $creacion
 */
class DenunciaDTO extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'gob_denuncia';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'iddenuncia';
    public $timestamps = false;
    
    
    protected $casts = [
        'idcategoria' => 'int',
        'idtipo' => 'int',
        'idusuario' => 'int',
        'coordenadax' => 'float',
        'coordenaday' => 'float',
        'idusuario_asigna' => 'int'
    ];
    
    protected $dates = [        
        'creacion', 
        'fecha_asigna',
        'fecha_finaliza'
    ];
    
    

    /**
     * @var array
     */
    protected $fillable = ['idcategoria', 'idtipo', 'idusuario', 'fecha', 'detalle', 'estado', 'urlfoto', 'coordenadax', 'coordenaday', 'idusuario_asigna', 'fecha_asigna',
        'fecha_finaliza', 'sesion', 'creacion','novedad', 'app_uid','app_number','tipo_for_rest_external' ];

    
    public function gob_tipo()
    {
        return $this->belongsTo(\GobiernoAmigoMovil\Model\TipoDTO::class, 'idtipo');
    }
    
    public function gob_categoria()
    {
        return $this->belongsTo(\GobiernoAmigoMovil\Model\CategoriaDTO::class, 'idcategoria');
    }
   
    
    
}
