@extends('layouts.portada')

@section('titulo', 'Portada')


@section('og_tags')

<meta name="description" content="Newsletter digital, mensual y gratuito publicado de forma exclusiva para los participantes de los programas abiertos de INTRAS, así como a clientes, relacionados o empresas vinculadas a la firma. En este son publicados interesantes artículos, tips, definiciones, videos y reportajes con temas de vanguardia y herramientas concretas del mundo corporativo nacional e internacional, extraídos de los seminarios que son realizados por INTRAS.">
<meta property="og:url" content="{{ url('/') }}" />
<meta property="og:type" content="article" />
<meta property="og:title" content="Management Update" />
<meta property="og:description" content="Es un newsletter digital, mensual y gratuito publicado de forma exclusiva para los participantes de los programas abiertos de INTRAS, así como a clientes, relacionados o empresas vinculadas a la firma. En este son publicados interesantes artículos, tips, definiciones, videos y reportajes con temas de vanguardia y herramientas concretas del mundo corporativo nacional e internacional, extraídos de los seminarios que son realizados por INTRAS." />
<meta property="og:image" content="https://managementupdate.com.do/images/share.jpg" />
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

          <div class="section-type-b" style="background: #F3F3F3;">
            <div class="container" style="background: white;margin-top: -40px;">
                @include('partials.slider_portada', ['article' => $articleFeatured])
                <div class="row" style="margin-top: 20px;">
                    <div class = "col-xs-11 col-sm-11 col-md-9 col-lg-9">
                        <h2 class="widget-title ui-title-inner text-left text-uppercase h2-edicion-anterior" style="font-size: 26px;font-weight: 300;">{{ preg_replace('/0/','#',$lastCategory->name, 1) }}</h2>
                      <div class="decor-left decor-edicion-anterior" style="margin-bottom: 20px;"></div>
                  </div>
                </div>
              <div class="row">
                <div class="col-md-9">
                  <div class="row">
                     @include('partials.articulos_portada', ['articles' => $articles])
                  </div>
                </div>
                <div class="col-md-3">



                    <div class="row" style="margin-top: -48px;">
                      <aside class="sidebar">

                    <section class="widget hidden-xs">
                      <h2 class="widget-title ui-title-inner text-left text-uppercase h2-edicion-anterior">En la edición anterior</h2>
                      <div class="decor-left decor-edicion-anterior" style="margin-bottom: 20px;"></div>

                      <div class="widget-content">
                       @include('partials.articulos_edicionant', ['articles' => $previousArticles])
                      </div>
                    </section>
                  </aside>
                  </div>
                    <div class="row" style="margin-bottom: 30px;">
                        <h2 class="widget-title ui-title-inner text-left text-uppercase h2-edicion-anterior" style="margin-bottom: 10px; margin-top: 20px;">Próximos seminarios</h2>
                      <div class="decor-left decor-edicion-anterior" ></div>
                      @include('partials.proximos_seminarios', ['seminarios' => $jsonSeminarios] )
<br><br><br>
                        </div>

                </div>
              </div>
            </div>
            <br><br>
          </div>

@endsection
