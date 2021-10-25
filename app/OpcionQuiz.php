<?php

namespace SistemaWeb;

use Illuminate\Database\Eloquent\Model;

class OpcionQuiz extends Model
{
    protected $table='opcionquiz';

    protected $primaryKey="Id_OpcionQuiz";

    public $timestamps=false;

    protected $fillable =[
        'Id_OpcionQuiz',
        'Id_PreguntaQuiz',
        'OpcionNumero',
        'OpcionRespuesta'

    ];

    protected $guarded=[

    ];
}
