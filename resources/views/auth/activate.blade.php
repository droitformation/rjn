@extends('layouts.login')
@section('content')

<div class="col-md-12">
    <div class="panel panel-inverse">
        <form class="form-horizontal" role="form" method="POST" action="{{ url('postActivate') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="panel-body">
                <h4 class="text-center" style="margin-bottom: 15px;">Re-activer votre accès</h4>
                <p>Veuillez saisir le <strong>code d'accès</strong> indiqué sur le votre exemplaire du RJN, votre adresse <strong>email</strong> ainsi que votre mot de passe</p>
                <div class="form-group">
                    <div class="col-sm-12">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-check-circle text-info"></i></span>
                            <input type="text" class="form-control" id="code" value="{{ old('code') }}" name="code" placeholder="Code d'accès">
                        </div>
                    </div>
                </div>
                <hr/>
                <div class="form-group">
                    <div class="col-sm-12">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                            <input type="text" class="form-control" id="email" value="{{ old('email') }}" name="email" placeholder="Email">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe">
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <div class="pull-right">
                    <a href="{{ url('/') }}" class="btn btn-default">Retour au site</a>
                    <button type="submit" class="btn btn-inverse">Envoyer</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection