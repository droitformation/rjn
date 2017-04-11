<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Administration | RJN</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="RJN | administration">
    <meta name="author" content="Cindy Leschaud | @DesignPond">
    <meta name="token" content="<?php echo csrf_token(); ?>">
    <link rel="stylesheet" href="<?php echo asset('admin_assets/css/styles.css?=121');?>">
    <link rel="stylesheet" href="<?php echo asset('admin_assets/js/vendor/redactor/redactor.css'); ?>">
    <link rel="stylesheet" href="<?php echo asset('admin_assets/js/vendor/jqueryui/jqueryui.css'); ?>">
    <link rel='stylesheet' type='text/css' href="//cdn.datatables.net/plug-ins/f2c75b7247b/integration/bootstrap/3/dataTables.bootstrap.css" />
    <link rel="stylesheet" href="<?php echo asset('admin_assets/css/chosen.css');?>">
    <link rel="stylesheet" href="<?php echo asset('admin_assets/css/chosen-bootstrap.css');?>">
    <link rel="stylesheet" href="<?php echo asset('admin_assets/css/admin.css');?>">
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries. Placeholdr.js enables the placeholder attribute -->
	<!--[if lt IE 9]>
    <link rel="stylesheet" href="<?php echo asset('admin_assets/css/styles.ie8.css');?>">
    <script type="text/javascript" src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/respond.js/1.1.0/respond.min.js"></script>
	<![endif]-->

    <script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
                'url'   => url('/'),
        ]); ?>
    </script>

    <base href="/">

</head>

<body>

<?php $current_user = (isset(Auth::user()->name) ? Auth::user()->name : ''); ?>

    <header class="navbar navbar-inverse navbar-fixed-top" role="banner">

        <a id="leftmenu-trigger" class="tooltips" data-toggle="tooltip" data-placement="right" title="Toggle Sidebar"></a>

        <div class="navbar-header pull-left"><a class="navbar-brand" href="{{ url('/')  }}">RJN</a></div>

        <ul class="nav navbar-nav pull-right toolbar">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle username" data-toggle="dropdown">
                    <span class="hidden-xs">
                        &nbsp;{{ $current_user }}
                        <i class="fa fa-caret-down"></i></span>
                </a>
                <ul class="dropdown-menu userinfo arrow">
                    <li class="username">
                        <a href="#"><div class="pull-right"><h5>Bonjour, {{ $current_user }}!</h5></div></a>
                    </li>
                    <li class="userlinks">
                        <ul class="dropdown-menu">
                            <li><a href="{{ url('logout') }}"><i class="pull-right fa  fa-power-off"></i> Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
        </ul>
    </header>

    <div id="page-container">

        <!-- Navigation  -->
        @include('admin.partials.navigation')

        <div id="page-content">
            <div id='wrap'>

                <div id="page-heading">
                    <h2>{{ $pageTitle or 'Administration' }}</h2>
                </div>

                <div class="container">

                    <!-- messages and errors -->
                    @include('admin.partials.message')

                    <!-- Contenu -->
                    @yield('content')
                    <!-- Fin contenu -->

                </div> <!-- container -->
            </div> <!--wrap -->
        </div> <!-- page-content -->

        <footer role="contentinfo">
            <div class="clearfix">
                <ul class="list-unstyled list-inline pull-left">
                    <li>RJN &copy; <?php echo date('Y'); ?></li>
                </ul>
                <button class="pull-right btn btn-inverse-alt btn-xs hidden-print" id="back-to-top"><i class="fa fa-arrow-up"></i></button>
            </div>
        </footer>

    </div> <!-- page-container -->

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="http://code.jquery.com/jquery-migrate-1.0.0.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>
    <script src="<?php echo asset('js/validation/messages_fr.js');?>"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>

    <script src="http://fb.me/react-0.13.1.js"></script>
    <script type="text/javascript" src="<?php echo asset('admin_assets/js/vendor/react/JSXTransformer.js');?>"></script>
    <script type="text/javascript" src="<?php echo asset('admin_assets/js/vendor/chosen/chosen.jquery.js');?>"></script>
    <script type="text/javascript" src="<?php echo asset('admin_assets/js/enquire.js');?>"></script>
    <script type="text/javascript" src="<?php echo asset('admin_assets/js/jquery.cookie.js');?>"></script>
    <script type="text/javascript" src="<?php echo asset('admin_assets/js/jquery.nicescroll.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo asset('admin_assets/plugins/form-toggle/toggle.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo asset('admin_assets/js/placeholdr.js');?>"></script>
    <script type="text/javascript" src="<?php echo asset('admin_assets/js/vendor/redactor/redactor.js');?>"></script>
    <script type="text/javascript" src="<?php echo asset('admin_assets/js/vendor/redactor/fr.js');?>"></script>
    <script type='text/javascript' src="<?php echo asset('admin_assets/plugins/form-multiselect/js/jquery.multi-select.js');?>"></script>
    <script type='text/javascript' src="<?php echo asset('admin_assets/plugins/datatables/jquery.dataTables.min.js');?>"></script>
    <script type='text/javascript' src="<?php echo asset('admin_assets/plugins/datatables/dataTables.bootstrap.js');?>"></script>
    <script type='text/javascript' src="<?php echo asset('admin_assets/plugins/form-datepicker/js/bootstrap-datepicker.js');?>"></script>
    <script type="text/javascript" src="<?php echo asset('admin_assets/js/datatables.js');?>"></script>
    <script type="text/javascript" src="<?php echo asset('admin_assets/js/application.js');?>"></script>
    <script type='text/javascript' src="<?php echo asset('admin_assets/plugins/bootbox/bootbox.min.js');?>"></script>
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript" src="<?php echo asset('admin_assets/js/admin.js');?>"></script>
<!--
    <script type="text/jsx" src="<?php /*echo asset('admin_assets/js/select.js');*/?>"></script>-->

</body>
</html>