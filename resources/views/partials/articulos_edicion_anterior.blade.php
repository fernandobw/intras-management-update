<div class="row">
    <div class="col-md-12">
        <h5 class="title-sidebar">Edición Anterior</h5>
    </div>   
    @foreach($articles as $article)    
    <div class="col-md-12">
        
        <a href="{{ $article->url }}" class="media mb-2">
            <div class="media-left mr-2" style="width: 30%">
                
                <img class="media-object" src="{{ $article->image.'?w=130&h=74&fit=crop' }}" style="width:100%">
            
            </div>
            <div class="media-body align-self-center">
            <p class="media-heading card card-block">{{ \Illuminate\Support\Str::limit($article->title, 55) }}</p>
            </div>
        
        </a>
    </div>
    @endforeach
  
</div>


