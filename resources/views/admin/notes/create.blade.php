@extends('layouts.admin')
@section('content')


<div class="row"><!-- row -->
    <div class="col-md-12"><!-- col -->
        <p><a class="btn btn-default" href="{{ url('admin/note/matiere/'.$matiere_id) }}"><i class="fa fa-reply"></i> &nbsp;Retour à la liste</a></p>
    </div>
</div>
<!-- start row -->
<div class="row">

    <div class="col-md-12">
        <div class="panel panel-midnightblue">

            <form action="{{ url('admin/note') }}" method="post" class="form-validation form-horizontal">
                {!! csrf_field() !!}

            <div class="panel-heading">
                <h4>Ajouter un contenu</h4>
            </div>
            <div class="panel-body event-info">

                <div class="form-group">
                    <label for="message" class="col-sm-3 control-label">Contenu</label>
                    <div class="col-sm-7">
                        {!! Form::text('content', '' , array('class' => 'form-control') ) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label for="message" class="col-sm-3 control-label">En matière (domaine)</label>
                    <div class="col-sm-7">
                        {!! Form::text('domaine', '' , array('class' => 'form-control') ) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label for="message" class="col-sm-3 control-label">Page</label>
                    <div class="col-lg-1 col-sm-2 col-xs-3">
                        {!! Form::text('page', '' , array('class' => 'form-control') ) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label">Volume</label>
                    <div class="col-lg-1 col-sm-2 col-xs-3">
                        {!! Form::select('volume_id', $rjn , null, [ 'class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label for="message" class="col-sm-3 control-label">cf. externe</label>
                    <div class="col-sm-7">
                        {!! Form::text('confer_externe', '' , array('class' => 'form-control') ) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label for="message" class="col-sm-3 control-label">cf. interne (ancre)</label>
                    <div class="col-sm-7">
                        {!! Form::text('confer_interne', '' , array('class' => 'form-control') ) !!}
                    </div>
                </div>

            </div>
            <div class="panel-footer mini-footer ">
                {!! Form::hidden('matiere_id', $matiere_id ) !!}
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