@foreach($seminarios as $key => $seminario)

<div class="col-xs-12 hover-seminarios" style="margin-left: 0px;">

	@if($key != 0)

	<div id='border-seminarios' style='border-bottom: rgba(140, 140, 140, 0.7);border-width: 0px 0px 0.5px 0px;border-style: solid;margin-top: 5px;padding-bottom: 5px;'></div>

	@endif

	<h6 style="color: grey; text-transform: uppercase; font-size: 12px; margin-left: -15px; margin-top: 15px;" class="img-decor-edicion-anterior">{{ $seminario['Tipo'] }}</h6>

<a href="{{ $seminario['Link'] }}" target="_blank"><h4 style="margin-left: -15px;" class="img-decor-edicion-anterior">{{ $seminario['Titulo'] }}</h4></a>

<div class="col-xs-6 img2-decor-edicion-anterior" style="margin-left: -37px;"><a href="{{ $seminario['Link'] }}" target="_blank"><img src="{{ $seminario['Portadita'] }}" style="width: 130px;"></a></div>

<div class="col-xs-6 img3-decor-edicion-anterior" style="margin-top: 30px; margin-left: 20px;"><span class="course-date" style="/* margin-left: 10px;"><i class="fa fa-calendar-o"></i> {{ $seminario['Fecha'] }} </span> <a class="btn btn-xs" style="margin-top: 15px; background-color: #F6AE2D; color: rgba(0, 0, 0, 0.64);" href="{{ $seminario['Link'] }}" target="_blank">INSCRÍBASE</a></div>
</div>

@endforeach