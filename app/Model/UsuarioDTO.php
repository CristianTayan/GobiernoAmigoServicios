<?php

namespace GobiernoAmigoMovil\Model;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticable;

/**
 * @property integer $idusuario
 * @property string $identificacion
 * @property string $nombre
 * @property string $correo
 * @property string $telefono
 * @property string $movil
 * @property string $acceso
 * @property string $estado
 * @property string $perfil
 * @property string $asigna
 * @property string $foto
 */
class UsuarioDTO extends Authenticable
{
    use HasApiTokens, Notifiable;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'gob_usuarios';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'idusuario';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';
    
    
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['identificacion', 'nombre', 'correo', 'telefono', 'movil', 'acceso', 'estado', 'perfil', 'asigna', 'foto',  'idfacebook'];

}
