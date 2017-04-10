@extends('layouts.admin')
@section('content')

<div class="row"><!-- row -->
    <div class="col-md-12"><!-- col -->
        <p><a class="btn btn-default" href="{{ url('admin/arret') }}"><i class="fa fa-reply"></i> &nbsp;Retour à la liste</a></p>
    </div>
</div>

<!-- start row -->
<div class="row">
    <div class="col-md-12">

        <div class="panel panel-midnightblue">

            <!-- form start -->
            {!! Form::open(array('method' => 'POST', 'class' => 'form-validation form-horizontal','url' => array('admin/arret') )) !!}

            <div class="panel-heading">
                <h4>Créer arrêt</h4>
            </div>
            <div class="panel-body event-info">

                <div class="form-group">
                    <label for="message" class="col-sm-3 control-label">Titre/Designation</label>
                    <div class="col-sm-7">
                        {!! Form::text('designation', '' , array('class' => 'form-control') ) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label for="message" class="col-sm-3 control-label">Domaine</label>
                    <div class="col-lg-4 col-sm-7 col-xs-9">
                        <select class="form-control" id="domain" name="domain_id">
                            @if(!empty($domains))
                                @foreach($domains as $domain_id => $domain)
                                    <option value="{{ $domain_id }}">{{ $domain }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="message" class="col-sm-3 control-label">Categorie</label>
                    <div class="col-lg-4 col-sm-7 col-xs-9">
                        <select class="form-control" data-domain="{{ current(array_keys($domains)) }}" id="categorie" name="categorie_id"></select>
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
                    <label for="message" class="col-sm-3 control-label">Date de publication</label>
                    <div class="col-lg-1 col-sm-2 col-xs-3">
                        {!! Form::text('pub_date', '' , array('class' => 'form-control datePicker') ) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label for="message" class="col-sm-3 control-label">Références</label>
                    <div class="col-sm-7">
                        {!! Form::text('cotes', '' , array('class' => 'form-control') ) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label for="message" class="col-sm-3 control-label">Somaire</label>
                    <div class="col-sm-7">
                        {!! Form::textarea('sommaire', '' , array('class' => 'form-control', 'cols' => '50' , 'rows' => '4' )) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label for="message" class="col-sm-3 control-label">Portée</label>
                    <div class="col-sm-7">
                        {!! Form::textarea('portee', '' , array('class' => 'form-control  redactor', 'cols' => '50' , 'rows' => '4' )) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label for="message" class="col-sm-3 control-label">Faits</label>
                    <div class="col-sm-7">
                        {!! Form::textarea('faits', '' , array('class' => 'form-control  redactor', 'cols' => '50' , 'rows' => '4' )) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label for="message" class="col-sm-3 control-label">Considérant</label>
                    <div class="col-sm-7">
                        {!! Form::textarea('considerant', '' , array('class' => 'form-control redactor', 'cols' => '50' , 'rows' => '4' )) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label for="message" class="col-sm-3 control-label">Notes</label>
                    <div class="col-sm-7">
                        {!! Form::textarea('note', '' , array('class' => 'form-control', 'cols' => '10' , 'rows' => '4' )) !!}
                    </div>
                </div>

            </div>
            <div class="panel-footer mini-footer ">
                <div class="col-sm-6">
                    {!! Form::hidden('pid', 1 )!!}
                    <button class="btn btn-primary" type="submit">Envoyer </button>
                </div>
            </div>
            {!! Form::close() !!}

        </div>
    </div>

</div>
<!-- end row -->

@stop