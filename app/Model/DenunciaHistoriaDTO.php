<?php

namespace GobiernoAmigoMovil\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $iddenuncia_his
 * @property int $iddenuncia
 * @property int $idcategoria
 * @property int $idusuario_his
 * @property string $fecha_his
 * @property string $novedad
 * @property string $sesion
 * @property string $creacion
 */
class DenunciaHistoriaDTO extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'gob_denuncia_historia';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'iddenuncia_his';

    /**
     * @var array
     */
    protected $fillable = ['iddenuncia', 'idcategoria', 'idusuario_his', 'fecha_his', 'novedad', 'sesion', 'creacion'];

}
