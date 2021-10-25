<?php

namespace SistemaWeb\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SistemaWeb\Categoria;
use SistemaWeb\Curso;
use SistemaWeb\Persona;

class ActualizacionRapidaController extends Controller
{
    public function ActualizacionRapidaPersona($id)
    {
        $users = Persona::findorfail($id);

        if($users->Estado ==0)
        {
            DB::table('Persona')->where('Id_Persona','=',$id)->update(['Estado' => "1"]);
            return back()->with('success','El Estado Cambiado a Activo !');
        }
        else
        {
            DB::table('Persona')->where('Id_Persona','=',$id)->update(['Estado' => "0"]);
            return back()->with('delete','El estado cambio a Desactivado !');
        }
    }
    public function ActualizacionRapidaCategoria($id)
    {
        $users = Categoria::findorfail($id);

        if($users->Estado ==0)
        {
            DB::table('categoria')->where('Id_Categoria','=',$id)->update(['Estado' => "1"]);
            return back()->with('success','El Estado Cambiado a Activo !');
        }
        else
        {
            DB::table('categoria')->where('Id_Categoria','=',$id)->update(['Estado' => "0"]);
            return back()->with('delete','El estado cambio a Desactivado !');
        }
    }
    public function ActualizacionRapidaCurso($id)
    {
        $users = Curso::findorfail($id);

        if($users->Estado ==0)
        {
            DB::table('curso')->where('Id_Curso','=',$id)->update(['Estado' => "1"]);
            return back()->with('success','El Estado Cambiado a Activo !');
        }
        else
        {
            DB::table('curso')->where('Id_Curso','=',$id)->update(['Estado' => "0"]);
            return back()->with('delete','El estado cambio a Desactivado !');
        }
    }
}
