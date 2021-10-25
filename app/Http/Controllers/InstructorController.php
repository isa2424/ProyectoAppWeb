<?php

namespace SistemaWeb\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use SistemaWeb\Persona;
use Intervention\Image\Facades\Image As Image;
use SistemaWeb\Inicio_Sesion;
use SistemaWeb\Provincia;
use SistemaWeb\User;

class InstructorController extends Controller
{
    public function viewAllInstructor()
    {
        $sql = "select
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
                where p.Id_InicioSesion=i.id and p.Id_TipoPersona=tp.Id_TipoPersona and p.Id_Provincia=pv.Id_Provincia and p.Id_TipoPersona=3";

        $instructor =DB::select($sql,array(1,20));
        //$users = Persona::all();

        return view(' Admin.Aprendizaje.Instructor.index', compact('instructor'));
    }
    public function ActualizarInstructor(Request $request,$id)
    {

        $this->validate($request,[
            'Foto' => 'mimes:jpg,jpeg,png,bmp,tiff'
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

        return redirect()->route('instructor.index');

    }
    public function editar($id)
    {

          $provincias = Provincia::all();
          $InicioSesion = User::all();


            //dd($user);
          $user = Persona::where('Id_Persona', $id)->first();


        return view('Admin.Aprendizaje.Instructor.edit',compact('user','provincias','InicioSesion'));

    }
}
