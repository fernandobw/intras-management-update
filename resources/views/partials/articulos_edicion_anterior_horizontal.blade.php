<div class="ediciones-anteriores-bottom">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="title-sidebar">Ediciones Anteriores</h3>
            </div>
            @foreach($ediciones as $edicion)
            <div class="col-md-4">
                <div class="edicion-item">
                    <a href="{{ url('ediciones-anteriores/'.\Illuminate\Support\Str::slug($edicion->name)) }}" class="media mb-2">
                        <div class="media-left mr-2" style="width: 30%">
                            <img class="media-object"
                            src="{{$edicion->articles[0]->image ?? ''}}"
                            style="width:100%">
                        </div>
                        <div class="edicion-item--body">
                            @php

                            $nombre_edicion = explode(' ', $edicion->name);
                            if (isset($nombre_edicion[1])) {
                                // Acceder al segundo elemento del array si existe
                                $subcadena = substr($nombre_edicion[1], 1);
                                echo \Illuminate\Support\Str::limit('Edición No. ' . $subcadena, 55);
                            }
                            
                            @endphp
                        </div>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<style>
    .ediciones-anteriores-bottom {
        background-color: #E6E6E6;
        padding: 20px 20px;
        text-align: center;
        border-bottom: 1px solid #cfcfcf;
    }
    .edicion-item {
        background-color: #F7931E;
        color: #000;
    }
    .edicion-item a {
        display: flex;
        padding: 5px;
        align-items: center;
        min-height: 85px;
        /* border: 3px solid green; */
    }
    .edicion-item--body {
        display: flex;
        justify-content: center;
        padding-left: 10px;
        color: #000;
        font-weight: bold;
        font-size: 18px;
    }

    .edicion-item:hover {
        background: #FD9924;
        border-radius: 2px;
        box-shadow: 0px 2px 0px #bab9b9;
    }

    .media-object {
        height: 65px;
        margin-left: 4px;
        object-fit: cover;
    }
</style>


