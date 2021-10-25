<?php

namespace SistemaWeb;

use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
    protected $table='provincia';

    protected $primaryKey="Id_Provincia";

    public $timestamps=false;

    protected $fillable =[
        'Id_Provincia',
        'Descripcion',
        'Estado'
    ];

    protected $guarded=[

    ];
}
