@extends('layouts.page', ['title' => 'Contacto'])

@section('content')

    @include('partials.menu')

    <div class="container" style="padding: 120px 0 0 0;">
        <div class="row">
            
            <div class="col-md-4">
                <div class="contacts-item"><i class="icon pe-7s-map-marker color-primary"></i>
                    <div class="decor-center bg-primary" style="background: #F6AE2D;"></div>
                    <div class="contacts-item__title">Ubicación</div>
                    <div class="contacts-item__info">Av. Abraham Lincoln esq.<br>
                        Av. Gustavo Mejía Ricart,<br>
                        Torre Piantini, Suite 904<br>
                        Ensanche Piantini,<br>
                        Santo Domingo, Rep. Dom.</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="contacts-item"><i class="icon pe-7s-call color-7"></i>
                    <div class="decor-center bg-primary" style="background: #F6AE2D;"></div>
                    <div class="contacts-item__title">Teléfono</div>
                    <div class="contacts-item__info"> (809) 542-0126</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="contacts-item"><i class="icon pe-7s-mail-open-file color-13"></i>
                    <div class="decor-center bg-primary" style="background: #F6AE2D;"></div>
                    <div class="contacts-item__title">email</div>
                    <div class="contacts-item__info">info@intras.com.do</div>
                </div>
            </div>
            
        </div>
    </div>
    
    <div class="map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3784.2037362632295!2d-69.9356232151758!3d18.474428461657627!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xf8331c97d5c52529!2sTorre+Piantini!5e0!3m2!1ses!2sdo!4v1410888191981" width="100%" height="500" frameborder="0" style="border:0" id="CVK_F_0"></iframe>
    </div>
    
        
    @include('partials.footer')
                    

@endsection