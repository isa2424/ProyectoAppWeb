<?php

namespace SistemaWeb;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    protected $table='curso';

    protected $primaryKey="Id_Curso";

    public $timestamps=false;

    protected $fillable =[
        'Id_Categoria',
        'Foto',
        'Titulo',
        'Descripcion',
        'Estado'
    ];

    protected $guarded=[

    ];
}
