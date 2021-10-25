<section class="content">

    <div class="row">
        <div class="col-md-12">
            <a data-toggle="modal" data-target="#myModalp1" href="#" class="btn btn-info btn-sm">+ Agregar Preguntas del
                Curso</a>
            <br>
            <br>
            <div class="table-responsive">
                <table id="example2" class="table table-bordered table-striped db">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tipo Pregunta</th>
                            <th>Pregunta</th>

                            <th>Opcion de Respuesta</th>
                            <th>Editar</th>
                            <th>Eliminar</th>

                        </tr>
                    </thead>
                    <tbody id="sortable">
                        <?php $i = 0; ?>
                        @foreach ($PreguntaQuiz as $cat)
                            <tr class="sortable row1" data-id="{{ $cat->Id_PreguntaQuiz }}">
                                <?php $i++; ?>
                                <td><?php echo $i; ?></td>
                                <td>{{ $cat->TipoPregunta }}</td>
                                <td>{{ $cat->Pregunta }}</td>

                                <td>{{ $cat->RespuestaCorrecta }}</td>


                                <td>
                                    <a class="btn btn-success btn-sm"  href="{{ route('pregunta.show', $cat->Id_PreguntaQuiz) }}"><i class="glyphicon glyphicon-pencil"></i></a>
                                </td>
                                <td>
                                    <form method="post"
                                        action="{{ route('curso.pregunta.delete', $cat->Id_PreguntaQuiz) }}"
                                        data-parsley-validate class="form-horizontal form-label-left">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button onclick="return confirm('Esta seguro que desea elminarlo?')"
                                            type="submit" class="btn btn-danger"><i
                                                class="fa fa-fw fa-trash-o"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="myModalp1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Agregar Questionario para el Curso</h4>
                </div>
                <div class="box box-primary">
                    <div class="panel panel-sum">
                        <div class="modal-body">
                            <form id="demo-form2" method="post" action="{{ route('curso.pregunta.guardar') }}"
                                data-parsley-validate class="form-horizontal form-label-left"
                                enctype="multipart/form-data">
                                {{ csrf_field() }}

                                <select name="Id_TipoPregunta" class="form-control display-none">
                                    <option value="2">2</option>
                                </select>
                                <select name="Id_Curso" class="form-control display-none">
                                    <option value="{{ $Cur->Id_Curso }}">{{ $Cur->Titulo }}</option>
                                </select>


                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="exampleInputTit1e">Pregunta:<span class="redstar">*</span> </label>
                                        <textarea placeholder="Ingrese la pregunta" type="text" name="Pregunta" rows="3"
                                            class="form-control" required=""></textarea>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="exampleInputTit1e">Respuesta Correcta:<span class="redstar">*</span>
                                        </label>
                                        <input type="text" required=""
                                            placeholder="Ingrese el # de la respuesta correcta ejemplo: 1 al 4"
                                            class="form-control " name="RespuestaCorrecta" id="exampleInputTitle"
                                            value="">
                                    </div>
                                    <div class="col-md-6">

                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="exampleInputTit1e">Explicación: </label>
                                        <textarea placeholder="Ingrese la explicacion de la respuesta" type="text"
                                            name="Explicacion" rows="3" class="form-control"></textarea>
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
