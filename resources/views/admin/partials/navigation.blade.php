<!-- BEGIN SIDEBAR -->
<nav id="page-leftbar" role="navigation">
    <!-- BEGIN SIDEBAR MENU -->
    <ul class="acc-menu" id="sidebar">
        <!-- Recherche globale -->
       <!-- @include('admin.partials.search')-->

        <li class="divider"></li>
        <li class="<?php echo (Request::is('admin') ? 'active' : '' ); ?>"><a href="{{ url('admin') }}">
             <i class="fa fa-home"></i> <span>Accueil</span></a>
        </li>
        <li class="<?php echo (Request::is('admin/user/*') || Request::is('admin/user') ? 'active' : '' ); ?>"><a href="{{ url('admin/user')  }}">
                <i class="fa fa-user"></i> <span>Utilisateurs</span></a>
        </li>
        <li class="<?php echo (Request::is('admin/code/*') || Request::is('admin/code') ? 'active' : '' ); ?>"><a href="{{ url('admin/code')  }}">
                <i class="fa fa-check-circle"></i> <span>Codes d'accès</span></a>
        </li>
        <li class="divider"></li>
        <li class="<?php echo (Request::is('admin/author/*') ? 'active' : '' ); ?>"><a href="{{ url('admin/author') }}">
            <i class="fa fa-users"></i> <span>Auteurs</span></a>
        </li>
        <li class="<?php echo (Request::is('admin/domain') ? 'active' : '' ); ?>"><a href="{{ url('admin/domain') }}">
            <i class="fa fa-asterisk"></i> <span>Domaines</span></a>
        </li>
        <li class="<?php echo (Request::is('admin/categorie') ? 'active' : '' ); ?>"><a href="{{ url('admin/categorie') }}">
            <i class="fa fa-star"></i> <span>Catégories</span></a>
        </li>

        <li class="divider"></li>
        <li class="<?php echo (Request::is('admin/arret/*') ? 'active' : '' ); ?>"><a href="{{ url('admin/arret')  }}">
            <i class="fa fa-edit"></i> <span>Arrêts</span></a>
        </li>
        <li class="<?php echo (Request::is('admin/critique/*') ? 'active' : '' ); ?>"><a href="{{ url('admin/critique')  }}">
                <i class="fa fa-flag"></i> <span>Critique</span></a>
        </li>
        <li class="<?php echo (Request::is('admin/article/*') ? 'active' : '' ); ?>"><a href="{{ url('admin/article')  }}">
            <i class="fa fa-book"></i> <span>Articles de doctrine</span></a>
        </li>
        <li class="<?php echo (Request::is('admin/chronique/*') ? 'active' : '' ); ?>"><a href="{{ url('admin/chronique')  }}">
            <i class="fa fa-inbox"></i> <span>Chroniques</span></a>
        </li>
        <li class="divider"></li>
        <li class="<?php echo (Request::is('admin/matiere/*') || Request::is('admin/note/*') ? 'active' : '' ); ?>"><a href="{{ url('admin/matiere')  }}">
            <i class="fa fa-tag"></i> <span>Matières</span></a>
        </li>
        <li class="<?php echo (Request::is('admin/loi/*') || Request::is('admin/disposition/*') ? 'active' : '' ); ?>"><a href="{{ url('admin/loi')  }}">
            <i class="fa fa-th-list"></i> <span>Lois</span></a>
        </li>
    </ul>
    <!-- END SIDEBAR MENU -->
</nav>