<?php

namespace SistemaWeb\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use SistemaWeb\Categoria;
use SistemaWeb\Contenido_Curso;
use SistemaWeb\Curso;
use SistemaWeb\OpcionQuiz;
use SistemaWeb\PreguntaQuiz;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image as Image;

class CursoController extends Controller
{
    public function __construct()
    {
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function viewAllCurso()
    {
        $categoria = Categoria::all();
        $sql1 = "select
                p.Id_Persona as Id_Persona,
                p.Nombres as Nombres,
                p.Apellidos as Apellidos

                from persona p ,tipopersona tp
                where p.Id_TipoPersona=tp.Id_TipoPersona and tp.Id_TipoPersona=3";
        $instructor = DB::select($sql1, array(1, 20));
        $sql = "select
                    c.Id_Curso as Id_Curso,
                    c.Foto as Foto,
                    c.Titulo as Titulo,
                    c.Descripcion as Descripcion,
                    ct.Titulo as Categoria,
                    c.Estado as Estado
                from curso c ,categoria ct
                where c.Id_Categoria=ct.Id_Categoria";
        $cursos = DB::select($sql, array(1, 20));
        return view('Admin.Aprendizaje.Cursos.Curso.index', compact('cursos', 'categoria', 'instructor'));
    }
    public function Guardar(Request $request)
    {

        $data = $this->validate($request, [
            "Titulo" => "required|unique:Curso,Titulo",
            "Titulo.required" => "Por Favor Ingrese el Titulo !",
            "Titulo.unique" => "Este Curso ya existe !"

        ]);
        $this->validate($request, [

            'Id_Categoria' => 'required',
            'Id_Categoria.required' => "Por favor Onichan seleccione una categoria uwu",
            'Id_Persona' => 'required',
            'Id_Persona.required' => "Por favor Onichan seleccione un Instructor uwu",
            //'Titulo' => 'required|regex:/^[\pL\s\-]+$/u',

            'Foto' => 'required|mimes:jpg,jpeg,png,bmp,tiff'
        ]);




        $input = $request->all();


        if ($file = $request->file('Foto')) {

            $path = 'C:/AppServ/www/ProyectoIsabel/Imagenes/Cursos/';

            if (!file_exists($path)) {

                $path = 'C:/AppServ/www/ProyectoIsabel/Imagenes/Cursos/';
                File::makeDirectory($path, 0777, true);
            }
            $optimizeImage = Image::make($file);
            $optimizePath = 'C:/AppServ/www/ProyectoIsabel/Imagenes/Cursos/';
            $image = time() . $file->getClientOriginalName();
            $optimizeImage->save($optimizePath . $image, 72);

            $input['Foto'] = $image;
        }


        $input['Estado'] = isset($request->Estado)  ? 1 : 0;








        $data = Curso::create($input);
        $Estados = 1;
        $data->save();
        if ($data) {
            DB::insert("insert into instructor_clase (Id_Persona, Id_Curso,Estado) values ('" . $request->Id_Persona . "','" . $data->Id_Curso . "','" . $Estados . "')");
        }


        Session::flash('success', trans('Se agrego correctamente'));
        return redirect()->route('curso.index');
    }

    public function GuardarContenido(Request $request)
    {
        $this->validate($request, [

            'DireccionImagen' => 'required|url',
            'DireccionVideo' => 'required|url',
        ]);

        $this->validate($request, [
            "Titulo" => "required|unique:contenido_curso,Titulo",
            "Titulo.required" => "Por Favor Ingrese el Titulo !",
            "Titulo.unique" => "Este contenido ya existe !"

        ]);
        $this->validate($request, [


            'Titulo' => 'required|regex:/^[\pL\s\-]+$/u',


        ]);





        $input = $request->all();










        $data = Contenido_Curso::create($input);

        $data->save();


        Session::flash('success', trans('Se agrego correctamente'));
        return redirect()->route('curso.show', $input['Id_Curso']);
    }

    public function showCourse($id)
    {
        $categoria = Categoria::all();
        $sql1 = "select
                p.Id_Persona as Id_Persona,
                p.Nombres as Nombres,
                p.Apellidos as Apellidos

                from persona p ,tipopersona tp
                where p.Id_TipoPersona=tp.Id_TipoPersona and tp.Id_TipoPersona=3";
        $instructor = DB::select($sql1, array(1, 20));
        $Curso = Curso::all();

        $Cur = Curso::findOrFail($id);


        $ContenidoCurso = Contenido_Curso::where('Id_Curso', '=', $id)->orderBy('Id_Curso', 'ASC')->get();



        $sql2 = " select
                    pq.Id_PreguntaQuiz as Id_PreguntaQuiz,
                    pq.Id_Curso as Id_Curso ,
                    tp.Descripcion as TipoPregunta ,
                    pq.Pregunta as Pregunta ,
                    pq.RespuestaCorrecta as RespuestaCorrecta ,
                    pq.Explicacion as Explicacion

                from preguntaquiz pq,tipopregunta tp
                WHERE  pq.Id_TipoPregunta=tp.Id_TipoPregunta and pq.Id_Curso=" . $id;
        $PreguntaQuiz = DB::select($sql2, array(1, 20));

        //$PreguntaQuiz = PreguntaQuiz::where('Id_Curso','=',$id)->get();

        $sql = "    select
                        oq.Id_OpcionQuiz as Id_OpcionQuiz,
                        pq.Pregunta as Pregunta ,
                        oq.OpcionRespuesta as OpcionRespuesta
                    from preguntaquiz pq,opcionquiz oq
                    WHERE  pq.Id_PreguntaQuiz=oq.Id_PreguntaQuiz and pq.Id_Curso=" . $id;
        $OpcionQuiz = DB::select($sql, array(1, 20));


        return view('Admin.Aprendizaje.Cursos.Curso.show', compact('Cur', 'Curso', 'ContenidoCurso', 'ContenidoCurso', 'PreguntaQuiz', 'OpcionQuiz', 'instructor'));
    }

    public function Actualizar(Request $request, $id)
    {

        $this->validate($request, [
            'Id_Categoria' => 'required|integer',
            'Id_Categoria.required' => 'Por favor Onichan seleccione una categoria uwu',
            'Foto' => 'mimes:jpg,jpeg,png,bmp,tiff',
            //'Titulo' => 'required|regex:/^[\pL\s\-]+$/u'

        ]);

        $categoria = Curso::findOrFail($id);

        if ($categoria) {
            $input = $request->all();
            if ($file = $request->file('Foto')) {

                if ($categoria->Foto != null) {
                    $content = @file_get_contents("C:/AppServ/www/ProyectoIsabel/Imagenes/Cursos/" . $categoria->Foto);
                    if ($content) {
                        unlink("C:/AppServ/www/ProyectoIsabel/Imagenes/Cursos/" . $categoria->Foto);
                    }
                }

                $optimizeImage = Image::make($file);
                $optimizePath = "C:/AppServ/www/ProyectoIsabel/Imagenes/Cursos/";
                $image = time() . $file->getClientOriginalName();
                $optimizeImage->save($optimizePath . $image, 72);
                $input['Foto'] = $image;
            } else {
                $input['Foto'] = null;
            }
            if (isset($request->Estado)) {
                $input['Estado'] = '1';
            } else {
                $input['Estado'] = '0';
            }
            if ($input['Foto'] != null) {



                $categoria->update([

                    'Id_Categoria' => $input['Id_Categoria'],
                    'Foto' => $input['Foto'],
                    'Titulo' => $input['Titulo'],
                    'Descripcion' => $input['Descripcion'],
                    'Estado' => $input['Estado'],

                ]);
            } else {
                $categoria->update([

                    'Id_Categoria' => $input['Id_Categoria'],

                    'Titulo' => $input['Titulo'],
                    'Descripcion' => $input['Descripcion'],
                    'Estado' => $input['Estado'],

                ]);
            }


            Session::flash('success', trans('Se actualizo el dato'));
        } else {
            return back()->with('delete', trans('No se actualizo'));
        }
        return redirect()->route('curso.show', $categoria->Id_Curso);
    }


    public function showContenido($id)
    {

        $Contenido = Contenido_Curso::findOrFail($id);

        return view('Admin.Aprendizaje.Cursos.Curso.ContenidoCurso.edit', compact('Contenido'));
    }
    public function ActualizarContenido(Request $request, $id)
    {

        $this->validate($request, [

            'DireccionImagen' => 'required|url',
            'DireccionVideo' => 'required|url',
        ]);


        $this->validate($request, [


            'Titulo' => 'required|regex:/^[\pL\s\-]+$/u',


        ]);

        $categoria = Contenido_Curso::findOrFail($id);

        if ($categoria) {
            $input = $request->all();





            $categoria->update([

                'Id_Curso' => $input['Id_Curso'],
                'Titulo' => $input['Titulo'],
                'Descripcion' => $input['Descripcion'],
                'DireccionImagen' => $input['DireccionImagen'],
                'DireccionImagen' => $input['DireccionVideo'],
                'TipoVideo' => $input['TipoVideo'],

            ]);


            Session::flash('success', trans('Se actualizo el dato'));
        } else {
            return back()->with('delete', trans('No se actualizo'));
        }
        return redirect()->route('curso.show', $input['Id_Curso']);
    }









    //Preguntas

    public function GuardarPregunta(Request $request)
    {
        $this->validate($request, [
            'Pregunta' => 'required',
            'RespuestaCorrecta' => 'required|integer|between:1,4',

        ]);
        $input = $request->all();
        $input['RespuestaCorrecta'] = $request->RespuestaCorrecta;
        $data = PreguntaQuiz::create($input);
        $data->save();
        Session::flash('success', trans('Se agrego correctamente'));
        return redirect()->route('curso.show', $input['Id_Curso']);
    }


    public function EliminarPregunta($id)
    {
        $pregunta = PreguntaQuiz::find($id);
        $Id_Curso = $pregunta->Id_Curso;
        OpcionQuiz::where('Id_PreguntaQuiz', $id)->delete();
        $pregunta->delete();

        Session::flash('delete', trans('Se elimino la pregunta del examen'));
        return redirect()->route('curso.show', $Id_Curso);
    }

    public function showPregunta($id)
    {

        $Pregunta = PreguntaQuiz::findOrFail($id);

        return view('Admin.Aprendizaje.Cursos.Curso.Quiz.PreguntaQuiz.edit', compact('Pregunta'));
    }

    public function ActualizarPregunta(Request $request, $id)
    {
        $this->validate($request, [
            'Pregunta' => 'required',
            'RespuestaCorrecta' => 'required|integer|between:1,4',
        ]);
        $categoria = PreguntaQuiz::findOrFail($id);
        if ($categoria) {
            $input = $request->all();
            $categoria->update([

                'Id_TipoPregunta' => $input['Id_TipoPregunta'],
                'Id_Curso' => $input['Id_Curso'],
                'Pregunta' => $input['Pregunta'],
                'RespuestaCorrecta' => $input['RespuestaCorrecta'],
                'Explicacion' => $input['Explicacion'],
            ]);
            Session::flash('success', trans('Se actualizo el dato'));
        } else {
            return back()->with('delete', trans('No se actualizo'));
        }
        return redirect()->route('curso.show', $input['Id_Curso']);
    }


    //Opciones
    public function GuardarOpciones(Request $request)
    {

        $sql2 = " select *
            from opcionquiz
            WHERE  Id_PreguntaQuiz='".$request->Id_PreguntaQuiz."' and OpcionNumero=".$request->OpcionNumero;
        $Usado = DB::select($sql2, array(1, 20));

        if($Usado){
            $input = $request->all();
            Session::flash('delete', trans("La opcion ". $request->OpcionNumero ." ya esta usada para esta pregunta intente con otra que son del 1-4"));
            return redirect()->route('curso.show', $input['Id_Curso']);
        }else{
            $this->validate($request, [
                'Id_PreguntaQuiz' => 'required|integer',
                'Id_PreguntaQuiz.required' => "Por favor Onichan seleccione una categoria uwu",
                'OpcionRespuesta' => 'required',
                'OpcionNumero' => 'required|integer|between:1,4',

            ]);
            $input = $request->all();
            $input['OpcionNumero'] = $request->OpcionNumero;
            $data = OpcionQuiz::create($input);
            $data->save();
            Session::flash('success', trans('Se agrego correctamente'));
            return redirect()->route('curso.show', $input['Id_Curso']);
        }

    }
    public function EliminarOpcion($id,$idcurso)
    {

        $pregunta = OpcionQuiz::find($id);

        $pregunta->delete();
        OpcionQuiz::where('Id_OpcionQuiz', $id)->delete();
        Session::flash('delete', trans('Se elimino la pregunta del examen'));
        return redirect()->route('curso.show',$idcurso);
    }

    public function showOpcion($id,$idcurso)
    {

        $Opcion = OpcionQuiz::findOrFail($id);
        $Curso['Id_Curso']=$idcurso;
        return view('Admin.Aprendizaje.Cursos.Curso.Quiz.OpcionQuiz.edit', compact('Opcion','Curso'));
    }

    public function ActualizarOpcion(Request $request, $id)
    {

        $categoria = OpcionQuiz::findOrFail($id);
        if ($categoria) {
            $input = $request->all();

            $categoria->update([

                'Id_PreguntaQuiz' => $input['Id_PreguntaQuiz'],
                'OpcionNumero' => $input['OpcionNumero'],
                'OpcionRespuesta' => $input['OpcionRespuesta'],

            ]);
            Session::flash('success', trans('Se actualizo el dato'));
        } else {
            return back()->with('delete', trans('No se actualizo'));
        }
        return redirect()->route('curso.show', $input['Id_Curso']);
    }
}
