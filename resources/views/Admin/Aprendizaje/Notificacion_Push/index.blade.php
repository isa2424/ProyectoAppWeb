@extends ('Admin/layouts.admin')
@section ('contenido')


<section class="content">
    <div class="row">
        <div class="col-md-8">
         <div class="box">
             <div class="box-header">
                 <div class="box-title">
                    Administrador de notificaciones push
                 </div>
             </div>

             <div class="box-body">
                 <form action="{{ route('admin.push.notif') }}" method="POST">
                     @csrf

                     <div class="form-group">
                         <label for="">Seleccione el grupo: <span class="text-danger">*</span> </label>

                         <select required data-placeholder="Please select user group" name="user_group" id="" class="select2 form-control">
                             <option value="">Seleccione el grupo de usuarios</option>
                             <option {{ old('user_group') == 'all_users' ? "selected" : "" }} value="all_users">Todos los Usuarios</option>
                             <option {{ old('user_group') == 'all_instructors' ? "selected" : "" }} value="all_instructors">Todos los Instrucotres</option>
                             <option {{ old('user_group') == 'all_admins' ? "selected" : "" }} value="all_admins">Todos los Administradores</option>
                             <option {{ old('user_group') == 'all' ? "selected" : "" }} value="all">Todos los Usuarios (Usuarios + Instructores + Administradores)</option>
                         </select>
                     </div>

                     <div class="form-group">
                         <label for="">Motivo: <span class="text-red">*</span></label>
                         <input placeholder="" type="text" class="form-control" required name="subject" value="{{ old('subject') }}">
                     </div>

                     <div class="form-group">
                         <label for="">Mensaje: <span class="text-red">*</span> </label>
                         <textarea required placeholder="" class="form-control" name="message" id="" cols="3" rows="5">{{ old('message') }}</textarea>
                     </div>
                     <div class="from-group">
                        <button type="submit" class="btn btn-block btn-md btn-primary">
                            <i class="fa fa-location-arrow"></i> Enviar Mensaje
                        </button>
                    </div>



                 </form>
             </div>
         </div>
        </div>


    </div>
</section>

@endsection


