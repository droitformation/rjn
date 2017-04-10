<!DOCTYPE html>
    <!--[if IE 8]><html class="no-js lt-ie9" lang="en" > <![endif]-->
    <!--[if gt IE 8]><!--> <html class="no-js" lang="en" > <!--<![endif]-->
    <head>
        <meta charset="utf-8" />
        <title>RJN</title>

        <meta name="description" content="Le site rjne.ch, créé sous l'égide de la Faculté de droit de l'Université de Neuchâtel, Le RJN est quadriennale et porte sur la jurisprudence de l’ensemble des sections du Tribunal cantonal et des autorités administratives supérieures">
        <meta name="author" content="@DesignPond">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSS Files
        ================================================== -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,400italic,600,600italic,700italic,700,800,800italic,300italic,300' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo asset('site_assets/js/vendor/jqueryui/jquery-ui.min.css');?>" media="screen" />
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo asset('site_assets/css/animate.css');?>" media="screen" />
        <link rel="stylesheet" type="text/css" href="<?php echo asset('site_assets/css/chosen.css');?>">
        <link rel="stylesheet" type="text/css" href="<?php echo asset('site_assets/css/landing.css');?>" media="screen" />
        <link rel="stylesheet" type="text/css" href="<?php echo asset('site_assets/css/loginbox.css');?>" media="screen" />
        <link rel="stylesheet" type="text/css" href="<?php echo asset('site_assets/css/app.css');?>" media="screen" />
        <link rel="stylesheet" type="text/css" href="<?php echo asset('site_assets/css/filters.css');?>" media="screen" />

        <!-- Javascript Files
        ================================================== -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="http://code.jquery.com/jquery-migrate-1.0.0.js"></script>
        <script src="<?php echo asset('site_assets/js/vendor/jqueryui/jquery-ui.min.js');?>"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
        <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>
        <script src="<?php echo asset('js/validation/messages_fr.js');?>"></script>
        <script type="text/javascript" src="<?php echo asset('site_assets/js/vendor/chosen/chosen.jquery.js');?>"></script>
        <script src="<?php echo asset('site_assets/js/scroll/smooth-scroll.js');?>"></script>
        <script src="<?php echo asset('site_assets/js/utils/SearchHighlight.pack.js');?>"></script>
        <script src="<?php echo asset('site_assets/js/landing.js');?>"></script>
        <script src="<?php echo asset('site_assets/js/popup.js');?>"></script>
        <script src="<?php echo asset('site_assets/js/search.js');?>"></script>

        <!--[if lte IE 9]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

    </head>

<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<!-- Body - Add "contained" to below class for boxed layout -->
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<body>

    <!-- START HEADER -->
    @include('partials.header')
    <!-- END HEADER -->

    <section id="content">

        <div class="bg-white b-b b-light">
            <div class="container">
                <ul class="breadcrumb no-border bg-empty m-b-none m-l-n-sm">
                    <li><a href="/">Accueil</a></li>
                    @if(isset($section))
                        <li><a href="{{ url($section['url']) }}">{{ $section['page'] }}</a></li>
                    @endif
                    @if(Auth::check())
                        <li class="pull-right">
                            <i class="fa fa-user"></i> &nbsp;{{ Auth::user()->name }} |
                            <a href="{{ url('logout') }}"><i class="fa fa-power-off"></i> &nbsp;Se déconncter</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>

        <div class="container m-t-lg m-b-lg m-t-lg">

            @include('partials.message')
            <!-- / header -->

            <div class="row container-row">
                <!-- Contenu -->
                @yield('content')
                <!-- Fin contenu -->
            </div>
        </div>

    </section>

    <!-- START FOOTER -->
    @include('partials.footer')
    <!-- END FOOTER -->
    <script>

        $(function() {
            smoothScroll.init({
                offset: 110 // Integer. How far to offset the scrolling anchor location in pixels
            });
        });

    </script>
    </body>
</html>