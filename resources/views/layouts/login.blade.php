<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>RJN</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="RJN | login">
    <meta name="author" content="Cindy Leschaud | @DesignPond">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo asset('admin_assets/css/styles.css?=121');?>">
    <link rel="stylesheet" href="<?php echo asset('admin_assets/css/login.css?=121');?>">
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600' rel='stylesheet' type='text/css'>

</head>
<body>

    <?php $center = (Request::is('auth/login') ? 'container' : 'container verticalcenter'); ?>

    <div class="container verticalcenter">

        @if( (isset($errors) && count($errors) > 0) )
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-dismissable alert-warning">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                        @foreach($errors->all() as $message)
                            <p>{!! $message !!}</p>
                        @endforeach

                    </div>
                </div>
            </div>
        @endif

        @if(Session::has('status'))
            <?php
                $status = Session::get('status');
                $color   = $status == 'warning' || $status == 'danger' ? $status : 'success';
                $message = (Session::get('status') == 'warning' || Session::get('status') == 'danger' || Session::get('status') == 'success') ? Session::get('message') : Session::get('status');
            ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-dismissable alert-{{ $color }}">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <p>{!! $message !!}</p>
                    </div>
                </div>
            </div>

        @endif


        <div class="row">
            <div class="col-md-12">
                <div id="logo"><a href="{{ url('/') }}"><img src="{{ asset('admin_assets/img/logo.svg') }}" alt="logo RJN" /></a></div>
            </div>
            <!-- Contenu -->
            @yield('content')
            <!-- Fin contenu -->

        </div>
</div>

</body>
</html>