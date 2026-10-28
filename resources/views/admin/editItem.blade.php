@extends('layouts.admin.admin')

@section('header_scripts')
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="{{ asset('/dashboard/js/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('/dashboard/js/ckeditor/config.js') }}"></script>
<link rel="stylesheet" href="{{ asset('dashboard/css/admin.css') }}">
<link rel="stylesheet" href="{{ asset('dashboard/js/bootstrap-tagsinput/bootstrap-tagsinput.css') }}">
<script src="{{ asset('dashboard/js/bootstrap-tagsinput/bootstrap-tagsinput.js') }}"></script>
@endsection

@section('content')
<section class="section-padding">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header d-flex align-items-center">
						<h4>Nuevo artículo</h4>
					</div>
					<div class="card-body">
						<form method="post" action="{{ url('/admin/items/'.$item->id) }}" enctype="multipart/form-data" onkeypress="return event.keyCode != 13;" autocomplete="off">
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
								<label>Titulo</label>
								<input type="text" name="title" class="form-control" required value="{{ $item->title }}">
							</div>
							<div class="form-group">
								<label>Alias del titulo</label>
								<input type="text" name="alias" class="form-control col-md-8" placeholder="Generado automáticamente" value="{{ $item->alias }}">
							</div>
							<div class="row" style="margin-top: 10px;">
								<div class="col-md-3">
									<label>Categoría</label>
									<select name="catid" class="form-control" required>
									@foreach($categories as $category)
									<option value="{{ $category->id }}" @if($category->id == $item->category->id) selected @endif>{{ $category->name }}</option>
									@endforeach
									</select>
								</div>
								<div class="col-md-3">
									<label>Alias del autor</label>
									<input type="text" name="created_by_alias" class="form-control" value="{{ $item->created_by_alias }}">
								</div>
								<div class="col-md-3">
									<label>Video</label>
									<input type="text" name="video" class="form-control" placeholder="Identificador del video" value="{{ str_replace(array('{YouTube}','{/YouTube}'),array('',''),$item->video) }}">
								</div>
							</div>
							<div class="row" style="margin-top: 10px;">

								<div class="col-md-3">
									<label>Facilitador</label>
									<select name="idfacilitador" class="form-control" required>
										@foreach($facilitators as $facilitator)
											<option value="{{ $facilitator->userID }}" @if($facilitator->userID == $item->id_facilitador) selected @endif>{{ $facilitator->userName }}</option>
										@endforeach
									</select>
								</div>

								<div class="col-md-3">
									<label>Linea temática</label>
									<select name="idlineatematica" class="form-control" required>
									@foreach($categories as $category)
										<option value="{{ $category->id }}" @if($category->id == $item->id_lineatematica) selected @endif>{{ $category->name }}</option>
									@endforeach
									</select>
								</div>
							</div>
							<div class="form-group" style="margin-top: 10px;">
								<label>Etiquetas | {{ $tagsStr }}</label>
								<input type="text" name="tags" class="form-control" data-role="tagsinput" value="{{ $tagsStr }}">
							</div>
							<div class="form-group" style="margin-top: 20px;margin-bottom: 20px;">
								<label>Autor</label>
								<div class="row">
									<div class="col-md-3">
										<select name="created_by" class="form-control">
										@foreach($authors as $author)
										<option value="{{ $author->userID }}" @if($author->userID == $item->created_by) selected @endif>{{ $author->userName }}</option>
										@endforeach
										</select>
									</div>
									<div class="col-md-3" style="margin-top: -38px;">
										<label>Imagen</label>
										<input type="file" name="image" class="form-control">
									</div>
									<div class="col-md-2">
										<label class="checkbox-inline">
										<label>Es un articulo destacado?</label>
										<input name="featured" type="checkbox" value="1" @if($item->featured == 1) checked @endif>
										</label>
									</div>
									<div class="col-md-2">
										<label class="checkbox-inline">
										<label>Publicado?</label>
										<input name="published" type="checkbox" value="1" @if($item->published == 1) checked @endif
										</label>
									</div>
								</div>
							</div>
							<div class="form-group">
								<textarea name="introtext" rows="10" cols="80">{{ $item->introtext }}</textarea>
								<script>
									CKEDITOR.replace('introtext');
									CKEDITOR.replace('content');
								</script>
							</div>
							<div class="form-group">
								<input type="submit" value="Actualizar" class="btn btn-primary">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection