@extends('Admin/layouts.admin')

@section ('contenido')

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
          <h3 class="box-title">Editar Contenido del Curso</h3>
        </div>
        <div class="box-body">
          <div class="form-group">
            <form enctype="multipart/form-data" id="demo-form" method="post" action="{{route('curso.contenido.update',$Contenido->Id_ContenidoCurso)}}" data-parsley-validate class="form-horizontal form-label-left">
              {{ csrf_field() }}
              {{ method_field('PUT') }}

              <select name="Id_ContenidoCurso" class="form-control display-none">
                <option value="{{ $Contenido->Id_ContenidoCurso }}">{{ $Contenido->Id_ContenidoCurso }}</option>
              </select>
              <select name="Id_Curso" class="form-control display-none">
                <option value="{{ $Contenido->Id_Curso }}">{{ $Contenido->Id_Curso }}</option>
              </select>

              <div class="row">
                <div class="col-md-12">
                  <label for="exampleInputDetails">Titulo del Video:<sup class="redstar">*</sup></label>
                  <input type="text" class="form-control " name="Titulo" id="exampleInputTitle" placeholder="Ingrese el titulo del video" value="{{$Contenido->Titulo}}" required="">
                </div>
              </div>
              <br>




              <div class="row">
                <div class="col-md-12">
                  <label for="exampleInputDetails">Descripcion:<sup class="redstar">*</sup></label>
                  <textarea required="" id="detail3" name="Descripcion" rows="5"  class="form-control" placeholder="Ingrese la descripcion del video">{!! $Contenido->Descripcion !!}</textarea>
                </div>
              </div>
              <br>

              <div class="row">
                <div class="col-md-12">
                  <label for="exampleInputTit1e">Ingrese la direccion de la imagen:<span class="redstar">*</span> </label>
                  <input type="text" required="" placeholder="ejemplo:http://localhost/ProyectoIsabel/ContenidoCursos/CursoIOT/Imagen/Video2.png" class="form-control " name="DireccionImagen" id="exampleInputTitle" value="{{$Contenido->DireccionImagen}}" >
                </div>
                <div class="col-md-6">

                </div>
              </div>
              <br>

              <div class="row">
                <div class="col-md-12">
                  <label for="exampleInputTit1e">Ingrese la direccion del Video:<span class="redstar">*</span> </label>
                  <input type="text" required="" placeholder="ejemplo:http://localhost/ProyectoIsabel/ContenidoCursos/CursoIOT/Videos/CAPÍTULO0_IOT-Introducción al IoT.mp4" class="form-control " name="DireccionVideo" id="exampleInputTitle" value="{{$Contenido->DireccionVideo}}" >
                </div>
                <div class="col-md-6">

                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-md-12">
                  <label for="exampleInputTit1e">Formato del Video:<span class="redstar">*</span> </label>
                  <input readonly type="text" required="" placeholder="Ingrese el Titulo" class="form-control " name="TipoVideo" id="exampleInputTitle" value="{{$Contenido->TipoVideo}}">
                </div>
                <div class="col-md-6">

                </div>
              </div>
              <br>

              <div class="box-footer">
                <button type="submit" class="btn btn-lg col-md-4 btn-primary">Guardar</button>
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

  $( function() {
    $( "#dob,#doa" ).datepicker({
      changeYear: true,
      yearRange: "-100:+0",
      dateFormat: 'yy/mm/dd',
    });
  });


  $('#married_status').change(function() {

    if($(this).val() == 'Married')
    {
      $('#doaboxxx').show();
    }
    else
    {
      $('#doaboxxx').hide();
    }
  });

  $(function() {
    var urlLike = '{{ url('country/dropdown') }}';
    $('#country_id').change(function() {
      var up = $('#upload_id').empty();
      var cat_id = $(this).val();
      if(cat_id){
        $.ajax({
          headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          type:"GET",
          url: urlLike,
          data: {catId: cat_id},
          success:function(data){
            console.log(data);
            up.append('<option value="0">Please Choose</option>');
            $.each(data, function(id, title) {
              up.append($('<option>', {value:id, text:title}));
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
      if(cat_id){
        $.ajax({
          headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          type:"GET",
          url: urlLike,
          data: {catId: cat_id},
          success:function(data){
            console.log(data);
            up.append('<option value="0">Please Choose</option>');
            $.each(data, function(id, title) {
              up.append($('<option>', {value:id, text:title}));
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
    if (checkBox.checked == true){
      text.style.display = "block";
    } else {
       text.style.display = "none";
    }
  }
</script>

@endsection



