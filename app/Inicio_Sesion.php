<?php

namespace SistemaWeb;

use Illuminate\Database\Eloquent\Model;

class Inicio_Sesion extends Model
{
    protected $table='inicio_sesion';

    protected $primaryKey="Id_InicioSesion";

    public $timestamps=false;

    protected $fillable =[
        'Id_InicioSesion',
        'name',
        'email',
        'password',
        'Hashs',
        'Estado'
    ];

    protected $guarded=[

    ];
}
