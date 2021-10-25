<?php

namespace SistemaWeb;

use Illuminate\Database\Eloquent\Model;

class TipoPersona extends Model
{
    protected $table='tipopersona';

    protected $primaryKey="Id_TipoPersona";

    public $timestamps=false;

    protected $fillable =[
        'Id_TipoPersona',
        'TipoPersona',
        'Estado'
    ];

    protected $guarded=[

    ];
}
