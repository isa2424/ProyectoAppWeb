<?php

namespace SistemaWeb\Http\Controllers;

use Illuminate\Http\Request;


use  SistemaWeb\Categoria;
use Intervention\Image\Facades\Image As Image;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect as FacadesRedirect;
use Illuminate\Support\Facades\Session;
use SistemaWeb\Http\Requests\CategoriaFormRequest as RequestsCategoriaFormRequest;

class CategoriaController extends Controller
{
    //
    public function __construc(){

    }
    public function viewAllCategoria()
    {
        $sql = "select
                    Id_Categoria as Id_Categoria,
                    Foto as Foto,
                    Titulo as Titulo,
                    SubTitulo as SubTitulo,
                    Estado as Estado
                from categoria";
        $categorias =FacadesDB::select($sql,array(1,20));
        return view('Admin.Aprendizaje.Cursos.Categoria.index', compact('categorias'));
    }
    public function index(Request $request){
        if($request){
            $query=trim($request->get('searchText'));
            $categorias=FacadesDB::table('categoria')->where('Titulo','Like','%'.$query.'%')
            ->where ('Estado','=','1')
            ->orderBy('Id_Categoria','desc')
            ->paginate(7);
            return view('Admin.Aprendizaje.categoria.index',["categorias"=>$categorias,"searchText"=>$query]);
        }
    }
    public function create(){
        return view("Admin.Aprendizaje.categorias.create");
    }
    public function Guardar(Request $request)
    {

        $data = $this->validate($request,[
            "Titulo"=>"required|unique:Categoria,Titulo",
            "Titulo.required"=>"Por Favor Ingrese el Titulo !",
            "Titulo.unique" => "Esta Categoria ya existe !"

        ]);
        $this->validate($request,[

            'Titulo' => 'required|regex:/^[\pL\s\-]+$/u',
            'SubTitulo' => 'required|regex:/^[\pL\s\-]+$/u',
            'Foto' => 'required|mimes:jpg,jpeg,png,bmp,tiff'
        ]);

        $input = $request->all();


        if($file = $request->file('Foto'))
        {

          $path = 'C:/AppServ/www/ProyectoIsabel/Imagenes/Categorias/';

          if(!file_exists($path)) {

            $path = 'C:/AppServ/www/ProyectoIsabel/Imagenes/Categorias/';
            File::makeDirectory($path,0777,true);
          }
          $optimizeImage = Image::make($file);
          $optimizePath = 'C:/AppServ/www/ProyectoIsabel/Imagenes/Categorias/';
          $image = time().$file->getClientOriginalName();
          $optimizeImage->save($optimizePath.$image, 72);

          $input['Foto'] = $image;

        }


        $input['Estado'] = isset($request->Estado)  ? 1 : 0;








        $data =Categoria::create($input);

        $data->save();

        Session::flash('success', trans('Se agrego correctamente'));
        return redirect()->route('categoria.index');

    }
    public function ShowCategoria($id){
        return view("Admin.Aprendizaje.Cursos.Categoria.update",["Categoria"=>Categoria::findOrFail($id)]);
    }
    public function edit($id){
        return view("Admin.Aprendizaje.categoria.update",["Categoria"=>Categoria::findOrFail($id)]);
    }
    public function Actualizar(Request $request,$id){
        $data = $this->validate($request,[
            "Titulo"=>"required|unique:Categoria,Titulo",
            "Titulo.required"=>"Por Favor Ingrese el Titulo !",
            "Titulo.unique" => "Esta Categoria ya existe !"

        ]);
        $this->validate($request,[
            'Foto' => 'mimes:jpg,jpeg,png,bmp,tiff',
            'Titulo' => 'required|regex:/^[\pL\s\-]+$/u',
            'SubTitulo' => 'required|regex:/^[\pL\s\-]+$/u'
        ]);
        $categoria=Categoria::findOrFail($id);

        if($categoria){
            $input = $request->all();
            if($file = $request->file('Foto')) {

                if($categoria->Foto != null) {
                    $content = @file_get_contents("C:/AppServ/www/ProyectoIsabel/Imagenes/Categorias/".$categoria->Foto);
                    if ($content) {
                      unlink("C:/AppServ/www/ProyectoIsabel/Imagenes/Categorias/".$categoria->Foto);
                    }
                }

                $optimizeImage = Image::make($file);
                $optimizePath = "C:/AppServ/www/ProyectoIsabel/Imagenes/Categorias/";
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



                $categoria->update([


                'Foto' => $input['Foto'],
                'Titulo' => $input['Titulo'],
                'SubTitulo' => $input['SubTitulo'],
                'Descripcion' => $input['Descripcion'],
                'Estado' => $input['Estado'],

                ]);
            }else{
                $categoria->update([



                    'Titulo' => $input['Titulo'],
                    'SubTitulo' => $input['SubTitulo'],
                    'Descripcion' => $input['Descripcion'],
                    'Estado' => $input['Estado'],
                    ]);
            }


            Session::flash('success', trans('Se actualizo el dato'));


        }else{
            return back()->with('delete', trans('No se actualizo'));
        }
        return redirect()->route('categoria.index');


    }

    public function destroy($id){
        $categoria=Categoria::findOrFail($id);
        $categoria->Estado='0';
        $categoria->update();
        return FacadesRedirect::to('Admin/Aprendizaje/categoria');
    }
}
