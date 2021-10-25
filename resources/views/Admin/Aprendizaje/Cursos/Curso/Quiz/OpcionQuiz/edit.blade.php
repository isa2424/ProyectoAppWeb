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
                        <h3 class="box-title">Editar Opcion de la pregunta</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <form enctype="multipart/form-data" id="demo-form" method="post"
                                action="{{ route('curso.opcion.update', $Opcion->Id_OpcionQuiz) }}"
                                data-parsley-validate class="form-horizontal form-label-left">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}

                                <select name="Id_PreguntaQuiz" class="form-control display-none">
                                    <option value="{{ $Opcion->Id_PreguntaQuiz }}">{{ $Opcion->Id_PreguntaQuiz }}</option>
                                </select>
                                <select name="Id_Curso" class="form-control display-none">
                                    <option value="{{ $Curso['Id_Curso'] }}">{{ $Curso['Id_Curso'] }}</option>
                                </select>


                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="exampleInputTit1e">Opcion de la Pregunta:<span class="redstar">*</span>
                                        </label>
                                        <input readonly type="text" required=""
                                            placeholder="Ingrese el # de la opcion de la pregunta correcta ejemplo: 1 al 4"
                                            class="form-control " name="OpcionNumero" id="exampleInputTitle"
                                            value="{{ $Opcion->OpcionNumero }}">
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
                                            placeholder="Ingrese la respuesta de la pregunta">{!! $Opcion->OpcionRespuesta !!}</textarea>
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
