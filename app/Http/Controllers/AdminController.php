<?php
use App\admin;
namespace SistemaWeb\Http\Controllers;


use ConsoleTVs\Charts\Classes\Chartjs\Chart as Chartjs;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SistemaWeb\Persona;
use DB;

use  SistemaWeb\Categoria;


use Illuminate\Support\Facades\Redirect as FacadesRedirect;
use SistemaWeb\Charts\UserChart;
use SistemaWeb\Charts\VisitorsChart;
use SistemaWeb\Http\Requests\CategoriaFormRequest as RequestsCategoriaFormRequest;
class AdminController extends Controller
{
    public function __construct()
    {

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index1(Request $request)
    {
        $this->validate($request,[
            
            'Año1' => 'required|integer',

            'Año2' => 'required|integer'
        ]);


            $userenroll = array(
                Persona::whereMonth('FechaRegistro', '01')->where('Id_TipoPersona', 2)
                    ->whereYear('FechaRegistro', date('Y'))
                    ->count(), //January
                Persona::whereMonth('FechaRegistro', '02')->where('Id_TipoPersona', 2)
                    ->whereYear('FechaRegistro', date('Y'))
                    ->count(), //Feb
                Persona::whereMonth('FechaRegistro', '03')->where('Id_TipoPersona', 2)
                    ->whereYear('FechaRegistro', date('Y'))
                    ->count(), //March
                Persona::whereMonth('FechaRegistro', '04')->where('Id_TipoPersona', 2)
                    ->whereYear('FechaRegistro', date('Y'))
                    ->count(), //April
                Persona::whereMonth('FechaRegistro', '05')->where('Id_TipoPersona', 2)
                    ->whereYear('FechaRegistro', date('Y'))
                    ->count(), //May
                Persona::whereMonth('FechaRegistro', '06')->where('Id_TipoPersona', 2)
                    ->whereYear('FechaRegistro', date('Y'))
                    ->count(), //June
                Persona::whereMonth('FechaRegistro', '07')->where('Id_TipoPersona', 2)
                    ->whereYear('FechaRegistro', date('Y'))
                    ->count(), //Julio
                Persona::whereMonth('FechaRegistro', '08')->where('Id_TipoPersona', 2)
                    ->whereYear('FechaRegistro', date('Y'))
                    ->count(), //August
                Persona::whereMonth('FechaRegistro', '09')->where('Id_TipoPersona', 2)
                    ->whereYear('FechaRegistro', date('Y'))
                    ->count(), //September
                Persona::whereMonth('FechaRegistro', '10')->where('Id_TipoPersona', 2)
                    ->whereYear('FechaRegistro', date('Y'))
                    ->count(), //October
                Persona::whereMonth('FechaRegistro', '11')->where('Id_TipoPersona', 2)
                    ->whereYear('FechaRegistro', date('Y'))
                    ->count(), //November
                Persona::whereMonth('FechaRegistro', '12')->where('Id_TipoPersona', 2)
                    ->whereYear('FechaRegistro', date('Y'))
                    ->count(), //December
            );

            $userEnrolled = new VisitorsChart;
            $userEnrolled->labels(['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octumbre', 'Noviembre', 'Diciembre']);
            $userEnrolled->label('Usuarios registrados')->title('Usuarios registrados en el ' . date('Y'))->dataset('Usuarios inscritos mensualmente', 'area', $userenroll)->options([
                'fill' => 'true',
                'shadow' => true,
                'borderWidth' => '2',
                'color' => '#f9616d',

            ]);





            $activeuser = array(
                Persona::whereMonth('FechaRegistro', '01')->where('Id_TipoPersona', 2)
                    ->whereYear('FechaRegistro', $request->Año1)
                    ->count(), //January
                    Persona::whereMonth('FechaRegistro', '02')->where('Id_TipoPersona', 2)
                    ->whereYear('FechaRegistro', $request->Año1)
                    ->count(), //Feb
                    Persona::whereMonth('FechaRegistro', '03')->where('Id_TipoPersona', 2)
                    ->whereYear('FechaRegistro', $request->Año1)
                    ->count(), //March
                    Persona::whereMonth('FechaRegistro', '11')->where('Id_TipoPersona', 2)
                    ->whereYear('FechaRegistro', $request->Año1)
                    ->count(), //April
                    Persona::whereMonth('FechaRegistro', '05')->where('Id_TipoPersona', 2)
                    ->whereYear('FechaRegistro', $request->Año1)
                    ->count(), //May
                    Persona::whereMonth('FechaRegistro', '06')->where('Id_TipoPersona', 2)
                    ->whereYear('FechaRegistro', $request->Año1)
                    ->count(), //June
                    Persona::whereMonth('FechaRegistro', '07')->where('Id_TipoPersona', 2)
                    ->whereYear('FechaRegistro', $request->Año1)
                    ->count(), //July
                    Persona::whereMonth('FechaRegistro', '08')->where('Id_TipoPersona', 2)
                    ->whereYear('FechaRegistro', $request->Año1)
                    ->count(), //August
                    Persona::whereMonth('FechaRegistro', '09')->where('Id_TipoPersona', 2)
                    ->whereYear('FechaRegistro', $request->Año1)
                    ->count(), //September
                    Persona::whereMonth('FechaRegistro', '10')->where('Id_TipoPersona', 2)
                    ->whereYear('FechaRegistro', $request->Año1)
                    ->count(), //October
                    Persona::whereMonth('FechaRegistro', '11')->where('Id_TipoPersona', 2)
                    ->whereYear('FechaRegistro', $request->Año1)
                    ->count(), //November
                    Persona::whereMonth('FechaRegistro', '12')->where('Id_TipoPersona', 2)
                    ->whereYear('FechaRegistro', $request->Año1)
                    ->count(), //December
            );

            $usersChart = new UserChart;
            $usersChart->labels(['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octumbre', 'Noviembre', 'Diciembre']);

            $usersChart->title('Usuarios registrados mensuales en ' . $request->Año1)->dataset('Usuarios registrados mensuales', 'bar', $activeuser)
            ->backgroundColor("rgba(80,111,228,0.4)")
            ->color("rgba(80,111,228,0.4)")
            ->dashed([0])
            ->fill(true)
            ->linetension(0.1);


            $fillColors = [
                "rgba(255, 205, 86, 0.2)",
                "rgba(255, 99, 132, 0.2)",
                "rgba(22,160,133, 0.2)",

            ];

            $activeuser1 = array(
                Persona::whereMonth('FechaRegistro', '01')->where('Id_TipoPersona', 2)
                    ->whereYear('FechaRegistro', $request->Año2)
                    ->count(), //January
                    Persona::whereMonth('FechaRegistro', '02')->where('Id_TipoPersona', 2)
                    ->whereYear('FechaRegistro', $request->Año2)
                    ->count(), //Feb
                    Persona::whereMonth('FechaRegistro', '03')->where('Id_TipoPersona', 2)
                    ->whereYear('FechaRegistro', $request->Año2)
                    ->count(), //March
                    Persona::whereMonth('FechaRegistro', '11')->where('Id_TipoPersona', 2)
                    ->whereYear('FechaRegistro', $request->Año2)
                    ->count(), //April
                    Persona::whereMonth('FechaRegistro', '05')->where('Id_TipoPersona', 2)
                    ->whereYear('FechaRegistro', $request->Año2)
                    ->count(), //May
                    Persona::whereMonth('FechaRegistro', '06')->where('Id_TipoPersona', 2)
                    ->whereYear('FechaRegistro', $request->Año2)
                    ->count(), //June
                    Persona::whereMonth('FechaRegistro', '07')->where('Id_TipoPersona', 2)
                    ->whereYear('FechaRegistro', $request->Año2)
                    ->count(), //July
                    Persona::whereMonth('FechaRegistro', '08')->where('Id_TipoPersona', 2)
                    ->whereYear('FechaRegistro', $request->Año2)
                    ->count(), //August
                    Persona::whereMonth('FechaRegistro', '09')->where('Id_TipoPersona', 2)
                    ->whereYear('FechaRegistro', $request->Año2)
                    ->count(), //September
                    Persona::whereMonth('FechaRegistro', '10')->where('Id_TipoPersona', 2)
                    ->whereYear('FechaRegistro', $request->Año2)
                    ->count(), //October
                    Persona::whereMonth('FechaRegistro', '11')->where('Id_TipoPersona', 2)
                    ->whereYear('FechaRegistro', $request->Año2)
                    ->count(), //November
                    Persona::whereMonth('FechaRegistro', '12')->where('Id_TipoPersona', 2)
                    ->whereYear('FechaRegistro', $request->Año2)
                    ->count(), //December
            );

             $usersChart1 = new UserChart;
            $usersChart1->labels(['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octumbre', 'Noviembre', 'Diciembre']);

            $usersChart1->title('Usuarios registrados mensuales en ' . $request->Año2)->dataset('Usuarios registrados mensuales', 'bar', $activeuser1)
            ->backgroundColor("rgba(80,111,228,0.4)")
            ->color("rgba(80,111,228,0.4)")
            ->dashed([0])
            ->fill(true)
            ->linetension(0.1);


            $admin = Persona::where('Id_TipoPersona', '=', 1)->count();
            $instructor = Persona::where('Id_TipoPersona', '=', '3')->count();
            $user = Persona::where('Id_TipoPersona', '=', '2')->count();

            $data = [$admin, $instructor, $user];


            $pieChart = new UserChart;
            $pieChart->labels(['Administradores', 'Instructores', 'Usuarios']);
            $pieChart->minimalist(true);
            $pieChart->title('Distribución de usuarios')->dataset('Usuarios por trimestre', 'doughnut', $data)
            ->color($fillColors)
            ->backgroundcolor($fillColors);


            $bandera=true;

            return view('Admin.Aprendizaje.Dashboard.index', compact('userEnrolled', 'usersChart','usersChart1', 'pieChart','bandera'));



    }
    public function index()
    {



            $userenroll = array(
                Persona::whereMonth('FechaRegistro', '01')->where('Id_TipoPersona', 2)
                    ->whereYear('FechaRegistro', date('Y'))
                    ->count(), //January
                Persona::whereMonth('FechaRegistro', '02')->where('Id_TipoPersona', 2)
                    ->whereYear('FechaRegistro', date('Y'))
                    ->count(), //Feb
                Persona::whereMonth('FechaRegistro', '03')->where('Id_TipoPersona', 2)
                    ->whereYear('FechaRegistro', date('Y'))
                    ->count(), //March
                Persona::whereMonth('FechaRegistro', '04')->where('Id_TipoPersona', 2)
                    ->whereYear('FechaRegistro', date('Y'))
                    ->count(), //April
                Persona::whereMonth('FechaRegistro', '05')->where('Id_TipoPersona', 2)
                    ->whereYear('FechaRegistro', date('Y'))
                    ->count(), //May
                Persona::whereMonth('FechaRegistro', '06')->where('Id_TipoPersona', 2)
                    ->whereYear('FechaRegistro', date('Y'))
                    ->count(), //June
                Persona::whereMonth('FechaRegistro', '07')->where('Id_TipoPersona', 2)
                    ->whereYear('FechaRegistro', date('Y'))
                    ->count(), //Julio
                Persona::whereMonth('FechaRegistro', '08')->where('Id_TipoPersona', 2)
                    ->whereYear('FechaRegistro', date('Y'))
                    ->count(), //August
                Persona::whereMonth('FechaRegistro', '09')->where('Id_TipoPersona', 2)
                    ->whereYear('FechaRegistro', date('Y'))
                    ->count(), //September
                Persona::whereMonth('FechaRegistro', '10')->where('Id_TipoPersona', 2)
                    ->whereYear('FechaRegistro', date('Y'))
                    ->count(), //October
                Persona::whereMonth('FechaRegistro', '11')->where('Id_TipoPersona', 2)
                    ->whereYear('FechaRegistro', date('Y'))
                    ->count(), //November
                Persona::whereMonth('FechaRegistro', '12')->where('Id_TipoPersona', 2)
                    ->whereYear('FechaRegistro', date('Y'))
                    ->count(), //December
            );

            $userEnrolled = new VisitorsChart;
            $userEnrolled->labels(['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octumbre', 'Noviembre', 'Diciembre']);
            $userEnrolled->label('Usuarios registrados')->title('Usuarios registrados en el ' . date('Y'))->dataset('Usuarios inscritos mensualmente', 'area', $userenroll)->options([
                'fill' => 'true',
                'shadow' => true,
                'borderWidth' => '2',
                'color' => '#f9616d',

            ]);





            $activeuser = array(
                Persona::whereMonth('FechaRegistro', '01')->where('Id_TipoPersona', 2)
                    ->whereYear('FechaRegistro', date('Y'))
                    ->count(), //January
                    Persona::whereMonth('FechaRegistro', '02')->where('Id_TipoPersona', 2)
                    ->whereYear('FechaRegistro', date('Y'))
                    ->count(), //Feb
                    Persona::whereMonth('FechaRegistro', '03')->where('Id_TipoPersona', 2)
                    ->whereYear('FechaRegistro', date('Y'))
                    ->count(), //March
                    Persona::whereMonth('FechaRegistro', '11')->where('Id_TipoPersona', 2)
                    ->whereYear('FechaRegistro', date('Y'))
                    ->count(), //April
                    Persona::whereMonth('FechaRegistro', '05')->where('Id_TipoPersona', 2)
                    ->whereYear('FechaRegistro', date('Y'))
                    ->count(), //May
                    Persona::whereMonth('FechaRegistro', '06')->where('Id_TipoPersona', 2)
                    ->whereYear('FechaRegistro', date('Y'))
                    ->count(), //June
                    Persona::whereMonth('FechaRegistro', '07')->where('Id_TipoPersona', 2)
                    ->whereYear('FechaRegistro', date('Y'))
                    ->count(), //July
                    Persona::whereMonth('FechaRegistro', '08')->where('Id_TipoPersona', 2)
                    ->whereYear('FechaRegistro', date('Y'))
                    ->count(), //August
                    Persona::whereMonth('FechaRegistro', '09')->where('Id_TipoPersona', 2)
                    ->whereYear('FechaRegistro', date('Y'))
                    ->count(), //September
                    Persona::whereMonth('FechaRegistro', '10')->where('Id_TipoPersona', 2)
                    ->whereYear('FechaRegistro', date('Y'))
                    ->count(), //October
                    Persona::whereMonth('FechaRegistro', '11')->where('Id_TipoPersona', 2)
                    ->whereYear('FechaRegistro', date('Y'))
                    ->count(), //November
                    Persona::whereMonth('FechaRegistro', '12')->where('Id_TipoPersona', 2)
                    ->whereYear('FechaRegistro', date('Y'))
                    ->count(), //December
            );

            $usersChart = new UserChart;
            $usersChart->labels(['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octumbre', 'Noviembre', 'Diciembre']);

            $usersChart->title('Usuarios registrados mensuales en ' . date('Y'))->dataset('Usuarios registrados mensuales', 'bar', $activeuser)
            ->backgroundColor("rgba(80,111,228,0.4)")
            ->color("rgba(80,111,228,0.4)")
            ->dashed([0])
            ->fill(true)
            ->linetension(0.1);


            $fillColors = [
                "rgba(255, 205, 86, 0.2)",
                "rgba(255, 99, 132, 0.2)",
                "rgba(22,160,133, 0.2)",

            ];



             $usersChart1 = new UserChart;
            $usersChart1->labels(['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octumbre', 'Noviembre', 'Diciembre']);

            $usersChart1->title('Usuarios registrados mensuales en ' . date('Y'))->dataset('Usuarios registrados mensuales', 'bar', $activeuser)
            ->backgroundColor("rgba(80,111,228,0.4)")
            ->color("rgba(80,111,228,0.4)")
            ->dashed([0])
            ->fill(true)
            ->linetension(0.1);


            $admin = Persona::where('Id_TipoPersona', '=', 1)->count();
            $instructor = Persona::where('Id_TipoPersona', '=', '3')->count();
            $user = Persona::where('Id_TipoPersona', '=', '2')->count();

            $data = [$admin, $instructor, $user];


            $pieChart = new UserChart;
            $pieChart->labels(['Administradores', 'Instructores', 'Usuarios']);
            $pieChart->minimalist(true);
            $pieChart->title('Distribución de usuarios')->dataset('Usuarios por trimestre', 'doughnut', $data)
            ->color($fillColors)
            ->backgroundcolor($fillColors);



            $bandera=false;
            return view('Admin.Aprendizaje.Dashboard.index', compact('userEnrolled', 'usersChart','usersChart1', 'pieChart','bandera'));



    }
}
