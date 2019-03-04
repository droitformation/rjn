@extends('layouts.admin')
@section('content')

<div class="row"><!-- row -->
    <div class="col-md-12"><!-- col -->
         <p><a class="btn btn-default" href="{{ url('admin/arret') }}"><i class="fa fa-reply"></i> &nbsp;Retour à la liste</a></p>
    </div>
</div>
<!-- start row -->
<div class="row"  id="app">

@if ( !empty($arret) )

    <div class="col-md-7">
        <div class="panel panel-midnightblue">

            <form action="{{ url('admin/arret/'.$arret->id) }}" method="post" class="form-validation form-horizontal">
                <input type="hidden" name="_method" value="PUT">{!! csrf_field() !!}

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
                    <div class="col-lg-4 col-sm-9 col-xs-9">
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
                    <div class="col-lg-4 col-sm-9 col-xs-9">
                        <?php $categorie_id = (isset($arret->arrets_categories[0]) ? $arret->arrets_categories[0]->id : null); ?>
                        <select class="form-control" id="categorie" data-domain="{{ $arret->domain_id }}" data-categorie="{{ $categorie_id }}" name="categorie_id">
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="message" class="col-sm-3 control-label">Page</label>
                    <div class="col-lg-2 col-sm-5">
                        {!! Form::text('page', $arret->page , array('class' => 'form-control') ) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label">Volume</label>
                    <div class="col-lg-2 col-sm-5">
                        {!! Form::select('volume_id', $rjn , $arret->volume_id , ['class' => 'form-control'] ) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label for="message" class="col-sm-3 control-label">Date de publication</label>
                    <div class="col-lg-2 col-sm-5">
                        {!! Form::text('pub_date', $arret->pub_date->format('Y-m-d') , array('class' => 'form-control datePicker') ) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label for="message" class="col-sm-3 control-label">Références</label>
                    <div class="col-sm-9">
                        <input type="text" name="cotes" class="form-control" style="background:#fffdf5;border-color:#fee142;" value="{{ $arret->cotes }}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="message" class="col-sm-3 control-label">Références termes</label>
                    <div class="col-sm-9">
                        <loi
                            :lois="{{ $list_lois }}"
                            :volumes="{{ $list_volumes }}"
                            :dispositions="{{ $dispositions }}"
                            :page="{{ $arret->page }}"
                            :volume_id="{{ $arret->volume_id }}"></loi>
                    </div>
                </div>

                <div class="form-group">
                    <label for="message" class="col-sm-3 control-label">Sommaire</label>
                    <div class="col-sm-9">
                        {!! Form::textarea('sommaire', $arret->sommaire , array('class' => 'form-control', 'cols' => '50' , 'rows' => '4' )) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label for="message" class="col-sm-3 control-label">Portée</label>
                    <div class="col-sm-9">
                        {!! Form::textarea('portee', $arret->portee , array('class' => 'form-control  redactor', 'cols' => '50' , 'rows' => '4' )) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label for="message" class="col-sm-3 control-label">Faits</label>
                    <div class="col-sm-9">
                        {!! Form::textarea('faits', $arret->faits , array('class' => 'form-control  redactor', 'cols' => '50' , 'rows' => '4' )) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label for="message" class="col-sm-3 control-label">Considérant</label>
                    <div class="col-sm-9">
                        {!! Form::textarea('considerant', $arret->considerant , array('class' => 'form-control redactor', 'cols' => '50' , 'rows' => '4' )) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label for="message" class="col-sm-3 control-label">Notes</label>
                    <div class="col-sm-9">
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
            </form>

        </div>
    </div>
    <div class="col-md-5">
        <div class="panel panel-midnightblue">
            <form action="{{ url('admin/arret') }}" method="post" class="form-validation form-horizontal">{!! csrf_field() !!}
                <div class="panel-heading">
                    <h4>Ajouter les matières</h4>
                </div>
                <div class="panel-body">
                    <matiere :matieres="{{ $list_matieres }}"
                             :notes="{{ $notes }}"
                             :volumes="{{ $list_volumes }}"
                             :page="{{ $arret->page }}"
                             :volume_id="{{ $arret->volume_id }}"></matiere>
                </div>
            </form>
        </div>
    </div>

@endif

</div>
<!-- end row -->

@stop