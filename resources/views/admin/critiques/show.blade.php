@extends('layouts.admin')
@section('content')

<div class="row"><!-- row -->
    <div class="col-md-12"><!-- col -->
        <p><a class="btn btn-default" href="{{ url('admin/critique') }}"><i class="fa fa-reply"></i> &nbsp;Retour à la liste</a></p>
    </div>
</div>
<!-- start row -->
<div class="row">

    @if ( !empty($critique) )

    <div class="col-md-12">
        <div class="panel panel-midnightblue">

            <form action="{{ url('admin/critique/'.$critique->id) }}" method="post" class="form-validation form-horizontal">
                <input type="hidden" name="_method" value="PUT">{!! csrf_field() !!}

            <div class="panel-heading">
                <h4>&Eacute;diter {{ $critique->titre }}</h4>
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
                    <div class="col-sm-3">
                        {!! Form::text('titre', $critique->titre , array('class' => 'form-control') ) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label">Attaché à</label>
                    <div class="col-lg-7 col-sm-7 col-xs-7">
                        <?php $type = $critique->type; ?>
                        <h4>Type: {!! $type !!}</h4>
                        <p>{!! $critique->$type->designation or $critique->$type->titre !!}</p>
                        <a class="btn btn-primary pull-right" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Changer</a>
                        <div class="collapse" id="collapseExample">
                            <div class="well">
                                <label class="control-label">Type de contenu</label>
                                <div id="listitems"></div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <label for="message" class="col-sm-3 control-label">Contenu</label>
                    <div class="col-sm-7">
                        {!! Form::textarea('contenu', $critique->contenu  , array('class' => 'form-control redactor', 'cols' => '50' , 'rows' => '4' )) !!}
                    </div>
                </div>

            </div>
            <div class="panel-footer mini-footer ">
                {!! Form::hidden('id', $critique->id ) !!}
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                    <button class="btn btn-primary" type="submit">Envoyer </button>
                </div>
            </div>
            </form>
        </div>
    </div>

    @endif

</div>
<!-- end row -->

@stop