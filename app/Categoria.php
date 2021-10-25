<?php

namespace SistemaWeb;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table='categoria';

    protected $primaryKey="Id_Categoria";

    public $timestamps=false;

    protected $fillable =[
        'Foto',
        'Titulo',
        'SubTitulo',
        'Descripcion',
        'Estado'
    ];

    protected $guarded=[

    ];
}
