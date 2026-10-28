@section('header_styles')
<style>
    div {
        -webkit-box-sizing: border-box; /* Safari/Chrome, other WebKit */
        -moz-box-sizing: border-box;    /* Firefox, other Gecko */
        box-sizing: border-box;
    }

    .modal-newsletter {
            color: #999;
            font-size: 15px;
    }
    .modal-newsletter .modal-content {
        padding: 30px;
        border-radius: 0;
        border: none;
    }
    .modal-newsletter .modal-header {
        border-bottom: none;
        position: relative;
        border-radius: 0;
    }
    .modal-newsletter h4 {
        color: #000;
        font-size: 30px;
        margin: 0;
        font-weight: bold;
    }
    .modal-newsletter .close {
        position: absolute;
        top: -50px;
        right: -15px;
        text-shadow: none;
        font-size: 24px;

        width: 45px;
        /* margin: -1.5rem -1.5rem -1rem auto; */
        padding: 0;
        margin: -0.5rem -0.5rem -1rem auto;
        z-index: 1051;
        opacity: 1;
    }
    .modal-newsletter .close:hover {
        opacity: 0.8;
    }
    .modal-newsletter .icon-box {
        color: #7265ea;
        display: inline-block;
        z-index: 9;
        text-align: center;
        position: relative;
        margin-bottom: 10px;
    }
    .modal-newsletter .icon-box i {
        font-size: 110px;
    }
    .modal-newsletter .form-control, .modal-newsletter .btn {
        min-height: 46px;
        border-radius: 0;
    }
    .modal-newsletter .form-control {
        background-color: #F2F2F2;
        box-shadow: none;
        border-color: #999999;
    }
    .modal-newsletter .form-control:focus {
        border-color: #0F5F8E;
        box-shadow: 0 0 8px rgba(15, 95, 142, 0.4);
    }
    .modal-newsletter .btn {
        color: #fff;
        background: #0F5F8E;
        text-decoration: none;
        transition: all 0.4s;
        line-height: normal;
        padding: 6px 20px;
        min-width: 150px;
        /* margin-left: 6px; */
        border: none;
    }
    .modal-newsletter .btn:hover, .modal-newsletter .btn:focus {
        box-shadow: 0 0 8px rgba(249, 88, 88, 0.4);
        background: #0c4f75;
        outline: none;
    }
    .modal-newsletter .input-group {
        margin-top: 30px;
    }
    .hint-text {
        margin: 100px auto;
        text-align: center;
    }

    #newsletter-modal .modal-content {
        width: 100%;
        padding: 0;
    }
    #newsletter-modal .modal-body {
        padding: 0;
    }
    .portada-modal {
        background-image: url( {{ asset('images/imagen-newsletter.jpg') }} );
        background-size: 170% auto;
        background-repeat: no-repeat;
        ackground-position: center;
        width: 100%;
        height: 100%;
        /* position: relative; */
        /* top: -32px; */
    }
    #newsletter-modal .rrow {
        display: flex;
        flex-wrap: wrap;
    }

    #newsletter-modal .left-side {
        padding: 50px 70px;
    }
    #newsletter-modal .right-side {
        flex-basis: 0;
        flex-grow: 0;
        width: 100%;
        max-width: 60%;
    }
    .newsletter-form input.form-control {
        margin: 0;
        margin-bottom: 7px;
    }

    #newsletter-modal .modal-content .modal-header {
        position: absolute;
        right: 0;
    }
    #newsletter-modal .close {
        width: 45px;
        /* margin: -1.5rem -1.5rem -1rem auto; */
        padding: 0;
        margin: -0.5rem -0.5rem -1rem auto;
        z-index: 1051;
        opacity: 1;
    }
    #newsletter-modal .close img {
        width: 100%
    }
    @media screen and (max-width:768px){
        #newsletter-modal .left-side {
            padding: 30px 50px;
        }
    }
</style>
@endsection

<div id="newsletter-modal" class="modal fade ">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-newsletter">
        <div class="modal-content">
            <form action="{{ url('/subscribe') }}" method="post" id="newsletter-popup-form">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        <img src="{{ asset('images/boton-cerrar.png') }}" />
                    </button>
                </div>
                <div class="modal-body">
                    <div class="rrow">
                        <div class="col-md-7 left-side">
                            <div style="text-align: center;margin-bottom: 35px;"><img style="width: 72%;" src="{{ asset('images/logo-management-update.png') }}" alt="logo managementupdate"></div>
                            <div>
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        Error:
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <p style="text-align: justify;color:#000;line-height: 1.14">Sé el primero en recibir nuestro newsletter digital, donde encontrarás interesantes artículos, tips y videos de la gestión empresarial moderna</p>
                                <div class="newsletter-form">
                                    <input type="text" name="firstname" class="form-control" placeholder="NOMBRE" required>
                                    <input type="text" name="lastname" class="form-control" placeholder="APELLIDO" required>
                                    <input type="email" name="email" class="form-control" placeholder="EMAIL" required>
                                    <input type="text" name="company" class="form-control" placeholder="EMPRESA" required>
                                    {!! app('captcha')->display([ "class" => "pull-right"]) !!}
                                    <input type="submit" class="btn btn-primary" style="width: 100%;margin-top: 5px;" value="¡Suscribirme ahora!">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 d-none d-sm-block" style="padding: 0;">
                            <div class="portada-modal">

                            </div>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>

@section('footer_scripts')
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script> --}}

{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> --}}
<script>
    console.log('xd');
    $(document).ready(function(){
        var suscribed = false;
        var newsModal = $("#newsletter-modal");
        if (typeof(Storage) !== "undefined") {
            suscribed = window.localStorage.getItem('SUSCRIBED') == 'true';
        }
        if (!suscribed) {
            newsModal.modal('show');
        }
        var form = $('#newsletter-popup-form');

        var clearForm = function () {
            form[0].reset();
        };

        form.on('submit', function (e) {
            e.preventDefault();
            console.log('captcha: ',grecaptcha.getResponse());
            if (grecaptcha.getResponse()) {

                $.ajax({
                    url: form.attr('action'),
                    data: form.serialize(),
                    type: 'POST',
                }).done(function(response) {
                    alert('¡Subscripción registrada correctamente!');
                    newsModal.modal('hide');
                    grecaptcha.reset();
                    clearForm();

                    if (typeof(Storage) !== "undefined") {
                        window.localStorage.setItem('SUSCRIBED', true);
                    }

                }).fail(function(err) {
                    if (err.status === 422) {
                        var errores = '';
                        for(const errorKey in err.responseJSON.errors) {
                            // if (errorKey != 'g-recaptcha-response') {
                            // }
                            $.each(err.responseJSON.errors[errorKey], function (key, errorValue) {
                                errores += errorValue +"\n"; // err.resposeJSON.errors[errorKey]
                            });
                        }
                    } else {
                        alert('Se produjo un error desconocido, por favor, ponte en contacto con nuestro equipo de soporte al cliente.');
                        console.error('salio mal:',err);
                    }
                });
                // this.submit();
            } else {
                alert('Debe completar la verificación de captcha para continuar');
            }
        })
    });
</script>
@endsection
