@extends('layouts.login')
@section('content')

<div class="col-md-12">
    <div class="panel panel-danger">
        <form class="form-horizontal" role="form" method="POST" action="{{ url('password/reset') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="panel-body">
                <h4 class="text-center" style="margin-bottom: 25px;">Définir un nouveau mot de passe</h4>
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
                <div class="form-group">
                    <div class="col-sm-12">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="confirmer le mot de passe">
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <div class="pull-right">
                    <button type="submit" class="btn btn-danger">Envoyer</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
