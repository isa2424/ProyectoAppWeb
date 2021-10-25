@extends ('Admin/layouts.admin')
@section ('contenido')


<section class="content">

  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Progreso de los Usuarios</h3>


        </div>

        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
              <table id="example1" class="table table-bordered table-striped table-responsive display nowrap">
                <thead>
                    <tr>
                        <th>Usuario</th>
                        <th>Curso</th>
                        <th>% del Contenido</th>

                    </tr>
                </thead>

                <tbody>
                  <?php $i=0;?>



                  @foreach($Progreso as $Aprobado)
                  <tr>
                      <td><a href="#">{{ $Aprobado->NombresEstudiante }} {{ $Aprobado->ApellidosEstudiante }}</a></td>
                      <td>
                          @if($Aprobado->Id_Curso != NULL)
                              {{ $Aprobado->Titulo }}
                          @else
                              No tiene nombre
                          @endif
                      </td>
                      <td>
                          <span class="label label-success"> {{ $Aprobado->TotalContenido }}/80 </span>
                      </td>


                  </tr>

                  @endforeach

                </tbody>
              </table>
            </div>
          </div>
        <!-- /.box-body -->
      </div>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>

@endsection


