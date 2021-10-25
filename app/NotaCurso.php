<?php

namespace SistemaWeb;

use Illuminate\Database\Eloquent\Model;

class NotaCurso extends Model
{
    protected $table='notacurso';

    protected $primaryKey="Id_NotaCurso";

    public $timestamps=false;

    protected $fillable =[
        'Id_Persona',
        'Id_TipoPregunta',
        'Id_Curso',
        'NotaExamen',
        'FechaNota',
        'HoraNota',
        'Aprobado'
    ];

    protected $guarded=[

    ];
}
