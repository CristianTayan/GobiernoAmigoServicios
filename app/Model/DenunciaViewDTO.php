<?php

namespace App;

namespace GobiernoAmigoMovil\Model;

use Laravel\Passport\HasApiTokens;
use Illuminate\Auth\Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticable;

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
class DenunciaViewDTO  extends Authenticable
{
    use HasApiTokens, Notifiable;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'denuncia_view';
    public $timestamps = false;

   
    protected $casts = [
        'id_tipo' => 'int',
        'id_categoria' => 'int',
        'id_denuncia' => 'int',
        'id_usuario_denuncia'=> 'int',
        'coordenada_x_denuncia' => 'float',
        'coordenada_y_denuncia' => 'float',
        'id_usuario_asigna_denuncia' => 'int'
    ];
    
    protected $dates = [
        'fecha_denuncia',
        'fecha_asigna_denuncia',
        'fecha_finaliza_denuncia',
        'fecha_creacion_denuncia'
    ];

    /**
     * @var array
     */
    protected $fillable = ['id_tipo', 'nombre_tipo', 'id_categoria', 'nombre_categoria', 'id_denuncia', 'id_usuario_denuncia',
        'app_uid_denuncia','identificacion_usuario_denuncia','fecha_denuncia',
        'fecha_denuncia_string', 'detalle_denuncia', 'estado_denuncia', 'url_foto_denuncia', 'coordenada_x_denuncia',
        'coordenada_y_denuncia', 'id_usuario_asigna_denuncia', 'fecha_asigna_denuncia', 'fecha_asigna_denuncia_string',
        'fecha_finaliza_denuncia','fecha_finaliza_denuncia_string','sesion_denuncia','fecha_creacion_denuncia',
        'fecha_creacion_denuncia_string', 'novedad_denuncia','app_uid_denuncia','app_number_denuncia','tipo_for_rest_external_denuncia'
    ];

    
}
