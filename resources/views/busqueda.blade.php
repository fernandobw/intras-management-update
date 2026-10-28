@extends('layouts.page', ['titulo', 'Resultados de búsqueda: '.$query])

{{-- @section('styles_header') --}}

{{-- @endsection --}}

{{-- @section('titulo_categoria')

<h2 style="margin-top: 18px;font-size: 20px;" class="text-uppercase">Resultados de búsqueda</h2> <div class="decor-left decor-edicion-anterior" style="margin-bottom: 30px;"></div>

@endsection

--}}

@section('content')

@include('partials.menu', ['query' =>  $query ])


<section id="body" class="pt-4">

  <div class="container">
      <div class="row">

          <div class="col-md-12 col-lg-8">
           <div class="search">
              <p>
                <strong>Total: <span class="badge badge-info">{{ $total }}</span> resultados econtrados.</strong>
              </p>
              <dl class="search-results">
                @foreach($articles as $key => $article)

                  <dt class="result-title">
                    {{ $key+1 }}. <a href="{{ $article->url }}" style="font-size: 20px; font-weight: 600;"> {{ $article->title }} </a>
                  </dt>

                  <dd class="result-text">
                    {!! strip_tags(\Illuminate\Support\Str::limit($article->introtext, 300)) !!}
                  </dd>

                @endforeach
              </dl>

              <div class="pagination mt-5 mb-5">
                {{ $articles->links() }}
              </div>
            </div>
          </div>


          <div class="col-md-12 col-lg-4 mb-5">
            @include('partials.sidebar', ['articles' => $previousArticles])
          </div>
    </div>
  </div>
</section>
@include('partials.footer')
@endsection

