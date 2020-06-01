<?php

namespace App;

namespace GobiernoAmigoMovil\Model;

use Laravel\Passport\HasApiTokens;
use Illuminate\Auth\Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticable;


class UsuarioDenunciaReporteViewDTO  extends Authenticable
{
    use HasApiTokens, Notifiable;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'usuario_denuncia_reporte_view';
    

   
    protected $casts = [
        'id_usuario'=> 'int',
        'porcentaje_reporte' => 'float'
    ];
    
   

    /**
     * @var array
     */
    protected $fillable = ['id_usuario',
        'identificacion_usuario', 'correo_usuario', 'referencia_reporte','label_reporte',
        'detalle_reporte', 'porcentaje_reporte', 'color_reporte'
    ];

    
}
