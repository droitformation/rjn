<form class="form-horizontal form-validation" role="form" method="POST" action="login">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">

    <div class="panel-body">
        <h4 class="text-center" style="font-size:14px;margin-bottom: 15px;margin-top:0;">Vous avez déjà un compte? S'identifier</h4>
        <div class="form-group">
            <div class="col-sm-12">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-12">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                    <input type="password" class="form-control" id="password" name="password" placeholder="mot de passe">
                </div>
            </div>
        </div>
        <div class="clearfix">
            <div class="pull-right"><label><input type="checkbox" style="margin-bottom: 0px" checked=""> Se souvenir de moi</label></div>
        </div>
    </div>
    <div class="panel-footer">
        <a href="{{ url('password/reset') }}" class="pull-left btn btn-link" style="padding-left:0">Mot de passe perdu?</a>
        <div class="pull-right">
            @if($page == 'login')
                <a href="{{ url('/') }}" class="btn btn-default">Retour au site</a>
            @endif
            <button type="submit" class="btn btn-danger">Log In</button>
        </div>
        <div class="clearfix"></div>
    </div>
</form>