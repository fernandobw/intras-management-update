@extends('layouts.page', ['titulo' => isset($aliasOrg) ? str_replace("edicion","Edición",$aliasOrg[0])." #".$aliasOrg[1] : 'Portada'])

@section('og_tags')

<meta name="description" content="Newsletter digital, mensual y gratuito publicado de forma exclusiva para los participantes de los programas abiertos de INTRAS, así como a clientes, relacionados o empresas vinculadas a la firma. En este son publicados interesantes artículos, tips, definiciones, videos y reportajes con temas de vanguardia y herramientas concretas del mundo corporativo nacional e internacional, extraídos de los seminarios que son realizados por INTRAS.">
<meta property="og:url" content="{{ url('/') }}" />
<meta property="og:type" content="article" />
<meta property="og:title" content="Management Update" />
<meta property="og:description" content="Es un newsletter digital, mensual y gratuito publicado de forma exclusiva para los participantes de los programas abiertos de INTRAS, así como a clientes, relacionados o empresas vinculadas a la firma. En este son publicados interesantes artículos, tips, definiciones, videos y reportajes con temas de vanguardia y herramientas concretas del mundo corporativo nacional e internacional, extraídos de los seminarios que son realizados por INTRAS." />
<meta property="og:image" content="{{url('resize/share.jpg')}}" />
<meta property="og:image:width" content="1200" />
<meta property="og:image:height" content="960" />

<meta name="twitter:card" content="summary"/>
<meta name="twitter:description" content="Es un newsletter digital, mensual y gratuito publicado de forma exclusiva para los participantes de los programas abiertos de INTRAS, así como a clientes, relacionados o empresas vinculadas a la firma."/>
<meta name="twitter:title" content="Management Update"/>
<meta name="twitter:site" content="@intrasrd"/>
<meta name="twitter:image" content="{{ url('/resize/articles/logo_mod-a.png?w=1024&h=512&fit=fill&bg=F7F7F7') }}"/>
<meta name="twitter:creator" content="@intrasrd"/>

@endsection
@section('content')

@include('partials.menu')
    <section id="body" class="pt-4">
        @include('partials.banner-horizontal')
        <div class="container">
            <div class="row pt-4">
                <div class="col-md-12 col-lg-8">
                    @include('partials.articulos_portada', ['articles' => $articles])
                </div>

                <div class="col-md-12 col-lg-4 mb-2">
                    @include('partials.sidebar', ['articles' => $articles])

                </div>
            </div>
            </div>
        </div>
    </section>
    @if (isset($events))
    <!--@include('partials.proximos_eventos', ['events' => $events->data])-->
    @endif
    @include('partials.articulos_edicion_anterior_horizontal', ['ediciones' => $edicionesAnteriores])
    @include('partials.footer')
        <script type="text/javascript" src="frontend/js/jquery-latest.min.js"></script>

        <script>

        </script>
    </section>

    {{-- <script src="{{ URL::asset('js/app.js') }}"></script> --}}
    @include('newsletter-popup')
@endsection
