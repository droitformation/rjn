@extends('layouts.admin')
@section('content')


<div class="row"><!-- row -->
    <div class="col-md-12"><!-- col -->
        <p><a class="btn btn-default" href="{{ url('admin/critique') }}"><i class="fa fa-reply"></i> &nbsp;Retour à la liste</a></p>
    </div>
</div>
<!-- start row -->
<div class="row">

    <div class="col-md-12">
        <div class="panel panel-midnightblue">

            <form action="{{ url('admin/critique') }}" method="post" class="form-validation form-horizontal">
                {!! csrf_field() !!}

            <div class="panel-heading">
                <h4>Ajouter une critique</h4>
            </div>
            <div class="panel-body event-info">

                <div class="form-group">
                    <label class="col-sm-3 control-label">Auteur</label>
                    <div class="col-lg-3 col-sm-6 col-xs-8">
                        {!! Form::select('author_id', $authors , null, [ 'class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label for="message" class="col-sm-3 control-label">Titre</label>
                    <div class="col-sm-7">
                        {!! Form::text('titre', null , array('class' => 'form-control') ) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label"></label>
                    <div class="col-lg-3 col-sm-6 col-xs-8"><strong>Attacher à</strong></div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label">Type de contenu</label>
                    <div class="col-lg-8 col-sm-8 col-xs-8">
                        <div id="listitems"></div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="message" class="col-sm-3 control-label">Contenu</label>
                    <div class="col-sm-7">
                        {!! Form::textarea('contenu', '' , array('class' => 'form-control redactor', 'cols' => '50' , 'rows' => '4' )) !!}
                    </div>
                </div>

            </div>
            <div class="panel-footer mini-footer">
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