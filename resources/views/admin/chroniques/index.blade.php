@extends('layouts.admin')
@section('content')

<div class="row">
    <div class="col-md-12">

        <div class="options text-right" style="margin-bottom: 10px;">
            <div class="btn-toolbar">
               <a href="{{ url('admin/chronique/create') }}" class="btn btn-success"><i class="fa fa-plus"></i> &nbsp;Ajouter</a>
            </div>
        </div>

        <div class="panel panel-midnightblue">
            <div class="panel-heading">
                <h4><i class="fa fa-edit"></i> &nbsp;Chroniques de jurisprudence</h4>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table" style="margin-bottom: 0px;" id="arrets">
                        <thead>
                        <tr>
                            <th class="col-sm-1">Action</th>
                            <th class="col-sm-6">Titre</th>
                            <th class="col-sm-2">Date de publication</th>
                            <th class="col-sm-1">Volume</th>
                            <th class="col-sm-1"></th>
                        </tr>
                        </thead>
                        <tbody class="selects">
                        <?php setlocale(LC_ALL, 'fr_FR.UTF-8'); ?>

                            @if(!empty($chroniques))
                                @foreach($chroniques as $chronique)
                                    <tr>
                                        <td><a class="btn btn-sky btn-sm" href="{{ url('admin/chronique/'.$chronique->id) }}">éditer</a></td>
                                        <td><strong>{{ $chronique->titre }}</strong></td>
                                        <td>{{ $chronique->pub_date->formatLocalized('%d %B %Y') }}</td>
                                        <td>{{ $rjn[$chronique->volume_id] }}</td>
                                        <td>
                                            <form action="{{ url('admin/chronique/'.$chronique->id) }}" method="POST">
                                                <input type="hidden" name="_method" value="DELETE">{!! csrf_field() !!}
                                                <button data-action="chronique: {{ $chronique->designation  }}" class="btn btn-danger btn-sm deleteAction">Supprimer</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif

                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="col-sm-1">Action</th>
                                <th class="col-sm-6">Titre</th>
                                <th class="col-sm-2">Date de publication</th>
                                <th class="col-sm-1">Volume</th>
                                <th class="col-sm-1"></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

@stop