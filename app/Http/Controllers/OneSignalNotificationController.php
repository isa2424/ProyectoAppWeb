<?php

namespace SistemaWeb\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;
use SistemaWeb\Mail\EnviarMensaje;
use SistemaWeb\Notifications\OfferPushNotifications;
use SistemaWeb\Persona;


class OneSignalNotificationController extends Controller
{
    public function index()
    {
        return view('Admin.Aprendizaje.Notificacion_Push.index');
    }

    public function push(Request $request)
    {

        $request->validate([
            'subject' => 'required|string',
            'message' => 'required'
        ]);
        $data = [
            'subject' => $request->subject,
            'body' => $request->message

        ];

        if ($request->user_group == 'all_users') {
            $this->sql = "select p.Nombres as Nombres,ic.Correo as Correo
            from persona p, inicio_sesion ic where  p.Id_InicioSesion=ic.Id_InicioSesion and p.Id_TipoPersona=2";




        } elseif ($request->user_group == 'all_instructors') {

            $this->sql = "select p.Nombres as Nombres,ic.Correo as Correo
            from persona p, inicio_sesion ic where  p.Id_InicioSesion=ic.Id_InicioSesion and p.Id_TipoPersona=3";

        } elseif ($request->user_group == 'all_admins') {

            $this->sql = "select p.Nombres as Nombres,ic.Correo as Correo
            from persona p, inicio_sesion ic where  p.Id_InicioSesion=ic.Id_InicioSesion and p.Id_TipoPersona=1";


        } elseif ($request->user_group == 'all') {
            // all users
            $this->sql = "select p.Nombres as Nombres,ic.Correo as Correo
            from persona p, inicio_sesion ic where  p.Id_InicioSesion=ic.Id_InicioSesion  ";

        }
        $users =DB::select($this->sql,array(1,20));
        foreach ($users as $user) {
            $this->correo = $user->Correo;

            Mail::to($this->correo)->send(new EnviarMensaje($user,$data));
        }



        return back();
    }
}
