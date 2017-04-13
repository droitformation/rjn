@extends('layouts.admin')
@section('content')

<div class="row"><!-- row -->
    <div class="col-md-12"><!-- col -->
         <p><a class="btn btn-default" href="{{ url('admin/article') }}"><i class="fa fa-reply"></i> &nbsp;Retour à la liste</a></p>
    </div>
</div>
<!-- start row -->
<div class="row">

@if ( !empty($article) )

    <?php
        $helper  = new \App\Droit\Helper\Helper;
        $authors = $helper->withEmpty($authors);

        $authors_article = ( ! $article->doctrine_author->isEmpty() ? $article->doctrine_author->pluck('id')->all() : [] );
    ?>

    <div class="col-md-12">
        <div class="panel panel-midnightblue">

            <form action="{{ url('admin/article/'.$article->id) }}" method="post" class="form-validation form-horizontal">
                <input type="hidden" name="_method" value="PUT">{!! csrf_field() !!}

                <div class="panel-heading"><h4>&Eacute;diter article</h4></div>
                <div class="panel-body event-info">

                    <div class="form-group">
                        <label for="message" class="col-sm-3 control-label">Titre</label>
                        <div class="col-sm-7">
                            {!! Form::text('titre', $article->titre , array('class' => 'form-control') ) !!}
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
                                                    <option <?php echo ($article->domain_id == $dom_id ? 'selected' : ''); ?> value="{{ $dom_id }}">{{ $doma }}</option>
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
                            {!! Form::text('page', $article->page , array('class' => 'form-control') ) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Volume</label>
                        <div class="col-lg-1 col-sm-2 col-xs-3">
                            {!! Form::select('volume_id', $rjn , $article->volume_id , [ 'class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Auteur</label>
                        <div class="col-lg-4 col-sm-6 col-xs-8">
                            {!! Form::select('author_id[]', $authors , $authors_article , ['class' => 'form-control' , 'multiple' => 'multiple']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="message" class="col-sm-3 control-label">Date de publication</label>
                        <div class="col-lg-1 col-sm-2 col-xs-3">
                            {!! Form::text('pub_date',  $article->pub_date->format('Y-m-d') , array('class' => 'form-control datePicker') ) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="message" class="col-sm-3 control-label">Article</label>
                        <div class="col-sm-7">
                            {!! Form::textarea('article', $article->article , array('class' => 'form-control redactor', 'cols' => '50' , 'rows' => '4' )) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="message" class="col-sm-3 control-label">Bibliographie</label>
                        <div class="col-sm-7">
                            {!! Form::textarea('bibliographie', $article->bibliographie , array('class' => 'form-control  redactor', 'cols' => '50' , 'rows' => '4' )) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="message" class="col-sm-3 control-label">Notes</label>
                        <div class="col-sm-7">
                            {!! Form::textarea('notes', $article->notes , array('class' => 'form-control', 'cols' => '10' , 'rows' => '4' )) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="message" class="col-sm-3 control-label">Citations</label>
                        <div class="col-sm-7">
                            {!! Form::textarea('citations', $article->citations , array('class' => 'form-control redactor', 'cols' => '10' , 'rows' => '4' )) !!}
                        </div>
                    </div>

                </div>
                <div class="panel-footer mini-footer ">
                    {!! Form::hidden('id', $article->id )!!}
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