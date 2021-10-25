<?php

namespace SistemaWeb;

use Illuminate\Database\Eloquent\Model;

class Contenido_Curso extends Model
{
    protected $table='contenido_curso';

    protected $primaryKey="Id_ContenidoCurso";

    public $timestamps=false;

    protected $fillable =[
        'Id_ContenidoCurso',
        'Id_Curso',
        'Titulo',
        'Descripcion',
        'DireccionImagen',
        'DireccionVideo',
        'TipoVideo'
    ];

    protected $guarded=[

    ];
}
