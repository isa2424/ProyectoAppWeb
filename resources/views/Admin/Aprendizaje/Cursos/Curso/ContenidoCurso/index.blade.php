<section class="content">

    <div class="row">
        <div class="col-md-12">
            <a data-toggle="modal" data-target="#myModalp" href="#" class="btn btn-info btn-sm">+ Agregar Contenido</a>
            <br>
            <br>
            <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped db">
                    <thead>
                        <tr>
                            <th>#</th>

                            <th>Titulo</th>

                            <th>Direccion Video</th>
                            <th>Editar</th>

                        </tr>
                    </thead>
                    <tbody id="sortable">
                        <?php $i = 0; ?>
                        @foreach ($ContenidoCurso as $cat)
                            <tr class="sortable row1" data-id="{{ $cat->Id_ContenidoCurso }}">
                                <?php $i++; ?>
                                <td><?php echo $i; ?></td>

                                <td>{{ $cat->Titulo }}</td>

                                <td>{{ $cat->DireccionVideo }}</td>


                                <td>
                                    <a class="btn btn-success btn-sm"
                                        href="{{ route('contenido.show', $cat->Id_ContenidoCurso) }}"><i
                                            class="glyphicon glyphicon-pencil"></i></a>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>



    <div class="modal fade" id="myModalp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Agregar Contenido de para el Curso</h4>
                </div>
                <div class="box box-primary">
                    <div class="panel panel-sum">
                        <div class="modal-body">
                            <form id="demo-form2" method="post" action="{{ route('curso.contenido.guardar') }}"
                                data-parsley-validate class="form-horizontal form-label-left"
                                enctype="multipart/form-data">
                                {{ csrf_field() }}

                                <select name="Id_Curso" class="form-control display-none">
                                    <option value="{{ $Cur->Id_Curso }}">{{ $Cur->Titulo }}</option>
                                </select>

                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="exampleInputTit1e">Titulo del video:<span class="redstar">*</span>
                                        </label>
                                        <input type="text" required="" placeholder="Ingrese el Titulo"
                                            class="form-control " name="Titulo" id="exampleInputTitle" value="">
                                    </div>
                                    <div class="col-md-6">

                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="exampleInputTit1e">Descripcion del video:<span
                                                class="redstar">*</span> </label>
                                        <textarea placeholder="Ingrese una descripción" type="text" name="Descripcion"
                                            rows="3" class="form-control" required=""></textarea>
                                    </div>
                                    <div class="col-md-6">

                                    </div>
                                </div>
                                <br>

                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="exampleInputTit1e">Ingrese la direccion de la imagen:<span
                                                class="redstar">*</span> </label>
                                        <input type="text" required=""
                                            placeholder="ejemplo:http://localhost/ProyectoIsabel/ContenidoCursos/CursoIOT/Imagen/Video2.png"
                                            class="form-control " name="DireccionImagen" id="exampleInputTitle"
                                            value="">
                                    </div>
                                    <div class="col-md-6">

                                    </div>
                                </div>
                                <br>

                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="exampleInputTit1e">Ingrese la direccion del Video:<span
                                                class="redstar">*</span> </label>
                                        <input type="text" required=""
                                            placeholder="ejemplo:http://localhost/ProyectoIsabel/ContenidoCursos/CursoIOT/Videos/CAPÍTULO0_IOT-Introducción al IoT.mp4"
                                            class="form-control " name="DireccionVideo" id="exampleInputTitle" value="">
                                    </div>
                                    <div class="col-md-6">

                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="exampleInputTit1e">Formato del Video:<span class="redstar">*</span>
                                        </label>
                                        <input readonly type="text" required="" placeholder="Ingrese el Titulo"
                                            class="form-control " name="TipoVideo" id="exampleInputTitle"
                                            value="video/mp4">
                                    </div>
                                    <div class="col-md-6">

                                    </div>
                                </div>
                                <br>



                                <div class="box-footer">
                                    <button type="submit" class="btn btn-md col-md-3 btn-primary">Guardar</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>








</section>



@section('script')
    <!--courseclass.js is included -->




    <script type="text/javascript">
        $('#previewvid').on('change', function() {

            if ($('#previewvid').is(':checked')) {
                $('#document11').show('fast');
                $('#document22').hide('fast');
            } else {
                $('#document22').show('fast');
                $('#document11').hide('fast');
            }

        });

    </script>

    <script>
        $("#sortable").sortable({
            items: "tr",
            cursor: 'move',
            opacity: 0.6,
            update: function() {
                sendOrderToServer();
            }
        });

    </script>

@endsection

@section('stylesheets')

    <style type="text/css">
        .modal {
            overflow-y: auto;
        }


        body {
            background-color: #efefef;
        }

        .container-4 input#hyv-search {
            width: 500px;
            height: 30px;
            border: 1px solid #c6c6c6;
            font-size: 10pt;
            float: left;
            padding-left: 15px;
            -webkit-border-top-left-radius: 5px;
            -webkit-border-bottom-left-radius: 5px;
            -moz-border-top-left-radius: 5px;
            -moz-border-bottom-left-radius: 5px;
            border-top-left-radius: 5px;
            border-bottom-left-radius: 5px;
        }

        .container-4 input#vimeo-search {
            width: 500px;
            height: 30px;
            border: 1px solid #c6c6c6;
            font-size: 10pt;
            float: left;
            padding-left: 15px;
            -webkit-border-top-left-radius: 5px;
            -webkit-border-bottom-left-radius: 5px;
            -moz-border-top-left-radius: 5px;
            -moz-border-bottom-left-radius: 5px;
            border-top-left-radius: 5px;
            border-bottom-left-radius: 5px;
        }

        .container-4 button.icon {
            height: 34px;
            background: #F0F0EF url(../../images/icons/searchicon.png) 10px 1px no-repeat;
            background-size: 24px;
            -webkit-border-top-right-radius: 5px;
            -webkit-border-bottom-right-radius: 5px;
            -moz-border-radius-topright: 5px;
            -moz-border-radius-bottomright: 5px;
            border-top-right-radius: 5px;
            border-bottom-right-radius: 5px;
            border: 1px solid #c6c6c6;
            width: 50px;
            margin-left: -44px;
            color: #4f5b66;
            font-size: 10pt;
        }

        button#pageTokenNext {
            margin-left: 5px;
            border-radius: 3px;
            margin-bottom: 20px;
        }

        button#vpageTokenNext {
            margin-left: 5px;
            border-radius: 3px;
            margin-bottom: 20px;
        }

    </style>



@endsection
