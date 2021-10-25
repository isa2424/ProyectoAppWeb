<?php

namespace SistemaWeb\Http\Controllers;

use Illuminate\Http\Request;
use SistemaWeb\Persona;
use DB;
use Intervention\Image\Facades\Image As Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\Session;
use SistemaWeb\Inicio_Sesion;
use SistemaWeb\Provincia;
use SistemaWeb\User;

class PersonaController extends Controller
{
    public function __construct()
    {

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function viewAllUser()
    {
        $sql = "select
                    p.Id_InicioSesion as Id_InicioSesion,
                    p.Id_Persona as Id_Persona,
                    p.Foto as Foto,
                    p.Nombres as Nombres,
                    p.Apellidos as Apellidos,
                    i.email as Correo,
                    tp.TipoPersona as Rol,
                    p.Telefono as Telefono,
                    pv.Descripcion as Provincia,
                    p.Estado as Estado
                from persona p ,users i , tipopersona tp ,provincia pv
                where p.Id_InicioSesion=i.id  and p.Id_TipoPersona=tp.Id_TipoPersona and p.Id_Provincia=pv.Id_Provincia";

        $users =FacadesDB::select($sql,array(1,20));
        //$users = Persona::all();

        return view(' Admin.Aprendizaje.Persona.index', compact('users'));
    }





    public function editar($id)
    {

          $provincias = Provincia::all();
          $InicioSesion = User::all();



          $user = Persona::where('Id_Persona', $id)->first();


        return view('Admin.Aprendizaje.Persona.edit',compact('user','provincias','InicioSesion'));

    }


    public function Actualizar(Request $request,$id)
    {

        $this->validate($request,[
            'Foto' => 'mimes:jpg,jpeg,png,bmp,tiff',
            'Nombres' => 'required|regex:/^[\pL\s\-]+$/u',
            'Apellidos' => 'required|regex:/^[\pL\s\-]+$/u',

            'Telefono' => 'required|regex:/[0-9]{10}/'
        ]);


        $user = Persona::findorfail($id);





        if($user){

          $input = $request->all();


          if($file = $request->file('Foto')) {

              if($user->Foto != null) {
                  $content = @file_get_contents("C:/AppServ/www/ProyectoIsabel/Imagenes/Usuarios/".$user->Foto);
                  if ($content) {
                    unlink("C:/AppServ/www/ProyectoIsabel/Imagenes/Usuarios/".$user->Foto);
                  }
              }

              $optimizeImage = Image::make($file);
              $optimizePath = "C:/AppServ/www/ProyectoIsabel/Imagenes/Usuarios/";
              $image = time().$file->getClientOriginalName();
              $optimizeImage->save($optimizePath.$image, 72);
              $input['Foto'] = $image;

          }else{
            $input['Foto'] = null;

          }

          if(isset($request->Estado))
          {
              $input['Estado'] = '1';
          }
          else
          {
              $input['Estado'] = '0';
          }




          if($input['Foto']!=null){



            $user->update([
                'Id_TipoPersona' => $input['Id_TipoPersona'],
                'Id_Provincia' => $input['Id_Provincia'],
                'Foto' => $input['Foto'],
                'Nombres' => $input['Nombres'],
                'Apellidos' => $input['Apellidos'],
                'Telefono' => $input['Telefono'],
                'Biografia' => $input['Descripcion'],
                'Estado' => $input['Estado'],
            ]);
          }else{
            $user->update([
                'Id_TipoPersona' => $input['Id_TipoPersona'],
                'Id_Provincia' => $input['Id_Provincia'],
                'Nombres' => $input['Nombres'],
                'Apellidos' => $input['Apellidos'],
                'Telefono' => $input['Telefono'],
                'Biografia' => $input['Descripcion'],
                'Estado' => $input['Estado'],
            ]);
          }


          Session::flash('success', trans('Se actualizo el dato'));


        }
        else
        {
          return back()->with('delete', trans('No se actualizo'));
        }

        return redirect()->route('persona.index');

    }



    public function PersonasAprovadas()
    {
        $sql = "select
        a.Nombres as Nombres,
        a.Apellidos as Apellidos,
        c.Id_Curso as Id_Curso,
        c.Titulo as  Titulo,
        b.Aprobado as Aprobados,
        max(b.NotaExamen) as Nota,
        max(b.FechaNota) as Fecha,
        max(b.HoraNota) as Hora

    from
        persona a
        inner join notacurso b on (b.Id_Persona = a.Id_Persona)
        inner join curso c on (c.Id_Curso = b.Id_Curso)
    where
        (a.Id_Persona = a.Id_Persona)
    group by
        a.Nombres,
        a.Apellidos,
        c.Id_Curso,
        c.Titulo,
        b.Aprobado";

        $Aprobados =FacadesDB::select($sql,array(1,20));
        //$users = Persona::all();

        return view(' Admin.Aprendizaje.Aprobados.index', compact('Aprobados'));
    }
    public function ProgresoPersonas()
    {
        $sql = "select
        pc.Id_Curso as Id_Curso,
      c.Titulo as  Titulo,
      p.Nombres as NombresEstudiante,
      p.Apellidos as ApellidosEstudiante,
      (select p1.Nombres from instructor_clase ic,persona p1 where ic.Id_Curso=pc.Id_Curso and p1.Id_Persona=ic.Id_Persona) as NombresProfesor,
      (select p1.Apellidos from instructor_clase ic,persona p1 where ic.Id_Curso=pc.Id_Curso and p1.Id_Persona=ic.Id_Persona) as ApellidosProfesor,
      (select Count(cc.Id_Curso) as Total from contenido_curso cc where cc.Id_Curso=c.Id_Curso group by Id_Curso) as TotalCurso,
      ROUND(80*( Count(pc.Id_Curso)/(select Count(cc.Id_Curso) as Total from contenido_curso cc where cc.Id_Curso=c.Id_Curso group by Id_Curso)))as TotalContenido,
      Count(pc.Id_Curso) as Total
      from
          persona p
          inner join progreso_curso pc on (pc.Id_Persona = p.Id_Persona)
          inner join curso c on (c.Id_Curso = pc.Id_Curso)
      where
       p.Id_Persona=pc.Id_Persona
      group by
          pc.Id_Curso,p.Nombres,c.Titulo,p.Apellidos";
        $Progreso =FacadesDB::select($sql,array(1,20));
        //$users = Persona::all();

        return view(' Admin.Aprendizaje.Progreso.index', compact('Progreso'));
    }

}
