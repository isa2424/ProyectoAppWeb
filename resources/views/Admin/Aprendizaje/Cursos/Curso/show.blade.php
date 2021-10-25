@extends ('Admin/layouts.admin')
@section ('contenido')


<div class="box">
  <div class="box-header">
    <h3 >{{$Cur->Titulo }}</h3>
  </div>
  <div class="box-body">
  @if($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
  </div>
</div>

<section class="content">
  @include('Admin.message')
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">

        <div class="content-header">
        </div>
        <div class="box-body">
          <div class="nav-tabs-custom">
            <div class="row">
              <div class="col-md-2">
                 <ul class="nav nav-stacked" id="nav-tab" role="tablist">


              <li role="presentation" class="active"><a href="#a" aria-controls="home" role="tab" data-toggle="tab">Curso</a></li>
              <li class=""  role="presentation"><a href="#b" aria-controls="profile" role="tab" data-toggle="tab">Contenido</a></li>
              <li  class=""  role="presentation"><a href="#c" aria-controls="messages" role="tab" data-toggle="tab">Preguntas del Curso</a></li>
              <li  class=""  role="presentation"><a href="#d" aria-controls="settings" role="tab" data-toggle="tab">Opciones de Preguntas</a></li>







            </ul>
              </div>
              <div class="col-md-10">
                <div class="tab-content">


              <div role="tabpanel" class="tab-pane fade in active" id="a">
                @include('Admin.Aprendizaje.Cursos.Curso.editcor')
              </div>
              <div role="tabpanel" class="tab-pane fade" id="b">
                @include('Admin.Aprendizaje.Cursos.Curso.ContenidoCurso.index')
              </div>
              <div role="tabpanel" class="fade tab-pane" id="c">
                @include('Admin.Aprendizaje.Cursos.Curso.Quiz.PreguntaQuiz.index')
              </div>
              <div role="tabpanel" class="fade tab-pane" id="d">
                @include('Admin.Aprendizaje.Cursos.Curso.Quiz.OpcionQuiz.index')
              </div>


            </div>

              </div>
            </div>
            <!-- Nav tabs -->


            <!-- Tab panes -->


          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection


@section('script')

<script>
(function($) {
"use strict";
  $(document).ready(function(){
    $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
        localStorage.setItem('activeTab', $(e.target).attr('href'));
    });
    var activeTab = localStorage.getItem('activeTab');
    if(activeTab){
        $('#nav-tab a[href="' + activeTab + '"]').tab('show');
    }
  });
})(jQuery);
</script>

@endsection
