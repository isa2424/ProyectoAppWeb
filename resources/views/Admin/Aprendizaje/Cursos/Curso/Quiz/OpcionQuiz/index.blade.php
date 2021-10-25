<section class="content">

    <div class="row">
        <div class="col-md-12">
            <a data-toggle="modal" data-target="#myModalanswer" href="#" class="btn btn-info btn-sm">+ Agregar
                respuestas</a>
            <div class="table-responsive">
                <table id="example3" class="table table-bordered table-striped db">
                    <thead>
                        <tr>
                            <th>#</th>

                            <th>Pregunta</th>

                            <th>Opciones</th>
                            <th>Editar</th>

                        </tr>
                    </thead>
                    <tbody id="sortable">
                        <?php $i = 0; ?>
                        @foreach ($OpcionQuiz as $cat)
                            <tr class="sortable row1" data-id="{{ $cat->Id_OpcionQuiz }}">
                                <?php $i++; ?>
                                <td><?php echo $i; ?></td>

                                <td>{{ str_limit($cat->Pregunta, $limit = 100, $end = '...') }}</td>

                                <td>{{ str_limit($cat->OpcionRespuesta, $limit = 100, $end = '...') }}</td>


                                <td>
                                    <a class="btn btn-success btn-sm" href="{{ route('opcion.show', [$cat->Id_OpcionQuiz,$Cur->Id_Curso]) }}"><i class="glyphicon glyphicon-pencil"></i></a>
                                </td>
                                <td>
                                    <form method="post"
                                        action="{{ route('curso.opcion.delete',[ $cat->Id_OpcionQuiz,$Cur->Id_Curso]) }}"
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

    <div class="modal fade" id="myModalanswer"  role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"> Agregar respuestas para la pregunta</h4>
                </div>
                <div class="box box-primary">
                    <div class="panel panel-sum">
                        <div class="modal-body">
                            <form id="demo-form2" method="post" action="{{ route('curso.opciones.guardar') }}"
                                data-parsley-validate class="form-horizontal form-label-left">
                                {{ csrf_field() }}
                                <select name="Id_Curso" class="form-control display-none">
                                    <option value="{{ $Cur->Id_Curso }}">{{ $Cur->Titulo }}</option>
                                </select>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label
                                            for="exampleInputTit1e">Seleccione la Pregunta:<sup
                                                class="redstar">*</sup></label>
                                        <br>
                                        <select style="width: 100%" name="Id_PreguntaQuiz" required=""
                                            class="form-control col-md-7 col-xs-12 js-example-basic-single1">
                                            <option value="none" selected disabled hidden>
                                               Seleccione una Opcion
                                            </option>
                                            @foreach ($PreguntaQuiz as $ques)
                                                <option value="{{ $ques->Id_PreguntaQuiz }}">{{ $ques->Pregunta }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                                <br>

                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="exampleInputTit1e">Opcion de la Pregunta:<span class="redstar">*</span>
                                        </label>
                                        <input type="text" required=""
                                            placeholder="Ingrese el # de la opcion de la pregunta correcta ejemplo: 1 al 4"
                                            class="form-control " name="OpcionNumero" id="exampleInputTitle"
                                            value="">
                                    </div>
                                    <div class="col-md-6">

                                    </div>
                                </div>
                                <br>

                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="exampleInput">Opcion de la respuesta:<sup
                                                class="redstar">*</sup></label>
                                        <textarea required="" name="OpcionRespuesta" rows="4" class="form-control"
                                            placeholder="Ingrese la respuesta de la pregunta"></textarea>
                                    </div>
                                </div>
                                <br>



                                <div class="box-footer">
                                    <button type="submit" value="Add Answer" class="btn btn-md col-md-3 btn-primary">+
                                        Guardar</button>
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
