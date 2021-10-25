@extends ('Admin/layouts.admin')
@section ('contenido')


<section class="content">

  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Todos los Aprobados</h3>


        </div>

        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
              <table id="example1" class="table table-bordered table-striped table-responsive display nowrap">
                <thead>
                    <tr>
                        <th>Usuario</th>
                        <th>Curso</th>
                        <th>Nota del Examen</th>
                        <th>Fecha</th>
                        <th>Aprobado</th>
                    </tr>
                </thead>

                <tbody>
                  <?php $i=0;?>



                  @foreach($Aprobados as $Aprobado)
                  @if($Aprobado->Aprobados == 1)
                      <tr>
                          <td><a href="#">{{ $Aprobado->Nombres }} {{ $Aprobado->Apellidos }}</a></td>
                          <td>
                              @if($Aprobado->Id_Curso != NULL)
                                  {{ $Aprobado->Titulo }}
                              @else
                                  No tiene nombre
                              @endif
                          </td>
                          <td>
                              <span class="label label-success"> {{ $Aprobado->Nota }} </span>
                          </td>
                          <td>
                                  <div class="sparkbar" data-color="#00a65a" data-height="20">{{ date('jS F Y', strtotime($Aprobado->Fecha)) }}</div>
                          </td>
                          <td>
                              @if($Aprobado->Aprobados != 0)
                                  <a >Aprobado</a>
                              @else
                                  <a >No Aprobado</a>
                              @endif

                          </td>
                      </tr>

                  @endif

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


