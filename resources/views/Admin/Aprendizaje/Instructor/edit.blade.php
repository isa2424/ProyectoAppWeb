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
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"> Editar Usuario</h3>


        </div>
        <br>
        <div class="panel-body">
          <form action="{{ route('instructor.update', $user->Id_Persona ) }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PUT') }}

            <div class="row">
              <div class="col-md-6">
                <label for="fname">
                  Ingrese Nombres:
                  <sup class="redstar">*</sup>
                </label>
                <input value="{{ $user->Nombres }}" autofocus required name="Nombres" type="text" class="form-control" placeholder="Ingrese nombres"/>
              </div>

              <div class="col-md-6">
                <label for="lname">
                  Ingrese Apellidos
                  <sup class="redstar">*</sup>
                </label>
                <input value="{{ $user->Apellidos }}" required name="Apellidos" type="text" class="form-control" placeholder="Ingrese apellidos"/>
              </div>
            </div>
            <br>

            <div class="row">

              <div class="col-md-6">
                <label for="mobile"> Telefono:</label>
                <input value="{{ $user->Telefono}}" type="text" name="Telefono" placeholder="Enter mobile no" class="form-control">
               </div>
               <div class="col-md-6">
                <label for="mobile">Correo:<sup class="redstar">*</sup> </label>
                @foreach ($InicioSesion as $count)
                    @if($count->id==$user->Id_InicioSesion)
                        <input readonly value="{{ $count->email }}" required type="email" name="Correo" placeholder="Enter email" class="form-control">
                    @endif
                @endforeach

              </div>
            </div>
            <br>





            <div class="row">


              <div class="col-md-6">
                <label for="role">Seleccione un Rol:</label>
                  @if($user->Id_TipoPersona=="1")


                  <select class="form-control js-example-basic-single" name="Id_TipoPersona">
                    <option {{ $user->Id_TipoPersona == '2' ? 'selected' : ''}} value="2">Usuario</option>
                    <option {{ $user->Id_TipoPersona == '1' ? 'selected' : ''}} value="1">Administrador</option>
                    <option {{ $user->Id_TipoPersona == '3' ? 'selected' : ''}} value="3">Instructor</option>
                  </select>
                  @endif
                  @if($user->Id_TipoPersona=="3")
                  <select class="form-control js-example-basic-single" name="Id_TipoPersona">
                    <option {{ $user->Id_TipoPersona == '2' ? 'selected' : ''}} value="2">Usuario</option>
                    <option {{ $user->Id_TipoPersona == '3' ? 'selected' : ''}} value="3">Instructor</option>
                  </select>
                  @endif
                  @if($user->Id_TipoPersona=="2")
                  <select class="form-control js-example-basic-single" name="Id_TipoPersona">
                    <option {{ $user->Id_TipoPersona == '2' ? 'selected' : ''}} value="2">Usuario</option>
                  </select>
                  @endif
              </div>
            </div>
            <br>


            <div class="row">


            </div>
            <br>

            <div class="row">
              <div class="col-md-3">
                <label for="city_id">Provincia:</label>
                <select id="country_id" class="form-control js-example-basic-single" name="Id_Provincia">
                  <option value="none" selected disabled hidden>
                      Seleccione una Opcion
                    </option>

                  @foreach ($provincias as $coun)
                    <option value="{{ $coun->Id_Provincia }}" {{ $user->Id_Provincia == $coun->Id_Provincia ? 'selected' : ''}}>{{ $coun->Descripcion }}
                    </option>
                  @endforeach
                </select>
              </div>






            </div>
            <br>

            <div class="row">

                <div class="col-md-3">
                    <label for="exampleInputTit1e">Estados:</label>
                    <li class="tg-list-item">
                      <input class="tgl tgl-skewed" id="status" type="checkbox" name="Estado" {{ $user->Estado == '1' ? 'checked' : '' }} >
                      <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="status"></label>
                  </li>
                  <input type="hidden"  name="free" value="0" for="status" id="status">
                  </div>



            </div>
            <br>

            <div class="row">
                @if($user->Id_TipoPersona=='2')
                <div class="col-md-6">
                    <label>Imagen:<sup class="redstar">*</sup></label>
                  </div>

                      <div class="edit-user-img">
                        <img src="{{ asset('images/default/user.jpg')}}" class="img-fluid" alt="User Image" class="img-responsive">
                      </div>



                  </div>
                @else
                <div class="col-md-6">
                    <label>Imagen:<sup class="redstar">*</sup></label>
                    <input type="file" name="Foto" class="form-control">
                  </div>
                  <div class="col-md-6">
                    @if($user->Foto != null || $user->Foto !='')
                      <div class="edit-user-img">
                        <img src="{{ url('http://localhost/ProyectoIsabel/Imagenes/Usuarios/'.$user->Foto) }}" class="img-fluid" alt="User Image" class="img-responsive">
                      </div>
                    @else
                      <div class="edit-user-img">
                        <img src="{{ asset('images/default/user.jpg')}}" class="img-fluid" alt="User Image" class="img-responsive">
                      </div>
                    @endif


                  </div>
                @endif

            </div>
            <br>




            <br>
            <br>




            <div class="row">
              <div class="col-md-12">
                <label for="detail">Detalle:<sup class="redstar">*</sup></label>
                <textarea id="detail" name="Descripcion" class="form-control" rows="5" placeholder="Enter your details" value="">{{ $user->Biografia }}</textarea>
              </div>
            </div>
            <br>


            <br>
            <br>


            <div class="box-footer">
              <button type="submit" class="btn btn-md btn-primary">
                <i class="fa fa-save"></i> Guardar
              </button>
            </form>
              <a href="{{route('instructor.index')}}"  title="Cancel and go back" class="btn btn-md btn-default btn-flat">
                <i class="fa fa-reply"></i> Regresar
              </a>
            </div>
            <br>

          </form>
        </div>
        <!-- /.panel body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
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

