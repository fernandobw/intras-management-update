@extends('layouts.page', ['titulo' => $category->name])


@section('styles_header')

<link rel="stylesheet" href="{{ asset('/components/com_k2/css/k2.css') }}"/>

@endsection

@section('og_tags')

{{-- <meta property="og:url" content="{{ $article->url }}" />
<meta property="og:type" content="article" />
<meta property="og:title" content="{{ $article->title }}" />
<meta property="og:description" content="{!! str_limit(strip_tags($article->introtext), 300) !!}" />
<meta property="og:image" content="{{ $article->image.'?w=1200&h=630&fit=crop' }}" />
<meta property="og:image:width" content="1200" />
<meta property="og:image:height" content="630" />

<meta name="twitter:card" content="summary"/>
<meta name="twitter:description" content="{!! str_limit(strip_tags($article->introtext), 300) !!}"/>
<meta name="twitter:title" content="{{ $article->title }}"/>
<meta name="twitter:site" content="@intrasrd"/>
<meta name="twitter:image" content="{{ $article->image.'?w=1200&h=630&fit=crop' }}"/>
<meta name="twitter:creator" content="@intrasrd"/> --}}

@endsection

@include('partials.menu')

@section('content')
<section id="body" class="pt-4">
    @include('partials.banner-horizontal')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-8">
              <h4>{{ $category->name }}</h4>

                @if(count($articles) < 1)
                <div>
                  <h5>No se encontraron resultados en esta categoría</h5>
                </div>
                @else
                  {{-- @foreach($articles as $article) --}}
                  @include('partials.articulos_categoria', ['articles' => $articles ])

                  {{-- @endforeach --}}

                @endif

                {{-- @include('partials.articulo_detalle')  --}}

            </div>

            <div class="col-md-12 col-lg-4 mb-5">
                @include('partials.sidebar', ['articles' => $previousArticles])
            </div>
        </div>
        </div>
    </div>
</section>


@include('partials.footer')

@endsection


