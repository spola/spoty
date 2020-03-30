@component('mail::message')
[logo]: {{asset($pathToImage)}} "Logo"

![{{ $app_name }}]({{ asset($pathToImage) }})




#¡Te hemos creado una cuenta en SPOTY!

Tu nombre de usuario es tu correo y la contraseña inicial es 12345678

Cuando entres, en la esquina superior derecha encontrarás un botón de ayuda con un documento con ayuda de uso de nuestra querida plataforma.
@component('mail::button', ['url' => $url])
Ingresar
@endcomponent

Gracias por unirte, lo hicimos con mucho cariño<br>
{{ $app_name }}
@endcomponent