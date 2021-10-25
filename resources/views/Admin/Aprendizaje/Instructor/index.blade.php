@extends ('Admin/layouts.admin')
@section ('contenido')


<section class="content">
    @include('Admin.message')
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Todos los Instructor</h3>

        </div>

        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
              <table id="example1" class="table table-bordered table-striped table-responsive display nowrap">
                <thead>
                  <th>#</th>
                  <th>Imagen</th>
                  <th>Nombres</th>
                  <th>Correo</th>
                  <th>Roll</th>
                  <th>Telefono</th>
                  <th>Provincia</th>
                  <th>Estado</th>
                  <th>Editar</th>

                </thead>

                <tbody>
                  <?php $i=0;?>



                    @foreach ($instructor as $user)

                        <?php $i++;?>

                      <tr>
                        <td><?php echo $i;?></td>
                        <td>
                          @if($user->Foto != null || $user->Foto !='')
                          <img src="{{ url('http://localhost/ProyectoIsabel/Imagenes/Usuarios/'.$user->Foto) }} ">

                          @else
                            <img src="{{ asset('images/default/user.jpg')}}" class="img-responsive" alt="User Image">
                          @endif

                        </td>
                        <td>{{ $user->Nombres }} {{ $user->Apellidos }}</td>
                        <td>{{ $user->Correo }}</td>
                        <td>{{ $user->Rol }}</td>
                        <td>{{ $user->Telefono }}</td>
                        <td>{{ $user->Provincia }}</td>
                        <td>
                            <form action="{{ route('persona.quick',$user->Id_Persona) }}" method="POST">
                              {{ csrf_field() }}
                              <button  type="Submit" class="btn btn-xs {{ $user->Estado ==1 ? 'btn-success' : 'btn-danger' }}">
                                @if($user->Estado ==1)
                                Activo
                                @else
                                Inactivo
                                @endif
                              </button>
                            </form>
                          </td>
                          <td>
                            <a class="btn btn-success btn-sm" href="{{ route('instructor.edit',$user->Id_Persona) }}">
                              <i class="glyphicon glyphicon-pencil"></i></a>
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


