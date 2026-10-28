<div class="moduletable">
						<div class="allmode-box allmode-video-destacado-right ">



<div class="col-md-12" style="margin-left: -15px;">



 
 @foreach($articles as $article)          


<div class="row" style="margin-bottom: 10px;">


                              <div class="col-md-5 img-edicion-anterior"><a href="/"></a><a href="{{ $article->url }}"><img class="img-responsive" src="{{ $article->image.'?w=360&h=200&fit=crop' }}" width="360" height="200" title="{{ $article->title }}" alt=""></a> </div>
                              <div>
                                <div class="col-md-7">
                                  <h2 class="h2-edicion-anterior-content hover-entradas-edicion"><a href="{{ $article->url }}">{{ \Illuminate\Support\Str::limit($article->title, 55) }}</a></h2>
                                </div>
                              </div>
                       
                          
                          
                          </div>

@endforeach

</div>
</div>		</div>