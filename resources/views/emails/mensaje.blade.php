@component('mail::message')
# Saludos
Hola **{{ $user->Nombres }}**, Saludos coordiales de parte de la  **Administración** !

# Motivo
**{{ $data['subject'] }}**

# Mensaje
{{ $data['body'] }}




Saludos, y que estés bien !
@endcomponent
