<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Aprendizaje Contenido Tecnológico </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="{{ url('Admin/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ url('css/datepicker.css') }}">
    <link rel="icon" type="image/icon" href="{{ asset('images/favicon/favicon.png') }}"> <!-- favicon-icon -->
    <link rel="stylesheet" href="{{ url('Admin/css/select2.min.css') }}"> <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ url('Admin/bower_components/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ url('css/fontawesome-iconpicker.min.css') }}">
    <link rel="stylesheet" href="{{ url('Admin/css/jquery-ui.css') }}">

    <link rel="stylesheet" href="{{ url('Admin/bower_components/Ionicons/css/ionicons.min.css') }}">

    <!-- DataTables -->
    <link rel="stylesheet"
        href="{{ url('Admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet"
        href="{{ url('Admin/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet"
        href="{{ url('Admin/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">

    <link rel="stylesheet" href="{{ url('Admin/dist/css/AdminLTE.min.css') }}">


    <link rel="stylesheet" href="{{ url('css/toggle.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('css/component.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('css/normalize.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('Admin/plugins/pace/pace.min.css') }}">
    <link rel="stylesheet" href="{{ url('Admin/dist/css/skins/_all-skins.min.css') }}">
    <link href="{{ url('Admin/css/bootstrap-toggle.min.css') }}">
    <link rel="stylesheet" href="{{ url('css/animate.min.css') }}"><!-- Custom Css -->

    <link rel="stylesheet" href="{{ url('Admin/css/admin.css') }}">

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>

    <link rel="stylesheet" href="{{ asset('css/custom-style.css') }}" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="{{ url('Admin/font/font/flaticon.css') }}" /> <!-- fontawesome css -->

</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        @include('sweetalert::alert')
        <header class="main-header">

            <!-- Logo -->
            <a class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini">
                    <img title="ICISABEL" width="20px" src="{{ url('images/favicon/favicon.png') }}" alt="" />
                </span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"> <img title="ICISABEL" width="100px" src="{{ url('images/logo/logo.png') }}"
                        alt="" /></span>
            </a>

            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>

                </a>
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->

                        <!-- User Account: style can be found in dropdown.less -->

                        <li class="dropdown user user-menu">
                            @php
                                $sql =
                                    "select
                                                                                                                            a.Id_Persona as Id_Persona,
                                                                                                                            a.Nombres as Nombres,
                                                                                                                            a.Apellidos as Apellidos,
                                                                                                                            u.created_at as create_at,
                                                                                                                            a.Foto as Foto
                                                                                                                        from
                                                                                                                            persona a,users u
                                                                                                                        where
                                                                                                                            u.id=a.Id_InicioSesion and a.Id_InicioSesion =" . Auth::User()->id;
                                $Usuario = DB::select($sql, [1, 20]);

                            @endphp
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                @if ($Usuario[0]->Foto != null && $Usuario[0]->Foto != '')
                                    <img style="width: 25px; height: 25spx;"
                                        src="{{ url('http://localhost/ProyectoIsabel/Imagenes/Usuarios/' . $Usuario[0]->Foto) }} "
                                        class="img-circle" alt="">

                                @else
                                    <img src="{{ asset('images/default/user.jpg') }}" class="img-circle" alt="">

                                @endif
                                <span class="hidden-xs">Hola ! {{ $Usuario[0]->Nombres }}
                                    {{ $Usuario[0]->Apellidos }}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    @if ($Usuario[0]->Foto != null && $Usuario[0]->Foto != '')
                                        <img src="{{ url('http://localhost/ProyectoIsabel/Imagenes/Usuarios/' . $Usuario[0]->Foto) }} "
                                            class="img-circle" alt="">

                                    @else
                                        <img src="{{ asset('images/default/user.jpg') }}" class="img-circle" alt="">

                                    @endif
                                    </br>
                                    <p>
                                        {{ $Usuario[0]->Nombres }} {{ $Usuario[0]->Apellidos }}
                                        <small>Fecha:
                                            {{ date('jS F Y', strtotime(Auth::User()['created_at'])) }}</small>
                                    </p>

                                </li>

                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="{{ route('persona.edit', $Usuario[0]->Id_Persona) }}"
                                            class="btn btn-default btn-flat">Editar Perfil</a>
                                    </div>
                                    <div class="pull-right">

                                        <a class="btn btn-default btn-flat" href="{{ route('logout') }}" onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();">
                                            Cerrar sesión
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            </ul>

                        </li>
                        <!-- Control Sidebar Toggle Button -->
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();">
                                Cerrar sesion
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                @csrf
                            </form>
                        </li>

                    </ul>
                </div>

            </nav>
        </header>
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- Sidebar user panel -->
                <div class="user-panel">
                    <div class="pull-left image">
                        @php
                            $sql =
                                "select
                                                                                                                a.Nombres as Nombres,
                                                                                                                a.Apellidos as Apellidos,
                                                                                                                a.Foto as Foto
                                                                                                            from
                                                                                                                persona a
                                                                                                            where
                                                                                                                a.Id_InicioSesion =" . Auth::User()->id;
                            $Usuario = DB::select($sql, [1, 20]);

                        @endphp
                        @if ($Usuario[0]->Foto != null && $Usuario[0]->Foto != '')
                            <img src="{{ url('http://localhost/ProyectoIsabel/Imagenes/Usuarios/' . $Usuario[0]->Foto) }} "
                                class="img-circle" alt="">

                        @else
                            <img src="{{ asset('images/default/user.jpg') }}" class="img-circle" alt="">

                        @endif
                    </div>
                    <div class="pull-left info">
                        <p>{{ $Usuario[0]->Nombres }} {{ $Usuario[0]->Apellidos }}</p>
                        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                    </div>
                </div>
                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="header">Menu de Navegación</li>

                    <li class="{{ Nav::isRoute('admin.index') }}"><a href="{{ route('admin.index') }}"><i
                                class="flaticon-web-browser" aria-hidden="true"></i><span>Dashboard</span></a></li>

                    <li
                        class="{{ Nav::isRoute('user.index') }} {{ Nav::isRoute('user.add') }} {{ Nav::isRoute('user.edit') }}">
                        <a href="{{ route('persona.index') }}"><i class="flaticon-user"
                                aria-hidden="true"></i><span>Usuarios</span></a>
                    </li>
                    <li
                        class="{{ Nav::isResource('category') }} {{ Nav::isResource('subcategory') }} {{ Nav::isResource('childcategory') }} {{ Nav::isResource('course') }} {{ Nav::isResource('bundle') }} {{ Nav::isResource('courselang') }} treeview">
                        <a href="#">
                            <i class="flaticon-browser-1"></i>Cursos
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li>



                            <li><a href="{{ route('categoria.index') }}"><i class="flaticon-interface"
                                        aria-hidden="true"></i><span>Categorias</span></a></li>
                            <li><a href="{{ route('curso.index') }}"><i class="flaticon-document"
                                        aria-hidden="true"></i><span>Cursos</span></a></li>

                    </li>
                </ul>
                </li>
                <li><a href="{{ route('onesignal.settings') }}"><i class="fa fa-location-arrow"
                            aria-hidden="true"></i><span>Enviar Mensaje</span></a></li>



                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>





        <!--Contenido-->
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <!-- Main content -->
            <section class="content">

                <div class="row">
                    <div class="col-md-12">
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Sistema Aprendizaje Virtual</h3>
                                <div class="box-tools pull-right">
                                    <button class="btn btn-box-tool" data-widget="collapse"><i
                                            class="fa fa-minus"></i></button>

                                    <button class="btn btn-box-tool" data-widget="remove"><i
                                            class="fa fa-times"></i></button>
                                </div>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <!--Contenido-->
                                        @yield('contenido')
                                        <!--Fin Contenido-->
                                    </div>
                                </div>

                            </div>
                        </div><!-- /.row -->
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->

    </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
    <!--Fin-Contenido-->
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 2.3.0
        </div>
        <strong>Copyright &copy; 2015-2020 <a href="www.incanatoit.com">IncanatoIT</a>.</strong> All rights reserved.
    </footer>


    <!-- jQuery 3 -->
    <script src="{{ url('Admin/bower_components/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ url('Admin/js/select2.min.js') }}"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{ url('Admin/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- DataTables -->
    <script src="{{ url('Admin/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('Admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <!-- SlimScroll -->
    <script src="{{ url('Admin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ url('Admin/bower_components/fastclick/lib/fastclick.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ url('Admin/dist/js/adminlte.min.js') }}"></script> <!-- AdminLTE for demo purposes -->
    <script src="{{ url('Admin/dist/js/demo.js') }}"></script>
    <script src="{{ URL::asset('Admin/bower_components/PACE/pace.min.js') }}"></script>
    <!-- PACE -->
    <script src="{{ URL::asset('Admin/bower_components/ckeditor/ckeditor.js') }}"></script>
    <!-- CK Editor -->
    <script
        src="{{ URL::asset('Admin/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}">
    </script> <!-- bootstrap datepicker -->
    <script src="{{ url('Admin/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}">
    </script>
    <script src="{{ url('Admin/js/jquery-ui.js') }}"></script>
    <script src="{{ url('js/custom-toggle.js') }}"></script>
    <script src="{{ url('js/custom-file-input.js') }}"></script>
    <script src="{{ url('js/fontawesome-iconpicker.js') }}"></script>
    <script src="{{ url('Admin/js/courseclass.js') }}"></script>

    <script src="{{ url('Admin/js/tinymce.min.js') }}"></script>
    <script src="{{ url('Admin/bower_components/moment/moment.js') }}"></script>
    <script src="{{ url('js/datepicker.js') }}"></script>
    <script src="{{ url('js/custom-js.js') }}"></script>

    <script src="{{ url('Admin/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ url('Admin/js/buttons.flash.min.js') }}"></script>
    <script src="{{ url('Admin/js/jszip.min.js') }}"></script>
    <script src="{{ url('Admin/js/pdfmake.min.js') }}"></script>
    <script src="{{ url('Admin/js/vfs_fonts.js') }}"></script>
    <script src="{{ url('Admin/js/buttons.html5.min.js') }}"></script>
    <script src="{{ url('Admin/js/buttons.print.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <script src="{{ url('js/subscription-pricing.js') }}"></script>
    <script>
        window.setTimeout(function() {
            $(".alert").fadeTo(300, 0).slideUp(500, function() {
                $(this).remove();
            });
        }, 2000);

    </script>
    <!-- page script -->
    <script>
        $(function() {
            $('#example1').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'csv', 'excel', 'pdf'

                ],
                'paging': true,
                'lengthChange': true,
                'searching': true,
                'ordering': true,
                'info': true,
                'autoWidth': true
            });
        });

    </script>

    <script>
        $(document).ready(function() {
            $('#example2').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'csv', 'excel', 'pdf'
                ],
                'paging': true,
                'lengthChange': true,
                'searching': true,
                'ordering': true,
                'info': true,
                'autoWidth': true
            });
        });

    </script>
    <script>
        $(document).ready(function() {
            $('#example3').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'csv', 'excel', 'pdf'
                ],
                'paging': true,
                'lengthChange': true,
                'searching': true,
                'ordering': true,
                'info': true,
                'autoWidth': true
            });
        });

    </script>
    <script>
        $(document).ready(function() {
            $('#example5').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'csv', 'excel', 'pdf'
                ],
                'paging': true,
                'lengthChange': true,
                'searching': true,
                'ordering': true,
                'info': true,
                'autoWidth': true
            });
        });

    </script>
    <script>
        $(document).ready(function() {
            $('#example4').DataTable({
                dom: 'Bfrtip',
                buttons: [{

                    extend: 'pdfHtml5',
                    customize: function(doc) {
                        console.dir(doc)
                        doc.content[1].table.widths =
                            Array(doc.content[1].table.body[0].length + 1).join('*').split(
                                '');
                    }
                }],
                'paging': true,
                'lengthChange': true,
                'searching': true,
                'ordering': true,
                'info': true,
                'autoWidth': true
            });
        });

    </script>

    <script>
        $(function() {
            $('.js-example-basic-single').select2({
                tags: true,

                tokenSeparators: [';', '\n', '\t']
            });
        });

    </script>
    <script>
        $(function() {
            $('.js-example-basic-single1').select2({
                tags: true,

                tokenSeparators: [';', '\n', '\t']
            });
        });

    </script>
    <script type="text/javascript">
        $(function() {
            $('#datetimepicker1').datepicker({
                format: "yy",
                weekStart: 0,
                calendarWeeks: true,
                autoclose: true,
                todayHighlight: true,
                orientation: "auto"
            });
        });

    </script>
</body>

</html>
