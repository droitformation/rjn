<!-- header -->
<header id="header" class="navbar navbar-fixed-top bg-white box-shadow"  data-spy="affix" data-offset-top="1">
    <div class="container">
        <div class="navbar-header">
            <a href="/" class="navbar-brand">
                <img src="<?php echo asset('site_assets/images/logo.png');?>" alt="" />
            </a>
            <button class="btn btn-link visible-xs" type="button" data-toggle="collapse" data-target=".navbar-collapse">
                <i class="fa fa-bars"></i>
            </button>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li>{!! link_to('/', 'Accueil' , array('class' => Request::is( '/') ? 'active' : '') ) !!}</li>
                <li>{!! link_to('jurisprudence', 'Jurisprudence' , array('class' => Request::is( 'jurisprudence') ? 'active' : '') ) !!}</li>
                <li>{!! link_to('doctrine', 'Doctrine' , array('class' => Request::is( 'doctrine') ? 'active' : '') ) !!}</li>
                <li>{!! link_to('matiere', 'Matières' , array('class' => Request::is( 'matiere') ? 'active' : '') ) !!}</li>
                <li>{!! link_to('lois', 'Lois' , array('class' => Request::is( 'lois') ? 'active' : '') ) !!}</li>
                <li>{!! link_to('colloque', 'Colloques' , array('class' => Request::is( 'colloque') ? 'active' : '') ) !!}</li>
                <li>{!! link_to('historique', 'Historique' , array('class' => Request::is('historique') ? 'active' : '') ) !!}</li>
                <li>{!! link_to('contact', 'Contact' , array('class' => Request::is( 'contact') ? 'active' : '') ) !!}</li>
                <li class="logos"><a href="http://www2.unine.ch/droit"><img src="<?php echo asset('site_assets/images/logos/logo.png');?>" alt="unine" /></a></li>
            </ul>
        </div>
    </div>
</header>