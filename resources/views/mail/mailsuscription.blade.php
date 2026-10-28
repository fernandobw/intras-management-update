@component('mail::message')
@if (! is_null($firstname))
<p>Hola, tenemos una nueva suscripción al newsletter con los siguiente datos:</p>
<p><strong>Nombre:</strong> {{ $firstname ?? '' }}</p>
<p><strong>Apellido:</strong> {{ $lastname ?? '' }}</p>
<p><strong>Email:</strong> {{ $email ?? '' }}</p>
<p><strong>Empresa:</strong> {{ $company ?? '' }}</p>
@else
<p>Hola, nueva suscripción al newsletter con el siguiente correo: <strong>{{ $email }}</strong>.</p>
@endif
@endcomponent
