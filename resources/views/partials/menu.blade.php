<section>
    <div id="header">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light bg-white">
                <a class="navbar-brand" href="{{ url('') }}">
                    <img src="{{ url('resize/logo-mu.svg') }}" alt="" width="214">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto" style="margin-right: 20px;">
                        <li class="nav-item">
                            <div class="dropdown">
                                <a class="nav-link dropdown-toggle dropbtn" href="#" id="navbarDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="    text-transform: uppercase;">
                                Áreas Temáticas
                            </a>

                                <div id="myCatDropdown" class="dropdown-menu dropdown-content_style">
                                  <input type="text" placeholder="Filtrar.." id="myCatInput" onkeyup="filterCatFunction()">
                                  <div class="scrollable">
                                    @foreach ($allCategories as $category)
                                    <a href="{{ url('categorias/'.\Illuminate\Support\Str::slug($category->name)) }}">{{ $category->name }}</a>
                                    @endforeach
                                  </div>


                                </div>
                              </div>
                        </li>

                        <li class="nav-item">
                            <div class="dropdown">
                                <a class="nav-link dropdown-toggle dropbtn" href="#" id="navbarDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                EDICIONES
                            </a>

                                <div id="myTagDropdown" class="dropdown-menu dropdown-content_style">
                                  <input type="text" placeholder="Filtrar.." id="myTagInput" onkeyup="filterTagFunction()">
                                  <div class="scrollable">
                                    @foreach ($allTags as $tag)
                                    <a href="{{ url('ediciones-anteriores/'.\Illuminate\Support\Str::slug($tag->name)) }}">{{ $tag->name }}</a>
                                    @endforeach
                                  </div>


                                </div>
                              </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('contacto') }}">CONTACTO</a>
                        </li>
                    </ul>

                    <form id="searchForm" class="form-inline my-2 my-lg-0" action="{{ url('/search/') }}" method="get">
                        <div class="btn-toolbar">
                          <div class="btn-group pull-left">
                            <input id="search-input" type="text" name="searchword" title="Búsqueda" placeholder="Buscar" size="30" maxlength="200" value="{{ $query ?? ''}}" class="inputbox" autocomplete="off">
                          </div>
                          <button id="search-btn" class="btn btn-outline-success my-2 my-sm-0" type="submit"></button>
                        </div>

                        </form>

                </div>
            </nav>
        </div>
    </div>
</section>
<style>
    .dropbtn {
        cursor: pointer;
        border-top: 1px solid rgba(255,255,255,0);
        border-left: 1px solid rgba(255,255,255,0);
        border-right: 1px solid rgba(255,255,255,0);
    }

    .dropbtn:hover, .dropbtn:focus {
        background-color: #f6f6f6;
        border-top: 1px solid #ccc;
        border-left: 1px solid #ccc;
        border-right: 1px solid #ccc;
    }

    #myCatInput, #myTagInput {
        box-sizing: border-box;
        /* background-image: url('searchicon.png'); */
        background-position: 14px 12px;
        background-repeat: no-repeat;
        font-size: 16px;
        padding: 14px 20px 12px 16px;
        border: none;
        border-bottom: 1px solid #ddd;
        width: 100%;
    }

    #myInput:focus {outline: 3px solid #ddd;}

    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-content_style {
        display: none;
        position: absolute;
        background-color: #f6f6f6;
        min-width: 230px;
        overflow: auto;
        border: 1px solid #ddd;
        z-index: 1;
    }

    .dropdown-content_style a {
        color: #636363;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
        font-weight: 500;

    }

    .dropdown a:hover {background-color: #ddd;}

    .show {display: block;}

    .scrollable{
        height: auto;
        max-height: 80vh;
        overflow-y: scroll;
    }

</style>
