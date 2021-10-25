@extends ('Admin/layouts.admin')
@section ('contenido')
<section class="content-header">
    <h1>
      Dash
      <small>sadasdasd</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active">Index</li>
      </ol>
  </section>
  <section class="content">
	<!-- Main row -->

    <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>
              	@php

              		if(0>0){

              			echo "3";
              		}
              		else{

              			echo "0";
              		}
              	@endphp
              </h3>
              <p>persona</p>
            </div>
            <div class="icon">
              <i class="flaticon-user"></i>
            </div>
            <a  class="small-box-footer">Ver Información <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-green">
              <div class="inner">
                <h3>
                    @php

                        if(0>0){

                            echo "3";
                        }
                        else{

                            echo "0";
                        }
                    @endphp
                </h3>
                <p>Categorias</p>
              </div>
              <div class="icon">
                  <i class="flaticon-layout"></i>
              </div>
              <a  class="small-box-footer">Ver Información <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
              <div class="inner">
                <h3>
                    @php

                        if(0>0){

                            echo "3";
                        }
                        else{

                            echo "0";
                        }
                    @endphp
                </h3>
                <p>Cursos</p>
              </div>
              <div class="icon">
                <i class="flaticon-book"></i>
              </div>
              <a  class="small-box-footer">Ver Información <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
              <div class="inner">
                <h3>
                  @php

                        if(0>0){

                            echo "3";
                        }
                        else{

                            echo "0";
                        }
                    @endphp
                </h3>
                <p>Instructor</p>
              </div>
              <div class="icon">
               <i class="flaticon-teacher"></i>
              </div>
              <a  class="small-box-footer">Ver Información <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
    </div>

    <div class="row">

        <div class="col-md-4">

            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">Todos los Usuarios</h3>

                    <div class="box-tools pull-right">
                    <span class="label label-danger">
                        @php

                            if(3>0){

                            echo "20";
                            }
                            else{

                            echo "0";
                            }
                        @endphp
                        Usuarios
                    </span>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                    </div>
                </div>
            </div>
            <div class="box-body no-padding">

                <ul class="users-list clearfix">

                  <li>

                      <img src="{{ asset('images/default/user.jpg')}}" class="img-fluid" alt="User Image">

                    <a class="users-list-name" href="#">José Soledispa</a>
                    <span class="users-list-date">asdasd</span>
                  </li>


                </ul>
                <!-- /.users-list -->
              </div>
              <!-- /.box-body -->
              <div class="box-footer text-center">
                <a  class="uppercase">ver todos</a>
              </div>

        </div>

	</div>


</section>

@endsection
