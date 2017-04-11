@extends('layouts.admin')
@section('content')


<div class="row"><!-- row -->
    <div class="col-md-12"><!-- col -->
        <p><a class="btn btn-default" href="{{ url('admin/contenu') }}"><i class="fa fa-reply"></i> &nbsp;Retour à la liste</a></p>
    </div>
</div>
<!-- start row -->
<div class="row">

    @if (!empty($contenu) )

    <div class="col-md-12">
        <div class="panel panel-midnightblue">

            <form id="contenu" data-validate="parsley" action="{{ url('admin/contenu/'.$contenu->id) }}" method="post" class="validate-form form-horizontal" enctype="multipart/form-data">
                <input type="hidden" name="_method" value="PUT">{!! csrf_field() !!}

                <div class="panel-heading">
                    <h4>&Eacute;diter {{ $contenu->titre }}</h4>
                </div>
                <div class="panel-body event-info">

                    <div class="form-group">
                        <label for="message" class="col-sm-3 control-label">Titre</label>
                        <div class="col-sm-4">
                            {{ Form::text('titre', $contenu->titre , array('class' => 'form-control') ) }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="contenu" class="col-sm-3 control-label">Contenu</label>
                        <div class="col-sm-7">
                            {{ Form::textarea('contenu', $contenu->contenu , array('class' => 'form-control  redactor', 'cols' => '50' , 'rows' => '4' )) }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="url" class="col-sm-3 control-label">Lien<br/>
                            <small class="text-muted">Sur l'image</small>
                        </label>
                        <div class="col-sm-7">
                            {{ Form::text('url', $contenu->url  , array('class' => 'form-control') ) }}
                        </div>
                    </div>

                    @if(!empty($contenu->image ))
                    <div class="form-group">
                        <label for="image" class="col-sm-3 control-label">Image</label>
                        <div class="col-sm-4">
                            <div class="list-group">
                                <div class="list-group-item text-center">
                                    <a href="#"><img height="120" src="{{ asset('files/'.$contenu->image) }}" alt="{{ $contenu->titre }}" /></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="form-group">
                        <label for="file" class="col-sm-3 control-label">Changer l'image</label>
                        <div class="col-sm-4">
                            <div class="list-group">
                                <div class="list-group-item">
                                    {{ Form::file('file') }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="type" class="col-sm-3 control-label">Type de contenu</label>
                        <div class="col-sm-4">
                           {{ Form::select('type', array('pub' => 'Publicité','texte' => 'Texte','soutien' => 'Soutien'),null, array('class' => 'form-control')) }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="position" class="col-sm-3 control-label">Position</label>
                        <div class="col-sm-4">
                            {{ Form::select('position', $positions,null, array('class' => 'form-control')) }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="message" class="col-sm-3 control-label">Rang</label>
                        <div class="col-sm-2">
                            {{ Form::text('rang', $contenu->rang , array('class' => 'form-control') ) }}
                        </div>
                    </div>

                </div>
                <div class="panel-footer mini-footer ">
                    <div class="col-sm-3"><input type="hidden" name="id" value="{{  $contenu->id }}"></div>
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