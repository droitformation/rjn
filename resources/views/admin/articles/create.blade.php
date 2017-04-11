@extends('layouts.admin')
@section('content')

<div class="row"><!-- row -->
    <div class="col-md-12"><!-- col -->
        <p><a class="btn btn-default" href="{{ url('admin/article') }}"><i class="fa fa-reply"></i> &nbsp;Retour à la liste</a></p>
    </div>
</div>

<!-- start row -->
<div class="row">
    <div class="col-md-12">

        <div class="panel panel-midnightblue">

            <form action="{{ url('admin/article') }}" method="post" class="form-validation form-horizontal">
                {!! csrf_field() !!}

            <div class="panel-heading">
                <h4>Créer article</h4>
            </div>
            <div class="panel-body event-info">

                <div class="form-group">
                    <label for="message" class="col-sm-3 control-label">Titre</label>
                    <div class="col-sm-7">
                        {!! Form::text('titre', '' , array('class' => 'form-control') ) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label">Domaine</label>
                    <div class="col-lg-4 col-sm-6 col-xs-12">
                        @if(!empty($dropdown))
                            <select class="form-control" name="domain_id">
                                @foreach($dropdown as $domaine_id => $domaine)
                                    <optgroup label="{{ $droit[$domaine_id] }}">
                                        @if(!empty($domaine))
                                            @foreach($domaine as $dom_id => $doma)
                                                <option value="{{ $dom_id }}">{{ $doma }}</option>
                                            @endforeach
                                        @endif
                                    </optgroup>
                                @endforeach
                            </select>
                        @endif
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
                    <label class="col-sm-3 control-label">Auteur</label>
                    <div class="col-lg-3 col-sm-6 col-xs-8">
                        {!! Form::select('author_id', $authors , null, [ 'class' => 'form-control', 'multiple' => 'multiple']) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label for="message" class="col-sm-3 control-label">Date de publication</label>
                    <div class="col-lg-1 col-sm-2 col-xs-3">
                        {!! Form::text('pub_date', '' , array('class' => 'form-control datePicker') ) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label for="message" class="col-sm-3 control-label">Article</label>
                    <div class="col-sm-7">
                        {!! Form::textarea('article', '' , array('class' => 'form-control redactor', 'cols' => '50' , 'rows' => '4' )) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label for="message" class="col-sm-3 control-label">Bibliographie</label>
                    <div class="col-sm-7">
                        {!! Form::textarea('bibliographie', '' , array('class' => 'form-control  redactor', 'cols' => '50' , 'rows' => '4' )) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label for="message" class="col-sm-3 control-label">Notes</label>
                    <div class="col-sm-7">
                        {!! Form::textarea('notes', '' , array('class' => 'form-control', 'cols' => '10' , 'rows' => '4' )) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label for="message" class="col-sm-3 control-label">Citations</label>
                    <div class="col-sm-7">
                        {!! Form::textarea('citations', '' , array('class' => 'form-control redactor', 'cols' => '10' , 'rows' => '4' )) !!}
                    </div>
                </div>

            </div>
            <div class="panel-footer mini-footer ">
                <div class="col-sm-6">
                    {!! Form::hidden('pid', 1 )!!}
                    <button class="btn btn-primary" type="submit">Envoyer </button>
                </div>
            </div>
            </form>

        </div>
    </div>

</div>
<!-- end row -->

@stop