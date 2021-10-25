@extends('Admin/layouts.admin')

@section('contenido')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <section class="content">
        @include('Admin.message')

        <div class="row">
            <div class="col-md-7">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Editar Preguntas del Quiz</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <form enctype="multipart/form-data" id="demo-form" method="post"
                                action="{{ route('curso.preguntas.update', $Pregunta->Id_PreguntaQuiz) }}"
                                data-parsley-validate class="form-horizontal form-label-left">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}

                                <select name="Id_TipoPregunta" class="form-control display-none">
                                    <option value="2">2</option>
                                </select>
                                <select name="Id_Curso" class="form-control display-none">
                                    <option value="{{ $Pregunta->Id_Curso }}">{{ $Pregunta->Id_Curso }}</option>
                                </select>


                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="exampleInputTit1e">Pregunta:<span class="redstar">*</span> </label>
                                        <textarea placeholder="Ingrese la pregunta" type="text" name="Pregunta" rows="3"
                                            class="form-control" required="">{!! $Pregunta->Pregunta !!}</textarea>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="exampleInputTit1e">Respuesta Correcta:<span class="redstar">*</span>
                                        </label>
                                        <input type="text" required=""
                                            placeholder="Ingrese el # de la respuesta correcta ejemplo: 1 al 5"
                                            class="form-control " name="RespuestaCorrecta" id="exampleInputTitle" value="{{ $Pregunta->RespuestaCorrecta }}">
                                    </div>
                                    <div class="col-md-6">

                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="exampleInputTit1e">Explicación: </label>
                                        <textarea placeholder="Ingrese la explicacion de la respuesta" type="text"
                                            name="Explicacion" rows="3" class="form-control">{!! $Pregunta->Explicacion !!}</textarea>
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


    </section>
@endsection

@section('scripts')

    <script>
        (function($) {
            "use strict";

            $(function() {
                $("#dob,#doa").datepicker({
                    changeYear: true,
                    yearRange: "-100:+0",
                    dateFormat: 'yy/mm/dd',
                });
            });


            $('#married_status').change(function() {

                if ($(this).val() == 'Married') {
                    $('#doaboxxx').show();
                } else {
                    $('#doaboxxx').hide();
                }
            });

            $(function() {
                var urlLike = '{{ url('country/dropdown') }}';
                $('#country_id').change(function() {
                    var up = $('#upload_id').empty();
                    var cat_id = $(this).val();
                    if (cat_id) {
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            type: "GET",
                            url: urlLike,
                            data: {
                                catId: cat_id
                            },
                            success: function(data) {
                                console.log(data);
                                up.append('<option value="0">Please Choose</option>');
                                $.each(data, function(id, title) {
                                    up.append($('<option>', {
                                        value: id,
                                        text: title
                                    }));
                                });
                            },
                            error: function(XMLHttpRequest, textStatus, errorThrown) {
                                console.log(XMLHttpRequest);
                            }
                        });
                    }
                });
            });

            $(function() {
                var urlLike = '{{ url('country/gcity') }}';
                $('#upload_id').change(function() {
                    var up = $('#grand').empty();
                    var cat_id = $(this).val();
                    if (cat_id) {
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            type: "GET",
                            url: urlLike,
                            data: {
                                catId: cat_id
                            },
                            success: function(data) {
                                console.log(data);
                                up.append('<option value="0">Please Choose</option>');
                                $.each(data, function(id, title) {
                                    up.append($('<option>', {
                                        value: id,
                                        text: title
                                    }));
                                });
                            },
                            error: function(XMLHttpRequest, textStatus, errorThrown) {
                                console.log(XMLHttpRequest);
                            }
                        });
                    }
                });
            });

        })(jQuery);

    </script>

    <script>
        function myFunction() {
            var checkBox = document.getElementById("myCheck");
            var text = document.getElementById("update-password");
            if (checkBox.checked == true) {
                text.style.display = "block";
            } else {
                text.style.display = "none";
            }
        }

    </script>

@endsection
