{{-- <form id="form-nesletter" class="mb-3" action="{{ url('/suscribir') }}" method="GET">
    <img class="img-newsletter mb-3" src="{{ url('images/suscription-message.svg') }}" alt="">

    <div class="btn-group pull-left">
        <input type="text" name="email" class="input-newsletter pull-left" placeholder="email@dominio.com" autocomplete="off">
    </div>
    <button id="btn-suscribe" class="btn btn-outline-success my-2 my-sm-0 btn-suscribe">Suscribirse</button>
    <input type="submit" value="Suscribirse" name="subscribe" class="btn-suscribe">
    <div id="server-results"></div>
</form> --}}
{{-- <div id="sidebar">
    <div class="container">
        @include('partials.articulos_edicion_anterior', ['articles' => $previousArticles])
    </div>
</div> --}}
<style>
    .sidebar-banner {
        position: relative;
        margin-top: 20px;
    }
    .sidebar-banner:first-child {
        margin-top: 0 !important;
    }

    .sidebar-widget{
        padding:0px 15px;
        margin-bottom:30px;
    }
    .sidebar-widget h5{
        text-transform: uppercase;
        font-size: 1.1em;
        margin-bottom: 14px;
    }

    /* Medium devices (landscape tablets, 768px and up) */
    @media only screen and (max-width: 768px) {
        .top-banner {
            width: 400px;
            max-width: 100%;
            height: 50px;
        }
        .col .col_4_of_12 {
            max-width: 100% !important;
        }
        .sidebar-banner {
            /* width: 300px; */
            /* margin-top: none; */
            margin-left: auto;
            margin-right: auto;
        }
    }
</style>

<div class="container text-center">

    <div class="sidebar-banner">
            <a class="link" href="https://intras.com.do/the-fall-conference-2026/" target="_blank">
                <img src="https://gestion.com.do/wp-content/uploads/2026/09/Banner-Gestioi%CC%80n-TFC26-1.jpg" style="width:100%">
            </a>
        </div>


        <!-- <div class="sidebar-banner">
            <a class="link" href="https://intras.com.do/the-fall-conference-2023/" target="_blank">
                <img src="https://managementupdate.com.do/images/banner-the-fall-conference-2023.jpg" style="width:100%">
            </a>
        </div> -->
        <!-- <div class="sidebar-banner">
            <a class="link" href="https://intras.com.do/el-nuevo-enfoque-en-la-gestion-de-clientes/" target="_blank">
                <img src="{{ asset('images/gestion-de-clientes.gif') }}" style="width:100%">
            </a>
        </div>

        <div class="sidebar-banner">
            <a class="link" href="https://intras.com.do/masterclass-nov-2024/" target="_blank">
                <img src="https://managementupdate.com.do/images/masterclass-nov-2024.jpg" style="width:100%">
            </a>
        </div>

        <div class="sidebar-banner">
            <a class="link" href="https://intras.com.do/the-fall-conference-2024/" target="_blank">
                <img src="https://managementupdate.com.do/images/banner-the-fall-conference-2024.jpg" style="width:100%">
            </a>
        </div> -->

        <!-- <div class="sidebar-banner">
            <a class="link" href="https://intras.com.do/the-fall-conference-2025/" target="_blank">
                <img src="https://gestion.com.do/wp-content/uploads/2025/09/Banner-Save-1.jpg" style="width:100%">
            </a>
        </div>

        <div class="sidebar-banner">
            <a class="link" href="https://intras.com.do/the-leadership-summit-2026/" target="_blank">
                <img src="https://intras.com.do/wp-content/uploads/2026/05/Banner_-_Publicidad.jpg" style="width:100%">
            </a>
        </div>

        <div class="sidebar-banner">
            <a class="link" href="https://intras.com.do/hello-wellness-2026/" target="_blank">
                <img src="https://gestion.com.do/wp-content/uploads/2026/07/Banner-MU-HW26.jpg" style="width:100%">
            </a>
        </div>-->

        <div class="sidebar-banner">
            <a class="link" href="https://neydiaz.com/restart/" target="_blank">
                <img src="https://managementupdate.com.do/images/banner-gestion-restart.jpg" style="width:100%">
            </a>
        </div>

        <!-- <div class="sidebar-banner">
            <a class="link" href="https://intras.com.do/the-spring-conference-2023/" target="_blank">
                <img src="https://gestion.com.do/wp-content/uploads/2023/02/Banner-GESTION-y-Management-Update-01.jpg" style="width:100%">
            </a>
        </div> -->
        <div class="sidebar-banner">
            <a class="link" href="https://intras.com.do/especializaciones" target="_blank">
                <img src="{{ asset('images/especializaciones.jpg') }}" style="width:100%">
            </a>
        </div>
        {{-- <div class="sidebar-banner">
            <img src="{{ asset('images/app-intras-2.jpg') }}" style="width:100%">
            <div  style="position: absolute;width: 106px;left: 10px;bottom: 65px;">
                <a href="https://play.google.com/store/apps/details?id=com.intras.devcreativo" target="_blank">
                <img src="{{ asset('/images/boton-google-play.png') }}" style="max-width: 100%;">
                </a>
            </div>
            <div style="position: absolute;width: 106px;left: 10px;bottom: 20px;">
                <a href="https://apps.apple.com/do/app/intras/id1528762014" target="_blank">
                <img src="{{ asset('/images/boton-app-store.png') }}" style="max-width: 100%;">
                </a>
            </div>
        </div> --}}
        <div class="sidebar-banner">
            <a href="https://intras.com.do/soluciones-in-house/">
                <img src="{{ asset('images/rsz_banner-soluciones-inhouse.jpg') }}" style="width:100%">
            </a>
        </div>
    </div>
