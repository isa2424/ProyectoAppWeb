<?php

namespace SistemaWeb;

use Illuminate\Database\Eloquent\Model;

class Instructor_Clase extends Model
{
    protected $table='instructor_curso';

    protected $primaryKey="Id_Instructor_Clase";

    public $timestamps=false;

    protected $fillable =[
        'Id_Persona',
        'Id_Curso',
        'Estado'

    ];

    protected $guarded=[

    ];
}
