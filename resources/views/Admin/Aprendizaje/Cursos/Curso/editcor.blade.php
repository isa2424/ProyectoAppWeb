<section class="content">
  {{-- @include('admin.message') --}}
  <div class="row">
    <!-- left column -->
    <div class="col-xs-12">
      <!-- general form elements -->
        <div class="box-header with-border">
          <h3 class="box-title"> Editar Curso</h3>
        </div>
        <br>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="form-group">
            <form action="{{route('curso.update',$Cur->Id_Curso)}}" method="post" enctype="multipart/form-data">
              {{ csrf_field() }}
              {{ method_field('PUT') }}

              <div class="row">
                <div class="col-md-4">
                  <label>Categoria<span class="redstar">*</span></label>
                  <select name="Id_Categoria" id="category_id" class="form-control js-example-basic-single" required>
                    <option value="0">Seleccione una Opcion</option>
                    @php
                      $category = SistemaWeb\Categoria::all();
                    @endphp

                    @foreach($category as $caat)
                      <option {{ $Cur->Id_Categoria == $caat->Id_Categoria ? 'selected' : "" }} value="{{ $caat->Id_Categoria }}">{{ $caat->Titulo }}</option>
                    @endforeach
                  </select>
                </div>


              </div>
              <br>

              <div class="row">

                <div class="col-md-6">
                  <label for="exampleInputTit1e">Titulo:<sup class="redstar">*</sup></label>
                  <input required="" type="text" class="form-control" name="Titulo" id="exampleInputTitle" value="{{ $Cur->Titulo }}">
                </div>


              </div>
              <br>

              <div class="row">
                <div class="col-md-6">
                  <label for="exampleInputDetails">Descripción:<sup class="redstar">*</sup></label>
                  <textarea required="" name="Descripcion" rows="3" class="form-control" >{!! $Cur->Descripcion !!}</textarea>
                </div>
              </div>
              <br>
              <div class="row">

                <div class="col-md-3">
                  <label for="exampleInputTit1e">Estado:</label>

                  <li class="tg-list-item">
                    <input class="tgl tgl-skewed" id="status" type="checkbox" name="Estado" {{ $Cur->Estado == '1' ? 'checked' : '' }} >
                    <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="status"></label>
                  </li>
                  <input type="hidden"  name="free" value="0" for="status" id="status">
                </div>

              </div>
              <br>



              <div class="row">
                <div class="col-md-6">
                  <label>Imagen Previa:</label>
                  <br>
                  <input type="file" name="Foto" id="image" class="inputfile inputfile-1"  />

                  <br>
                  @if($Cur['Foto'] !== NULL && $Cur['Foto'] !== '')
                      <img src="{{ url('http://localhost/ProyectoIsabel/Imagenes/Cursos/'.$Cur->Foto) }}" height="70px;" width="70px;"/>
                  @else
                        <img src="{{ asset('images/default/user.jpg')}}" class="img-fluid" alt="User Image">
                  @endif
                </div>
              </div>
              <br>



              <div class="box-footer">
                <button type="submit" class="btn btn-lg col-md-3 btn-primary">Guardar</button>
              </div>

            </form>
          </div>
        </div>
        <!-- /.box -->
    </div>
    <!--/.col (right) -->
  </div>
  <!-- /.row -->
</section>


@section('scripts')


<script>
(function($) {
  "use strict";

  $(function() {
      $('.js-example-basic-single').select2(
        {
          tags: true,
          tokenSeparators: [',', ' ']
        });
    });

  $(function() {
    $('#cb1').change(function() {
      $('#f').val(+ $(this).prop('checked'))
    })
  })

  $(function() {
    $('#cb3').change(function() {
      $('#test').val(+ $(this).prop('checked'))
    })
  })

  $(function(){

      $('#murl').change(function(){
        if($('#murl').val()=='yes')
        {
            $('#doab').show();
        }
        else
        {
            $('#doab').hide();
        }
      });

  });

  $(function(){

      $('#murll').change(function(){
        if($('#murll').val()=='yes')
        {
            $('#doabb').show();
        }
        else
        {
            $('#doab').hide();
        }
      });

  });

  $('#preview').on('change',function(){

    if($('#preview').is(':checked')){
      $('#document1').show('fast');
      $('#document2').hide('fast');

    }else{
      $('#document2').show('fast');
      $('#document1').hide('fast');
    }

  });

  $(function() {
    var urlLike = '{{ url('admin/dropdown') }}';
    $('#category_id').change(function() {
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
    var urlLike = '{{ url('admin/gcat') }}';
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

@endsection
