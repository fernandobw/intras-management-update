@extends('layouts.page', ['titulo' => $article->title])

@section('og_tags')

<meta property="og:url" content="{{ $article->url }}" />
<meta property="og:type" content="article" />
<meta property="og:title" content="{{ $article->title }}" />
<meta property="og:description" content="{!! \Illuminate\Support\Str::limit(strip_tags($article->introtext), 300) !!}" />
<meta property="og:image" content="{{ $article->image.'?w=1200&h=630&fit=crop' }}" />
<meta property="og:image:width" content="1200" />
<meta property="og:image:height" content="630" />

<meta name="twitter:card" content="summary_large_image"/>
<meta name="twitter:description" content="{!! \Illuminate\Support\Str::limit(strip_tags($article->introtext), 300) !!}"/>
<meta name="twitter:title" content="{{ $article->title }}"/>
<meta name="twitter:site" content="@intrasrd"/>
<meta name="twitter:image" content="{{ $article->image.'?w=1200&h=630&fit=crop' }}"/>
<meta name="twitter:creator" content="@intrasrd"/>
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">

<link rel='stylesheet' id='expert_links_styles-css' href='https://intras.com.do/wp-content/plugins/intras/assets/css/expert-links.css?ver=6.3.1' type='text/css' media='all' />

{!! $schemaScript !!}
@endsection

@section('content')
@include('partials.menu')
  <section id="body" class="pt-4">
    @include('partials.banner-horizontal')
    <div class="container">
        <div class="row pt-4">
            <div class="col-md-12 col-lg-8">

                @include('partials.articulo_detalle')

                @if( isset( $intras_sites ) )

                    <div class="intras-ecosystem mb-5">
                        <h5><strong>Para conocer más sobre {{ $article->created_by_alias }}</strong></h5>

                        <ul class="intras-links">

                            <li class="intras">
                                <div class="label">
                                    Próximos eventos
                                </div>
                                <a href="https://intras.com.do/eventos/?se={{ $article->created_by_alias }}" target="_blank">
                                   <img class="tv" src="https://intras.com.do/wp-content/plugins/intras/images/logo-intras.svg" alt="Logo Temas de Vanguardia">
                                </a>
                            </li>


                            <?php

                            $managementUpdate = false;

                            foreach( $intras_sites as $site ):

                                ?>

                                <?php if( isset( $site->link ) && str_contains( $site->link, 'temasdevanguardia.com' ) ): ?>
                                    <li class="tv">
                                        <div class="label">
                                            Entrevistas en
                                        </div>
                                        <a href="https://<?php echo $site->link; ?>" target="_blank">
                                            <img class="tv" src="https://intras.com.do/wp-content/plugins/intras/images/logo-vanguardia.png" alt="Logo Temas de Vanguardia">
                                        </a>
                                    </li>
                                <?php endif; ?>

                                <?php if( isset( $site->link ) && str_contains( $site->link, 'managementupdate.com.do' ) ): ?>
                                    <?php $managementUpdate = true; ?>
                                    <li class="management-update">
                                        <div class="label">
                                            Artículos en
                                        </div>
                                        <a href="https://<?php echo $site->link; ?>" target="_blank">
                                            <img class="mu" src="https://intras.com.do/wp-content/plugins/intras/images/mu.png" alt="Logo Management Update">
                                        </a>
                                    </li>
                                <?php endif; ?>

                                <?php if( isset( $site->link ) && str_contains( $site->link, 'gestion.com.do' ) ): ?>
                                    <li class="gestion">
                                        <div class="label">
                                            Artículos en
                                        </div>
                                        <a href="https://<?php echo $site->link; ?>" target="_blank">
                                            <img class="gestion" src="https://intras.com.do/wp-content/plugins/intras/images/gestion-logo.png" alt="Logo Gestión">
                                        </a>
                                    </li>
                                <?php endif; ?>

                                <?php if( isset( $site->link ) && str_contains( $site->link, 'intrasbookstore.com' ) ): ?>
                                    <li class="ibs">
                                        <div class="label">
                                            Libros en
                                        </div>
                                        <a href="https://<?php echo $site->link; ?>" target="_blank">
                                            <img class="bookstore" src="https://intras.com.do/wp-content/plugins/intras/images/logo-bookstored.png" alt="Logo Intras Bookstore">
                                        </a>
                                    </li>
                                <?php endif; ?>

                                <?php if( isset( $site->link ) && str_contains( $site->link, 'intras.com.do' ) ): ?>
                                    <li class="intras">
                                        <div class="label">
                                            Próximos eventos en
                                        </div>
                                        <a href="https://<?php echo $site->link; ?>" target="_blank">
                                            <img class="intras" src="https://intras.com.do/wp-content/plugins/intras/images/logo-intras.svg" alt="Logo INTRAS">
                                        </a>
                                    </li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                @endif

            </div>

            <div class="col-md-12 col-lg-4 mb-5">
                @include('partials.sidebar', ['articles' => $previousArticles, 'intras_sites'=>$intras_sites])

                <div id="sidebarViews">
                  <div class="row">
                    <div class="col-md-12 postViews">
                        Visto {{ $article->hits }} veces.
                    </div>
                  </div>
                </div>

            </div>
        </div>
        </div>
    </div>
</section>
@include('partials.footer')
@endsection
