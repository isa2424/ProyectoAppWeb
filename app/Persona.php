<?php

namespace SistemaWeb;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Persona extends Authenticatable implements MustVerifyEmail
{
    const UPDATED_AT = null;
    public $timestamps = false;
    protected $table='persona';

    protected $primaryKey="Id_Persona";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable =[
        'Id_InicioSesion',
        'Id_TipoPersona',
        'Id_Genero',
        'Id_Provincia',
        'Foto',
        'Nombres',
        'Apellidos',
        'Telefono',
        'Biografia',
        'FechaRegistro',
        'Estado'

    ];

    protected $guarded=[

    ];
}
