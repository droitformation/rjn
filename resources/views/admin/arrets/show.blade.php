@extends('layouts.admin')
@section('content')

<div class="row"><!-- row -->
    <div class="col-md-12"><!-- col -->
         <p><a class="btn btn-default" href="{{ url('admin/arret') }}"><i class="fa fa-reply"></i> &nbsp;Retour à la liste</a></p>
    </div>
</div>
<!-- start row -->
<div class="row">

@if ( !empty($arret) )

    <div class="col-md-12">
        <div class="panel panel-midnightblue">

            <!-- form start -->
            {!! Form::model($arret,array(
                'method'        => 'PUT',
                'id'            => 'arret',
                'class'         => 'form-validation form-horizontal',
                'url'           => 'admin/arret/'.$arret->id ))
            !!}

            <div class="panel-heading">
                <h4>&Eacute;diter</h4>
            </div>
            <div class="panel-body event-info">

                <div class="form-group">
                    <label for="message" class="col-sm-3 control-label">Titre/Designation</label>
                    <div class="col-sm-7">
                        {!! Form::text('designation', $arret->designation , array('class' => 'form-control') ) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label for="message" class="col-sm-3 control-label">Domaine</label>
                    <div class="col-lg-4 col-sm-7 col-xs-9">
                        <select class="form-control" id="domain" name="domain_id">
                            @if(!empty($domains))
                                @foreach($domains as $domain_id => $domain)
                                <option <?php echo ($arret->domain_id == $domain_id ? 'selected' : ''); ?> value="{{ $domain_id }}">{{ $domain }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="message" class="col-sm-3 control-label">Categorie</label>
                    <div class="col-lg-4 col-sm-7 col-xs-9">
                        <?php $categorie_id = (isset($arret->arrets_categories[0]) ? $arret->arrets_categories[0]->id : null); ?>
                        <select class="form-control" id="categorie" data-domain="{{ $arret->domain_id }}" data-categorie="{{ $categorie_id }}" name="categorie_id">
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="message" class="col-sm-3 control-label">Page</label>
                    <div class="col-lg-1 col-sm-2 col-xs-3">
                        {!! Form::text('page', $arret->page , array('class' => 'form-control') ) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label">Volume</label>
                    <div class="col-lg-1 col-sm-2 col-xs-3">
                        {!! Form::select('volume_id', $rjn , $arret->volume_id , ['class' => 'form-control'] ) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label for="message" class="col-sm-3 control-label">Date de publication</label>
                    <div class="col-lg-1 col-sm-2 col-xs-3">
                        {!! Form::text('pub_date', $arret->pub_date->format('Y-m-d') , array('class' => 'form-control datePicker') ) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label for="message" class="col-sm-3 control-label">Références</label>
                    <div class="col-sm-7">
                        {!! Form::text('cotes', $arret->cotes , array('class' => 'form-control') ) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label for="message" class="col-sm-3 control-label">Somaire</label>
                    <div class="col-sm-7">
                        {!! Form::textarea('sommaire', $arret->sommaire , array('class' => 'form-control', 'cols' => '50' , 'rows' => '4' )) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label for="message" class="col-sm-3 control-label">Portée</label>
                    <div class="col-sm-7">
                        {!! Form::textarea('portee', $arret->portee , array('class' => 'form-control  redactor', 'cols' => '50' , 'rows' => '4' )) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label for="message" class="col-sm-3 control-label">Faits</label>
                    <div class="col-sm-7">
                        {!! Form::textarea('faits', $arret->faits , array('class' => 'form-control  redactor', 'cols' => '50' , 'rows' => '4' )) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label for="message" class="col-sm-3 control-label">Considérant</label>
                    <div class="col-sm-7">
                        {!! Form::textarea('considerant', $arret->considerant , array('class' => 'form-control redactor', 'cols' => '50' , 'rows' => '4' )) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label for="message" class="col-sm-3 control-label">Notes</label>
                    <div class="col-sm-7">
                        {!! Form::textarea('note', $arret->note , array('class' => 'form-control', 'cols' => '10' , 'rows' => '4' )) !!}
                    </div>
                </div>

            </div>
            <div class="panel-footer mini-footer ">
                {!! Form::hidden('id', $arret->id )!!}
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                    <button class="btn btn-primary" type="submit">Envoyer </button>
                </div>
            </div>
        {!! Form::close() !!}

        </div>
    </div>

@endif

</div>
<!-- end row -->

@stop