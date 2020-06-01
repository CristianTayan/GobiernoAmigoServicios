<?php

namespace GobiernoAmigoMovil\Model;

use Illuminate\Database\Eloquent\Model;


class LogDTO extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'gob_log';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'idlog';
    public $timestamps = false;
    
    
    protected $casts = [
        'idlog' => 'int'        
    ];
    
    protected $dates = [ 
        'fecha'
    ];
    
    

    /**
     * @var array
     */
    protected $fillable = ['idlog', 'metodo', 'tabla_afectada', 'dispositivo', 'fecha', 'estado', 'mac', 'ip'];

    
    
    
    
}
