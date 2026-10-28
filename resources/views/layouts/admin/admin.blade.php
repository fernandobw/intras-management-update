<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Dashboard | Management Update</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="robots" content="all,follow">
        <!-- Bootstrap CSS-->
        <link rel="stylesheet" href="{{ asset('dashboard/vendor/bootstrap/css/bootstrap.min.css') }}">
        <!-- Font Awesome CSS-->
        <link rel="stylesheet" href="{{ asset('dashboard/vendor/font-awesome/css/font-awesome.min.css') }}">
        <!-- Fontastic Custom icon font-->
        <link rel="stylesheet" href="{{ asset('dashboard/css/fontastic.css') }}">
        <!-- Google fonts - Roboto -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700 }}">
        <!-- jQuery Circle-->
        <link rel="stylesheet" href="{{ asset('dashboard/css/grasp_mobile_progress_circle-1.0.0.min.css') }}">
        <!-- Custom Scrollbar-->
        <link rel="stylesheet" href="{{ asset('dashboard/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css') }}">
        <!-- theme stylesheet-->
        <link rel="stylesheet" href="{{ asset('dashboard/css/style.default.css') }}" id="theme-stylesheet">
        <!-- Custom stylesheet - for your changes-->
        <link rel="stylesheet" href="{{ asset('dashboard/css/custom.css') }}">
        <!-- Favicon-->
        <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}">
        <link rel="stylesheet" href="{{ asset('dashboard/css/admin.css') }}">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
        @yield('header_scripts')
        <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
    </head>
    <body>
        <!-- Side Navbar -->
        <nav class="side-navbar">
            <div class="side-navbar-wrapper">
                <!-- Sidebar Header    -->
                <div class="sidenav-header d-flex align-items-center justify-content-center">
                    <!-- User Info-->
                    <div class="sidenav-header-inner text-center">
                        <img src="https://ui-avatars.com/api/?background=009689&color=fff&name=Admin&size=50" alt="person" class="img-fluid rounded-circle">
                        <h2 class="h5">Admin</h2>
                    </div>
                    <!-- Small Brand information, appears on minimized sidebar-->
                    <div class="sidenav-header-logo"><a href="{{ url('/admin/') }}" class="brand-small text-center"> <strong>D</strong><strong class="text-primary">B</strong></a></div>
                </div>
                <!-- Sidebar Navigation Menus-->
                <div class="main-menu">
                    <h5 class="sidenav-heading">Main</h5>
                    <ul id="side-main-menu" class="side-menu list-unstyled">
                        <li><a href="{{ url('/admin') }}"> <i class="icon-home"></i>Inicio</a></li>
                        <li>
                            <a href="#articulosDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-interface-windows"></i>Articulos</a>
                            <ul id="articulosDropdown" class="collapse list-unstyled ">
                                <li><a href="{{ url('admin/items') }}">Gestionar artículos</a></li>
                                <li><a href="{{ url('admin/items/create') }}">Nuevo artículo</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#usuariosDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-user"></i>Usuarios</a>
                            <ul id="usuariosDropdown" class="collapse list-unstyled ">
                                <li><a href="{{ url('/admin/users') }}">Gestionar usuarios</a></li>
                                <li><a href="{{ url('/admin/users/create') }}">Nuevo usuario</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#categoriasDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-form"></i>Categorias</a>
                            <ul id="categoriasDropdown" class="collapse list-unstyled ">
                                <li><a href="{{ url('/admin/categories') }}">Gestionar categorias</a></li>
                                <li><a href="{{ url('/admin/categories/create') }}">Nueva categoria</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#autoresDropdown" aria-expanded="false" data-toggle="collapse"> <i class="fa fa-address-book"></i>Autores</a>
                            <ul id="autoresDropdown" class="collapse list-unstyled ">
                                <li><a href="{{ url('/admin/authors') }}">Gestionar autores</a></li>
                                <li><a href="{{ url('/admin/authors/create') }}">Nuevo autor</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#edicionesDropdown" aria-expanded="false" data-toggle="collapse"> <i class="fa fa-tag"></i>Ediciones</a>
                            <ul id="edicionesDropdown" class="collapse list-unstyled ">
                                <li><a href="{{ url('/admin/tags') }}">Gestionar Ediciones</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="page">
            <!-- navbar-->
            <header class="header">
                <nav class="navbar">
                    <div class="container-fluid">
                        <div class="navbar-holder d-flex align-items-center justify-content-between">
                            <div class="navbar-header">
                                <a id="toggle-btn" href="#" class="menu-btn"><i class="icon-bars"> </i></a>
                                <a href="{{ asset('/admin') }}" class="navbar-brand">
                                    <div class="brand-text d-none d-md-inline-block"><span>Management</span><strong class="text-primary">Update</strong></div>
                                </a>
                            </div>
                            <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                                <li class="nav-item dropdown">
                                    <a id="notifications" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link"><i class="fa fa-bell"></i><span class="badge badge-warning">12</span></a>
                                    <ul aria-labelledby="notifications" class="dropdown-menu">
                                        <li>
                                            <a rel="nofollow" href="#" class="dropdown-item">
                                                <div class="notification d-flex justify-content-between">
                                                    <div class="notification-content"><i class="fa fa-envelope"></i>You have 6 new messages </div>
                                                    <div class="notification-time"><small>4 minutes ago</small></div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a rel="nofollow" href="#" class="dropdown-item">
                                                <div class="notification d-flex justify-content-between">
                                                    <div class="notification-content"><i class="fa fa-twitter"></i>You have 2 followers</div>
                                                    <div class="notification-time"><small>4 minutes ago</small></div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a rel="nofollow" href="#" class="dropdown-item">
                                                <div class="notification d-flex justify-content-between">
                                                    <div class="notification-content"><i class="fa fa-upload"></i>Server Rebooted</div>
                                                    <div class="notification-time"><small>4 minutes ago</small></div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a rel="nofollow" href="#" class="dropdown-item">
                                                <div class="notification d-flex justify-content-between">
                                                    <div class="notification-content"><i class="fa fa-twitter"></i>You have 2 followers</div>
                                                    <div class="notification-time"><small>10 minutes ago</small></div>
                                                </div>
                                            </a>
                                        </li>
                                        <li><a rel="nofollow" href="#" class="dropdown-item all-notifications text-center"> <strong> <i class="fa fa-bell"></i>view all notifications                                            </strong></a></li>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown">
                                    <a id="messages" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link"><i class="fa fa-envelope"></i><span class="badge badge-info">10</span></a>
                                    <ul aria-labelledby="notifications" class="dropdown-menu">
                                        <li>
                                            <a rel="nofollow" href="#" class="dropdown-item d-flex">
                                                <div class="msg-profile"> <img src="{{ asset('dashboard/img/avatar-1.jpg') }}" alt="..." class="img-fluid rounded-circle"></div>
                                                <div class="msg-body">
                                                    <h3 class="h5">Jason Doe</h3>
                                                    <span>sent you a direct message</span><small>3 days ago at 7:58 pm - 10.06.2014</small>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a rel="nofollow" href="#" class="dropdown-item d-flex">
                                                <div class="msg-profile"> <img src="{{ asset('dashboard/img/avatar-2.jpg') }}" alt="..." class="img-fluid rounded-circle"></div>
                                                <div class="msg-body">
                                                    <h3 class="h5">Frank Williams</h3>
                                                    <span>sent you a direct message</span><small>3 days ago at 7:58 pm - 10.06.2014</small>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a rel="nofollow" href="#" class="dropdown-item d-flex">
                                                <div class="msg-profile"> <img src="{{ asset('dashboard/img/avatar-3.jpg') }}" alt="..." class="img-fluid rounded-circle"></div>
                                                <div class="msg-body">
                                                    <h3 class="h5">Ashley Wood</h3>
                                                    <span>sent you a direct message</span><small>3 days ago at 7:58 pm - 10.06.2014</small>
                                                </div>
                                            </a>
                                        </li>
                                        <li><a rel="nofollow" href="#" class="dropdown-item all-notifications text-center"> <strong> <i class="fa fa-envelope"></i>Read all messages    </strong></a></li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <form method="post" action="{{ route('logout') }}">
                                        @csrf
                                        <button class="nav-link logout" type="submit" style="background:  none;border: none;color: white; font-size: 0.9em;">Cerrar sesión<i class="fa fa-sign-out"></i></button>               
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </header>
            @yield('content')    
            <footer class="main-footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <p>Management Update &copy; 2018</p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <!-- Javascript files-->
        <script src="{{ asset('dashboard/vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('dashboard/vendor/popper.js/umd/popper.min.js') }}"> </script>
        <script src="{{ asset('dashboard/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('dashboard/js/grasp_mobile_progress_circle-1.0.0.min.js') }}"></script>
        <script src="{{ asset('dashboard/vendor/jquery.cookie/jquery.cookie.js') }}"> </script>
        <script src="{{ asset('dashboard/vendor/jquery-validation/jquery.validate.min.js') }}"></script>
        <script src="{{ asset('dashboard/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js') }}"></script>
        <script src="https://cdn.ckeditor.com/ckeditor5/16.0.0/balloon-block/ckeditor.js"></script>
        <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
        <!-- Main File-->
        <script src="{{ asset('dashboard/js/front.js') }}"></script>
        @yield('scripts_footer')
    </body>
</html>