@extends('layouts.admin')
@section('content')


<div class="row"><!-- row -->
    <div class="col-md-12"><!-- col -->
        <p><a class="btn btn-default" href="{{ url('admin/domain') }}"><i class="fa fa-reply"></i> &nbsp;Retour à la liste</a></p>
    </div>
</div>
<!-- start row -->
<div class="row">

    <div class="col-md-12">
        <div class="panel panel-midnightblue">

            <form action="{{ url('admin/domain') }}" method="post" class="form-validation form-horizontal">
                {!! csrf_field() !!}

            <div class="panel-heading">
                <h4>Ajouter un domaine</h4>
            </div>
            <div class="panel-body event-info">

                <div class="form-group">
                    <label for="message" class="col-sm-3 control-label">Titre</label>
                    <div class="col-lg-7 col-sm-7 col-xs-12">
                        {!! Form::text('title', null , array('class' => 'form-control') ) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label for="message" class="col-sm-3 control-label">Domaine</label>
                    <div class="col-lg-2 col-sm-3 col-xs-7">
                        <select class="form-control" name="droit">
                            @if(!empty($droit))
                                @foreach($droit as $droit_id => $droit_nom)
                                    <option value="{{ $droit_id }}">{{ $droit_nom }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="message" class="col-sm-3 control-label">Rang</label>
                    <div class="col-lg-2 col-sm-2 col-xs-8">
                        {!! Form::text('sorting', null , array('class' => 'form-control') ) !!}
                    </div>
                </div>

            </div>
            <div class="panel-footer mini-footer ">
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                    <button class="btn btn-primary" type="submit">Envoyer</button>
                </div>
            </div>

            </form>
        </div>
    </div>

</div>
<!-- end row -->

@stop