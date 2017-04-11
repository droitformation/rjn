@extends('layouts.admin')
@section('content')

<div class="row">

    <div class="col-md-12">

        <div class="options text-right" style="margin-bottom: 10px;">
            <div class="btn-toolbar">
                <a href="{{ url('admin/loi') }}" class="btn btn-info"><i class="fa fa-arrow-circle-left"></i> &nbsp;Retour aux lois</a>
                <a href="{{ url('admin/disposition/create/'.$loi_id) }}" class="btn btn-success"><i class="fa fa-plus"></i> &nbsp;Ajouter</a>
            </div>
        </div>

        <div class="panel panel-midnightblue">
            <div class="panel-heading">
                <h4><i class="fa fa-tag"></i> &nbsp;Contenus loi {{ $dispositions->sigle }}</h4>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table" style="margin-bottom: 0px;" id="generic">
                        <thead>
                        <tr>
                            <th class="col-sm-1">Action</th>
                            <th class="col-sm-6">Contenu</th>
                            <th class="col-sm-2">Article</th>
                            <th class="col-sm-2">Subdivisions</th>
                            <th class="col-sm-1"></th>
                        </tr>
                        </thead>
                        <tbody class="selects">

                        @if(isset($dispositions->dispositions))
                            @foreach($dispositions->dispositions as $disposition)

                            <tr>
                                <td><a class="btn btn-sky btn-sm" href="{{ url('admin/disposition/'.$disposition->id) }}">&Eacute;diter</a></td>
                                <td><strong>{!! $disposition->content !!}</strong></td>
                                <td>{!! $disposition->cote or '' !!}</td>
                                <td><a class="btn btn-default btn-sm" href="{{ url('admin/disposition/page/'.$disposition->id) }}">Voir les subdivisions</a></td>
                                <td class="text-right">
                                    <form action="{{ url('admin/disposition/'.$disposition->id) }}" method="POST">
                                        <input type="hidden" name="_method" value="DELETE">{!! csrf_field() !!}
                                        <button data-action="contenu: {{ $disposition->content  }}" class="btn btn-danger btn-sm deleteAction">Supprimer</button>
                                    </form>
                                </td>
                            </tr>

                            @endforeach
                        @endif

                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="col-sm-1">Action</th>
                                <th class="col-sm-6">Contenu</th>
                                <th class="col-sm-2">Article</th>
                                <th class="col-sm-2">Subdivisions</th>
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