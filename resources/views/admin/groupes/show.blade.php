@extends('layouts.admin')
@section('content')

<div class="row"><!-- row -->
    <div class="col-md-12"><!-- col -->
        <p><a class="btn btn-default" href="{{ url('admin/groupe') }}"><i class="fa fa-reply"></i> &nbsp;Retour à la liste</a></p>
    </div>
</div>
<!-- start row -->
<div class="row">

    @if ( !empty($groupe) )

    <div class="col-md-12">
        <div class="panel panel-midnightblue">

            <!-- form start -->
            {!! Form::model($groupe,array(
                'method' => 'PUT',
                'class'  => 'form-validation form-horizontal',
                'url'    => array('admin/groupe/'.$groupe->id)))
            !!}

            <div class="panel-heading">
                <h4>&Eacute;diter {{ $groupe->titre }}</h4>
            </div>
            <div class="panel-body event-info">

                <div class="form-group">
                    <label for="message" class="col-sm-3 control-label">Titre</label>
                    <div class="col-sm-3">
                        {!! Form::text('titre', $groupe->titre , array('class' => 'form-control') ) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label for="message" class="col-sm-3 control-label">Domaine</label>
                    <div class="col-lg-4 col-sm-7 col-xs-9">
                        <select class="form-control" id="domain" name="domain_id">
                            @if(!empty($domains))
                                @foreach($domains as $domain_id => $domain)
                                    <option <?php echo ($groupe->domain_id == $domain_id ? 'selected' : ''); ?> value="{{ $domain_id }}">{{ $domain }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="message" class="col-sm-3 control-label">Categorie</label>
                    <div class="col-lg-4 col-sm-7 col-xs-9">
                        <select class="form-control" id="categorie" data-domain="{{ $groupe->domain_id }}" data-categorie="{{ $groupe->categorie_id }}" name="categorie_id">
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label">Volume</label>
                    <div class="col-lg-1 col-sm-2 col-xs-3">
                        {!! Form::select('volume_id', $rjn , $groupe->volume_id, [ 'class' => 'form-control']) !!}
                    </div>
                </div>

            </div>
            <div class="panel-footer mini-footer ">
                {!! Form::hidden('id', $groupe->id ) !!}
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