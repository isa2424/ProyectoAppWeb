@extends ('Admin/layouts.admin')
@section('contenido')
    <section class="content-header">
        <h1>
            Dashboard
            <small>Resumen</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
            <li class="active">Index</li>
        </ol>
    </section>
    <section class="content">
        <!-- Main row -->

        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>
                            @php
                                $user = SistemaWeb\Persona::all();
                                if (count($user) > 0) {
                                    echo count($user);
                                } else {
                                    echo '0';
                                }
                            @endphp
                        </h3>
                        <p>persona</p>
                    </div>
                    <div class="icon">
                        <i class="flaticon-user"></i>
                    </div>
                    <a href="{{ route('persona.index') }}" class="small-box-footer">Ver Información <i
                            class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>
                            @php
                                $cat = SistemaWeb\Categoria::all();
                                if (count($cat) > 0) {
                                    echo count($cat);
                                } else {
                                    echo '0';
                                }
                            @endphp
                        </h3>
                        <p>Categorias</p>
                    </div>
                    <div class="icon">
                        <i class="flaticon-layout"></i>
                    </div>
                    <a href="{{ route('categoria.index') }}" class="small-box-footer">Ver Información <i
                            class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>
                            @php
                                $curso = SistemaWeb\Curso::all();
                                if (count($curso) > 0) {
                                    echo count($curso);
                                } else {
                                    echo '0';
                                }
                            @endphp
                        </h3>
                        <p>Cursos</p>
                    </div>
                    <div class="icon">
                        <i class="flaticon-book"></i>
                    </div>
                    <a href="{{ route('curso.index') }}" class="small-box-footer">Ver Información <i
                            class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>
                            @php
                                $instructor = SistemaWeb\Persona::where('Id_TipoPersona', '=', 3)->get();

                                if ($instructor->count() > 0) {
                                    echo $instructor->count();
                                } else {
                                    echo '0';
                                }

                            @endphp
                        </h3>
                        <p>Instructor</p>
                    </div>
                    <div class="icon">
                        <i class="flaticon-teacher"></i>
                    </div>
                    <a href="{{ route('instructor.index') }}" class="small-box-footer">Ver Información <i
                            class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="container">
                <h1>Estadisticas Comparativas por año</h1>

            </div>

        </div>
        <div class="row">
            <div class="container">
                <h1>Seleccione rango a buscar</h1>

            </div>

        </div>

        <form enctype="multipart/form-data" id="demo-form" method="POST"
            action="{{route('admin1.index') }}" data-parsley-validate
            class="form-horizontal form-label-left">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <div class="row">

                <div class='col-sm-4'>
                    <div>

                        <input required="" name="Año1" class="date form-control" type="number" name="numero" placeholder="Seleccione un año">
                    </div>

                    <script type="text/javascript">
                        $('.date').datepicker({
                            format: "yyyy",
                            viewMode: "years",
                            minViewMode: "years"
                        });

                    </script>

                </div>
                <div class='col-sm-4'>
                    <div>

                        <input required="" name="Año2" class="date form-control" type="number" name="numero" placeholder="Seleccione un año">
                    </div>

                    <script type="text/javascript">
                        $('.date').datepicker({
                            format: "yyyy",
                            viewMode: "years",
                            minViewMode: "years"
                        });

                    </script>

                </div>
                <div >
                    <button type="submit" class="btn btn-md col-md-3 btn-primary">Buscar</button>
                </div>

            </div>

        </form>



        @if ($bandera == true)
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-solid">
                        <div class="box-body">
                            {!! $usersChart->container() !!}
                        </div>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8">
                        </script>
                        {!! $usersChart->script() !!}
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-solid">
                        <div class="box-body">
                            {!! $usersChart1->container() !!}
                        </div>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8">
                        </script>
                        {!! $usersChart1->script() !!}
                    </div>
                </div>

            </div>


        @endif
        <div class="row">
            <div class="container">
                <h1>Estadistica de Usuarios del 2021 y Distribucion</h1>

            </div>

        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="box box-solid">
                    <div class="box-body">
                        {!! $userEnrolled->container() !!}
                    </div>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/6.0.6/highcharts.js" charset="utf-8">
                    </script>
                    {!! $userEnrolled->script() !!}
                </div>
            </div>

            <div class="col-md-4">
                <div class="box box-solid">
                    <div class="box-body">
                        {!! $pieChart->container() !!}
                    </div>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8">
                    </script>
                    {!! $pieChart->script() !!}
                </div>
            </div>
        </div>


        <div class="row">

            <div class="col-md-4">

                <div class="box box-danger">
                    <div class="box-header with-border">
                        <h3 class="box-title">Todos los Usuarios</h3>

                        <div class="box-tools pull-right">
                            <span class="label label-danger">
                                @php
                                    $user = SistemaWeb\Persona::all();
                                    if (count($user) > 0) {
                                        echo count($user);
                                    } else {
                                        echo '0';
                                    }
                                @endphp
                                Usuarios
                            </span>
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                    class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body no-padding">
                        @php
                            $users = SistemaWeb\Persona::limit(8)
                                ->orderBy('Id_Persona', 'DESC')
                                ->get();
                        @endphp
                        <ul class="users-list clearfix">
                            @foreach ($users as $user)
                                <li>
                                    @if ($user['Foto'] != null || $user['Foto'] != '')
                                        <img src="{{ url('http://localhost/ProyectoIsabel/Imagenes/Usuarios/' . $user->Foto) }} "
                                            style="height:65px">


                                    @else
                                        <img src="{{ asset('images/default/user.jpg') }}" class="img-fluid"
                                            alt="User Image">
                                    @endif
                                    <a class="users-list-name" href="#">{{ $user['Nombres'] }}
                                        {{ $user['Apellidos'] }}</a>
                                    <span
                                        class="users-list-date">{{ date('F Y', strtotime($user['FechaRegistro'])) }}</span>
                                </li>
                            @endforeach
                        </ul>

                    </div>
                    <div class="box-footer text-center">
                        <a href="{{ route('persona.index') }}" class="uppercase">ver todos</a>
                    </div>
                </div>





                @php
                    $courses = SistemaWeb\Curso::limit(5)
                        ->orderBy('Id_Curso', 'DESC')
                        ->get();
                @endphp
                @if (!$courses->isEmpty())
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Cursos Recientes</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                        class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <ul class="products-list product-list-in-box">

                                @foreach ($courses as $course)
                                    <li class="item">
                                        <div class="product-img">
                                            @if ($course['Foto'] !== null && $course['Foto'] !== '')
                                                <img src="{{ url('http://localhost/ProyectoIsabel/Imagenes/Cursos/' . $course->Foto) }} "
                                                    alt="Course Image">

                                            @else

                                                <img src="{{ asset('images/default/user.jpg') }}" class="img-fluid"
                                                    alt="Course Image">
                                            @endif

                                        </div>
                                        <div class="product-info">
                                            <a href="javascript:void(0)"
                                                class="product-title">{{ str_limit($course['Titulo'], $limit = 25, $end = '...') }}
                                                <span class="label label-warning pull-right">

                                                    Gratis

                                                </span></a>

                                            <span class="product-description">
                                                {{ str_limit($course->Descripcion, $limit = 40, $end = '...') }}
                                            </span>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer text-center">
                            <a href="{{ route('curso.index') }}" class="uppercase">Ver todos</a>
                        </div>
                        <!-- /.box-footer -->
                    </div>
                @endif

            </div>





            <div class="col-md-8">
                <!-- TABLE: LATEST ORDERS -->
                @php
                    $sql = "select
                                                                                                                                                  a.Nombres as Nombres,
                                                                                                                                                  a.Apellidos as Apellidos,
                                                                                                                                                  c.Id_Curso as Id_Curso,
                                                                                                                                                  c.Titulo as  Titulo,
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
                                                                                                                                                  c.Titulo";
                    $Aprovados = DB::select($sql, [1, 20]);

                @endphp
                @if (!empty($Aprovados))
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">Personas Aprobados</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                        class="fa fa-times"></i></button>
                            </div>
                        </div>

                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table no-margin">
                                    <thead>
                                        <tr>
                                            <th>Usuario</th>
                                            <th>Curso</th>
                                            <th>Nota del Examen</th>
                                            <th>Fecha</th>
                                            <th>Aprobado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
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
                                            $Aprobados = DB::select($sql, [1, 20]);
                                        @endphp

                                        @foreach ($Aprobados as $Aprobado)
                                            @if ($Aprobado->Aprobados == 1)
                                                <tr>
                                                    <td><a href="#">{{ $Aprobado->Nombres }}
                                                            {{ $Aprobado->Apellidos }}</a></td>
                                                    <td>
                                                        @if ($Aprobado->Id_Curso != null)
                                                            {{ $Aprobado->Titulo }}
                                                        @else
                                                            No tiene nombre
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <span class="label label-success"> {{ $Aprobado->Nota }} </span>
                                                    </td>
                                                    <td>
                                                        <div class="sparkbar" data-color="#00a65a" data-height="20">
                                                            {{ date('jS F Y', strtotime($Aprobado->Fecha)) }}</div>
                                                    </td>
                                                    <td>
                                                        @if ($Aprobado->Aprobados != 0)
                                                            <a>Aprobado</a>
                                                        @else
                                                            <a>No Aprobado</a>
                                                        @endif

                                                    </td>
                                                </tr>

                                            @endif

                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>

                        <div class="box-footer clearfix">
                            <a href="{{ route('aprobados.index') }}"
                                class="btn btn-sm btn-default btn-flat pull-right">Ver
                                Todos los aprobados</a>
                        </div>

                    </div>
                @endif

                <!-- /.box (Instructor box) -->
            </div>

            <div class="col-md-8">
                <!-- TABLE: LATEST ORDERS -->
                @php
                    $sql = "select
                                                                                                                                                  a.Nombres as Nombres,
                                                                                                                                                  a.Apellidos as Apellidos,
                                                                                                                                                  c.Id_Curso as Id_Curso,
                                                                                                                                                  c.Titulo as  Titulo,
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
                                                                                                                                                  c.Titulo";
                    $Aprovados = DB::select($sql, [1, 20]);

                @endphp
                @if (!empty($Aprovados))
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">Progresos de los Usuarios</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                        class="fa fa-times"></i></button>
                            </div>
                        </div>

                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table no-margin">
                                    <thead>
                                        <tr>
                                            <th>Usuario</th>
                                            <th>Curso</th>
                                            <th>% del Contenido</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
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
                                            $Aprobados = DB::select($sql, [1, 20]);
                                        @endphp

                                        @foreach ($Aprobados as $Aprobado)
                                            <tr>
                                                <td><a href="#">{{ $Aprobado->NombresEstudiante }}
                                                        {{ $Aprobado->ApellidosEstudiante }}</a></td>
                                                <td>
                                                    @if ($Aprobado->Id_Curso != null)
                                                        {{ $Aprobado->Titulo }}
                                                    @else
                                                        No tiene nombre
                                                    @endif
                                                </td>
                                                <td>
                                                    <span class="label label-success"> {{ $Aprobado->TotalContenido }}/80
                                                    </span>
                                                </td>


                                            </tr>

                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>

                        <div class="box-footer clearfix">
                            <a href="{{ route('progreso.index') }}"
                                class="btn btn-sm btn-default btn-flat pull-right">Ver
                                Todos los progresos</a>
                        </div>

                    </div>
                @endif

                <!-- /.box (Instructor box) -->
            </div>
        </div>

    </section>

@endsection
