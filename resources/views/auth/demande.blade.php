@extends('layouts.login')
@section('content')

<div class="col-md-12">
    <div class="panel panel-inverse">
        <form class="form-horizontal" role="form" method="POST" action="{{ url('demande') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="panel-body">
                <h4 class="text-center" style="margin-bottom: 15px;">Obtenir un accès</h4>
                <p>Veuillez saisir le <strong>numéro d'abonné</strong> indiqué sur le courrier reçu, une adresse <strong>email</strong> ainsi qu'un mot de passe</p>
                <div class="form-group">
                    <div class="col-sm-12">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-file"></i></span>
                            <?php $annee = date('Y'); ?>
                            <input type="text" class="form-control" id="book" value="{{ old('facture') }}" name="facture" placeholder="Numéro d'abonné">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
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
                <div class="form-group">
                    <div class="col-sm-12">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                            <input type="password" class="form-control" id="password" name="password_confirmation" placeholder="Confirmation du mot de passe">
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