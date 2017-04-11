@extends('layouts.admin')
@section('content')

<div class="row"><!-- row -->
    <div class="col-md-12"><!-- col -->
        <p><a class="btn btn-default" href="{{ url('admin/categorie') }}"><i class="fa fa-reply"></i> &nbsp;Retour à la liste</a></p>
    </div>
</div>
<!-- start row -->
<div class="row">

    @if ( !empty($categorie) )

    <div class="col-md-12">
        <div class="panel panel-midnightblue">

            <form action="{{ url('admin/categorie/'.$categorie->id) }}" method="post" class="form-validation form-horizontal">
                <input type="hidden" name="_method" value="PUT">{!! csrf_field() !!}

            <div class="panel-heading">
                <h4>&Eacute;diter {{ $categorie->title }}</h4>
            </div>
            <div class="panel-body event-info">

                <div class="form-group">
                    <label for="message" class="col-sm-3 control-label">Titre</label>
                    <div class="col-sm-3">
                        {!! Form::text('title', $categorie->title , array('class' => 'form-control') ) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label for="message" class="col-sm-3 control-label">Domaine</label>
                    <div class="col-lg-4 col-sm-7 col-xs-9">
                        <select class="form-control" id="domain" name="domain_id">
                            @if(!empty($domains))
                                @foreach($domains as $domain_id => $domain)
                                 <option <?php echo ($domain_id == $categorie->domain_id ? 'selected' : ''); ?> value="{{ $domain_id }}">{{ $domain }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>

            </div>
            <div class="panel-footer mini-footer ">
                {!! Form::hidden('id', $categorie->id ) !!}
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