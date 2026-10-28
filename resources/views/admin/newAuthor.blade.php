@extends('layouts.admin.admin')

@section('header_scripts')

    <script src="//cdn.ckeditor.com/4.8.0/full/ckeditor.js"></script>

@endsection

@section('content')

<section class="section-padding">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header d-flex align-items-center">
                  <h4>Nuevo autor</h4>
                </div>
                <div class="card-body">
                  <form method="post" action="{{ url('/admin/authors/create') }}" enctype="multipart/form-data">
                    @csrf
                    @if ($errors->any())
                    <div class="alert alert-danger" style="padding-bottom: 0px;">
                     <ul>
                     @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                     @endforeach
                     </ul>
                    </div>
                    @endif
                    <div class="form-group">
                      <label>Nombre</label>
                      <input type="text" name="userName" class="form-control" required>                  
                    </div>
                    <div class="form-group" style="margin-top: 20px;margin-bottom: -10px;">
                      <div class="row">
                      
                      <div class="col-md-2">
                        <label>Sexo</label>
                        <select name="gender" class="form-control">
                          <option value="m" @if(old('gender') === 'm') selected @endif>Maculino</option>
                          <option value="f" @if(old('gender') === 'f') selected @endif>Femenino</option>
                        </select>
                      </div>

                      </div>                 
                    </div>

                    <hr style="border-style: none;">

                    <div class="form-group">
                        <label>Descripción</label>
                        <textarea name="description" id="description" rows="10" cols="80"></textarea>
                        <script>                
                        CKEDITOR.replace( 'description','content', {
    fullPage: true,
    extraPlugins: 'font,panelbutton,colorbutton,colordialog,justify,indentblock,aparat,buyLink',
    // You may want to disable content filtering because if you use full page mode, you probably
    // want to  freely enter any HTML content in source mode without any limitations.
    allowedContent: true,
    autoGrow_onStartup: true,
    enterMode: CKEDITOR.ENTER_BR
} );
                        </script>
                    </div>                    
                    <div class="form-group">       
                      <input type="submit" value="Guardar" class="btn btn-primary">
                    </div>
                  </form>
                </div>
              </div>
            </div>
        </div>
    </div>
</section>

@endsection()