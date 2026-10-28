<!DOCTYPE html>
<html lang="en" class="no-js">
  <head>
    
    <meta charset="utf-8"/>
    <meta http-equiv="x-ua-compatible" content="ie=edge"/>
    <title>@yield('titulo')</title>
    <meta content="" name="description"/>
    <meta content="" name="keywords"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta content="telephone=no" name="format-detection"/>
    <meta name="HandheldFriendly" content="true"/>
    <link rel="stylesheet" href="{{ asset('/templates/contenido/css/master.css') }}"/>
    <link href="{{ asset('/modules/mod_jux_megamenu/css/style.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/modules/mod_jux_megamenu/css/blue.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/modules/mod_jux_megamenu/css/style_responsive.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/media/com_acymailing/css/module_default.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('/media/jui/js/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/media/jui/js/jquery-noconflict.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/media/jui/js/jquery-migrate.min.js') }}" type="text/javascript"></script>   
    <link rel="icon" type="image/x-icon" href="favicon.ico"/>    
    <script>(function(H){H.className=H.className.replace(/\bno-js\b/,'js')})(document.documentElement)</script>
    @yield('styles_header')

        <style>
        a.active {
  height: 69px !important;
}
    </style>
    <!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window,document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '514540168899694'); 
fbq('track', 'PageView');
</script>
<noscript>
<img height="1" width="1" 
src="https://www.facebook.com/tr?id=514540168899694&ev=PageView
&noscript=1"/>
</noscript>
<!-- End Facebook Pixel Code -->

@yield('og_tags')

  </head>
  <body>
      <!-- Loader-->
    <div id="page-preloader"><span class="spinner"></span></div>
    <!-- Loader end-->
    <div data-header="sticky" data-header-top="200" class="layout-theme animated-css">
      <!-- Start Switcher-->
      
      <!-- end switcher-->
      <div class="cd-main">
        <div class="wrap-content cd-section cd-selected">
          <header class="header">
            <div class="top-header">
              <div class="container">
                <div class="row">
                  <div class="col-xs-12">
                     <div class="top-header__link bg-primary suspadding">
                      <a href="#" style="color:white;" data-toggle="modal" data-target="#modalSuscribir"><div class="top-header__wrap-link" style="margin-right: 35px;"><span style="color: #666;">SUSCRIBIRME</span><i class="icon fa fa-caret-right" style="color: #F6AE2D"></i></div></a>
                      <!-- btn_suscribir_top -->
                    </div>
                    <div class="top-header__ticker">
                       <!-- menu_top -->
                      <ul id="myUls" class="hidden-xs">
                       <li class="news-item"><a href="{{ url('/') }}" class="news-item__link">Inicio</a><i class="icon fa fa-adjust"></i></li>
                        <li class="news-item"><a href="{{ url('sobre-el-management-update') }}" class="news-item__link">Sobre el management update</a><i class="icon fa fa-adjust"></i></li>
                        <li class="news-item"><a href="{{ url('contacto') }}" class="news-item__link">Contacto</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="header-main">
              <div class="container">
                <div class="row">
                  <div class="col-md-3 logopadding">
                    <a href="{{ url('/') }}" class="logo"><img src="{{ asset('/templates/contenido/media/general/logo_mod-a.png') }}" alt="Logo" class="logo__img img-responsive center-block"/></a>
                  </div>
                  <div class="col-md-3">
                     <!-- social_top -->
                    <ul class="social-links list-inline hidden-xs">
                      <li><a href="http://www.facebook.com/intrasrd" class="social-links__item_link"><i class="icon fa fa-facebook"></i></a></li>
                      <li><a href="http://www.twitter.com/intrasrd" class="social-links__item_link"><i class="icon fa fa-twitter"></i></a></li>
                      
                      <li><a href="http://www.instagram.com/intrasrd" class="social-links__item_link"><i class="icon fa fa-instagram"></i></a></li>
                      <li><a href="http://www.linkedin.com/company/intras" class="social-links__item_link"><i class="icon fa fa-linkedin"></i></a></li>
                      
                    </ul>
                    </div>
                  <div class="col-md-3 hidden-xs">
                    
                    <div class="header-main__links">
                      @include('partials.suscribir_top')  
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </header>
         <div class="wrap-nav">
          
            <nav class="navbar yamm yamm_mod-a">
              <div id="navbar-collapse-1" class="navbar-collapse collapse">
                <div class="container">
                  <div class="row">
                    
                     <div class="col-xs-12">
                      @include('partials.menu_principal')
                    </div>
                  </div>
                </div>
              </div>
              <div class="header-search">
                <div class="container">
                  <div class="row">
                    <div class="col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1">
                      <div class="navbar-search">
                        <form class="search-global">
                           <!-- buscar_modal -->
                          <input type="text" placeholder="Buscar..." autocomplete="off" name="s" value="" class="search-global__input"/>
                          <button class="search-global__btn"><i class="icon fa fa-search"></i></button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <button type="button" class="search-close close"><i class="fa fa-times"></i></button>
              </div>
            </nav>
            
          </div>
          
          <div class="section-type-f" style="background: #F3F3F3;">
            <div class="container" style="background: #FFFFFF;">
                
                <!-- breadcrumbs -->
                
              <div class="row">
                  
                     
      
                <div class="col-md-8" style="margin-top: 50px;">
                    
                   @yield('titulo_categoria')
                   
                  <article class="post post-full clearfix">
                    
                    <div class="entry-main">
                      
                      @yield('content')
                      
                    </div>
                  </article>
                </div>
                <div class="col-md-3 col-md-offset-1 padding-mobile">
                    
                       
             
                    @yield('content_left')
                  
                    
              
                  
                  
                </div>
                
                
                
                
                
                
                
                
                
                
                
                
                
                
              </div>
              
              
              
            </div>
          </div>
          
          

      


          

          <footer class="footer">
            
            @include('partials.footer')
                      
           
            
            <div class="footer-bottom">
              <div class="container">
                <div class="row">
                  <div class="col-xs-12">
                    
                    <div class="footer-bottom__inner">
                      <!-- social_footer -->
                                 <ul class="social-links list-inline">
                                  <li><a href="http://www.facebook.com/intrasrd" class="social-links__item_link"><i class="icon fa fa-facebook"></i></a></li>
                                  <li><a href="http://www.twitter.com/intrasrd" class="social-links__item_link"><i class="icon fa fa-twitter"></i></a></li>
                                  
                                  <li><a href="http://www.instagram.com/intrasrd" class="social-links__item_link"><i class="icon fa fa-instagram"></i></a></li>
                                  <li><a href="http://www.linkedin.com/company/intras" class="social-links__item_link"><i class="icon fa fa-linkedin"></i></a></li>
                                  
                                </ul>
                    </div>
                    
                    <div class="copyright">
                        @include('partials.copyright_footer')
                      </div>
                  </div>
                </div>
              </div>
            </div>
          </footer>
          <!-- end wrap-content-->
        </div>
      </div>
    </div>
    <nav id="cd-nav" class="cd-nav-container"><a href="#0" class="cd-close-nav">Cerrar</a>
      <nav class="sidebar-nav">
        <ul class="sidebar-nav__list list-unstyled">
          <li><a href="#" data-toggle="dropdown">world</a>
            <ul role="menu" class="dropdown-menu">
              <li>
                <ul class="list list-mark-1 list-mark-1_mod-a">
                  <li><a href="category.html">Asia & europe</a></li>
                  <li><a href="category.html">festival games</a></li>
                  <li><a href="category.html">world organizations</a></li>
                  <li><a href="category.html">africa & middle east</a></li>
                  <li><a href="category.html">pakistan & india</a></li>
                  <li><a href="category.html">usa & canada</a></li>
                </ul>
              </li>
            </ul>
          </li>
          <li><a href="#" data-toggle="dropdown">Health</a>
            <ul role="menu" class="dropdown-menu">
              <li>
                <ul class="list list-mark-1 list-mark-1_mod-a">
                  <li><a href="category.html">Asia & europe</a></li>
                  <li><a href="category.html">festival games</a></li>
                  <li><a href="category.html">world organizations</a></li>
                  <li><a href="category.html">africa & middle east</a></li>
                  <li><a href="category.html">pakistan & india</a></li>
                  <li><a href="category.html">usa & canada</a></li>
                </ul>
              </li>
            </ul>
          </li>
          <li><a href="#" data-toggle="dropdown">technology</a>
            <ul role="menu" class="dropdown-menu">
              <li>
                <ul class="list list-mark-1 list-mark-1_mod-a">
                  <li><a href="category.html">Asia & europe</a></li>
                  <li><a href="category.html">festival games</a></li>
                  <li><a href="category.html">world organizations</a></li>
                  <li><a href="category.html">africa & middle east</a></li>
                  <li><a href="category.html">pakistan & india</a></li>
                  <li><a href="category.html">usa & canada</a></li>
                </ul>
              </li>
            </ul>
          </li>
          <li><a href="#" data-toggle="dropdown">politics</a>
            <ul role="menu" class="dropdown-menu">
              <li>
                <ul class="list list-mark-1 list-mark-1_mod-a">
                  <li><a href="category.html">Asia & europe</a></li>
                  <li><a href="category.html">festival games</a></li>
                  <li><a href="category.html">world organizations</a></li>
                  <li><a href="category.html">africa & middle east</a></li>
                  <li><a href="category.html">pakistan & india</a></li>
                  <li><a href="category.html">usa & canada</a></li>
                </ul>
              </li>
            </ul>
          </li>
          <li><a href="#" data-toggle="dropdown">entertainment</a>
            <ul role="menu" class="dropdown-menu">
              <li>
                <ul class="list list-mark-1 list-mark-1_mod-a">
                  <li><a href="category.html">Asia & europe</a></li>
                  <li><a href="category.html">festival games</a></li>
                  <li><a href="category.html">world organizations</a></li>
                  <li><a href="category.html">africa & middle east</a></li>
                  <li><a href="category.html">pakistan & india</a></li>
                  <li><a href="category.html">usa & canada</a></li>
                </ul>
              </li>
            </ul>
          </li>
          <li><a href="#" data-toggle="dropdown">lifestyle</a>
            <ul role="menu" class="dropdown-menu">
              <li>
                <ul class="list list-mark-1 list-mark-1_mod-a">
                  <li><a href="category.html">Asia & europe</a></li>
                  <li><a href="category.html">festival games</a></li>
                  <li><a href="category.html">world organizations</a></li>
                  <li><a href="category.html">africa & middle east</a></li>
                  <li><a href="category.html">pakistan & india</a></li>
                  <li><a href="category.html">usa & canada</a></li>
                </ul>
              </li>
            </ul>
          </li>
          <li><a href="#" data-toggle="dropdown">Sports</a>
            <ul role="menu" class="dropdown-menu">
              <li>
                <ul class="list list-mark-1 list-mark-1_mod-a">
                  <li><a href="category.html">Asia & europe</a></li>
                  <li><a href="category.html">festival games</a></li>
                  <li><a href="category.html">world organizations</a></li>
                  <li><a href="category.html">africa & middle east</a></li>
                  <li><a href="category.html">pakistan & india</a></li>
                  <li><a href="category.html">usa & canada</a></li>
                </ul>
              </li>
            </ul>
          </li>
          <li><a href="#" data-toggle="dropdown">travel</a>
            <ul role="menu" class="dropdown-menu">
              <li>
                <ul class="list list-mark-1 list-mark-1_mod-a">
                  <li><a href="category.html">Asia & europe</a></li>
                  <li><a href="category.html">festival games</a></li>
                  <li><a href="category.html">world organizations</a></li>
                  <li><a href="category.html">africa & middle east</a></li>
                  <li><a href="category.html">pakistan & india</a></li>
                  <li><a href="category.html">usa & canada</a></li>
                </ul>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- end layout-theme-->



    </nav>


<div class="modal fade" id="modalSuscribir" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">MANTENGASE ACTUALIZADO</h4>
      </div>
      <div class="modal-body">
        <p>Suscríbase y reciba mensualmente las notificaciones de las nuevas ediciones.</p>
          @include('partials.suscribirse_modal')
      </div>
      <div class="modal-footer">
        
      </div>
    </div>
  </div>
</div>


<style>
    #at-share-dock{
        display:none;
    }
</style>


    <script src="{{ asset('/templates/contenido/js/main.js') }}"></script>
    <script src="{{ asset('/templates/contenido/js/separate-js/custom.js') }}"></script>
    <script src="{{ asset('/templates/contenido/plugins/3d-bold-navigation/main.js') }}"></script>
    <script src="{{ asset('/templates/contenido/plugins/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/templates/contenido/plugins/slider-pro/jquery.sliderPro.js') }}"></script>
    <script src="{{ asset('/templates/contenido/plugins/owl-carousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('/templates/contenido/plugins/isotope/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('/templates/contenido/plugins/prettyphoto/jquery.prettyPhoto.js') }}"></script>
    <script src="{{ asset('/templates/contenido/plugins/bootstrap-select/bootstrap-select.js') }}"></script>
    <script src="{{ asset('/templates/contenido/plugins/rendro-easy-pie-chart/jquery.easypiechart.min.js') }}"></script>
    <script src="{{ asset('/templates/contenido/plugins/doubletaptogo.js') }}"></script>
    <script src="{{ asset('/templates/contenido/plugins/waypoints.min.js') }}"></script>
    <script src="{{ asset('/templates/contenido/plugins/news-ticker/js/endlessRiver.js') }}"></script>
    <script src="{{ asset('/templates/contenido/plugins/datetimepicker/jquery.datetimepicker.js') }}"></script>
    <script src="{{ asset('/templates/contenido/plugins/flexslider/jquery.flexslider.js') }}"></script>
    <script src="{{ asset('/templates/contenido/plugins/jarallax/jarallax.js') }}"></script>
    <script src="{{ asset('/templates/contenido/plugins/scrollreveal/scrollreveal.js') }}"></script>
    <script src="{{ asset('/templates/contenido/plugins/classie.js') }}"></script>
    <script src="{{ asset('/templates/contenido/plugins/switcher/js/dmss.js') }}"></script>
    <script src="{{ asset('/media/com_acymailing/js/acymailing_module.js') }}" type="text/javascript"></script>  
    <!-- Go to www.addthis.com/dashboard to customize your tools --> <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=intrasrd"></script> 


    
  </body>
</html>
