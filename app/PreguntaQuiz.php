<?php

namespace SistemaWeb;

use Illuminate\Database\Eloquent\Model;

class PreguntaQuiz extends Model
{
    protected $table='preguntaquiz';

    protected $primaryKey="Id_PreguntaQuiz";

    public $timestamps=false;

    protected $fillable =[
        'Id_TipoPregunta',
        'Id_Curso',
        'Pregunta',
        'RespuestaCorrecta',
        'Explicacion'

    ];

    protected $guarded=[

    ];
}
