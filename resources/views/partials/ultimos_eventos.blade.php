<section id="latest-events">
  <div class="container">
  <div class="row text-center">
      <h4>
          Próximos Seminarios
      </h4>

  
  </div>
  <div class="row mt-5">
      @foreach ($events->data as $event)
          <div class="col-md-2 text-center">
              <div class="card-transparent hvr-underline-from-left" style="overflow: visible;">
                  <a class="hvr-outline-out" href="#">
                      @php
                                  $portadita = false;
                                  @endphp
                                  @foreach ($event->files as $file)
                                      @if(isset($file->files_subjects_id) && $file->files_subjects_id == 25)
                                          <img src="{{$file->file_url}}" class="card-img-photo" alt="Portada">
                                          @php
                                          $portadita = true;
                                          @endphp
                                      @endif
                                  @endforeach

                                  @if(!$portadita)
                                      <img src="{{ url('images/sin-portada.jpg') }}" class="card-img-photo" alt="Portada">
                                  @endif
                                  
                  </a>
                  <div class="card-body">
                      <span class="card-title event-title">{{ strtoupper($event->name) }}</span>
                  </div>
              </div>
          </div>
      @endforeach
  
    

   
  </div>
</div>
</section>