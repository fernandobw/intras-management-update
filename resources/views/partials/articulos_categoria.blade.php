
<div class="principal row mb-2">

    @foreach($articles as $index => $article) 

        @if($index == 0)
        
            <div class="col-md-12">
                <div class="card rounded-0 mb-4 box-shadow">
                    <a href="{{ $article->url }}" class="hvr-underline-reveal">
                        <div class="img-container-first">
                            
                            <div class="img-container-first" style="background-image: url({{ $article->image.'?w=728&h=304&fit=crop' }}">
                        </div>
                        </div>
                        <div class="card-body">
                            <p class="card-text font-18 d-flex align-content-center flex-wrap @if(strstr($article->title, 'Vídeo')) card-text-video @endif">{{ $article->title }}</p>
                        </div>
                    </a>
                </div>
            </div>
        


        @else
        
            <div class="col-md-6 pb-2">
                <div class="card rounded-0 mb-4 box-shadow">
                    <a href="{{ $article->url }}" class="hvr-underline-reveal">
              
                        <div class="img-container">
                            <div class="img-container" style="background-image: url({{ $article->image.'?w=348&h=174&fit=crop' }}"></div>
                                
          
                        </div>
                        <div class="card-body">
                            <p class="card-text d-flex align-content-center flex-wrap @if(strstr($article->title, 'Vídeo')) card-text-video @endif">{{ Str::limit($article->title, 112) }}</p>
                        </div>
                    </a>
                </div>
            </div>

        @endif
    @endforeach       

</div>            
            
          
