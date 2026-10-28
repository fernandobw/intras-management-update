<article class="article">
    <h1 class="mb-2 postTitle">{{ $article->title }}
        @auth <span class="postEditBtn"><a target="_blank" href="{{ url("/admin/items/$article->id") }}">
                edit</a></span> @endauth
    </h1>
    @isset($article->created_at)
        <p>Publicado el {{$article->created_at->isoFormat('D [de] MMMM [del] Y')}}</p>
    @else
        <p>Publicado el {{$article->created->isoFormat('D [de] MMMM [del] Y')}}</p>
    @endisset

    <!-- Go to www.addthis.com/dashboard to customize your tools -->
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=intrasrd"></script>
    <div class="addthis_inline_share_toolbox" style="margin-top: 15px;"></div>
    <!--  End -->

    <a class="commentsBtn" href="#comentarios" onclick="disqus()">
        ¡Comenta<span class="hidden-sm"> esta publicación</span>!
    </a>
    <div style="clear: both"></div>

    @if (file_exists(public_path($article->imageLocal)) && !str_contains($article->introtext, 'avVideo'))

        <img class="firstImg img-fluid mb-3" src="{{ $article->image }}?w=1200&h=500&fit=crop"
            alt="{{ $article->title }}">

    @endif

    <div class="row">
        <div class="col-md-12 ">
            {!! $article->introtext !!}
        </div>
    </div>
</article>

<section id="comentarios">
    @include('partials.comentarios')
</section>
