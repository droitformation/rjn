@extends('layouts.admin')
@section('content')

<div class="row">

    <div class="col-md-12">

        <div class="options text-right" style="margin-bottom: 10px;">
            <div class="btn-toolbar">
                <a href="{{ url('admin/matiere') }}" class="btn btn-info"><i class="fa fa-arrow-circle-left"></i> &nbsp;Retour aux matières</a>
                <a href="{{ url('admin/note/create/'.$matiere_id) }}" class="btn btn-success"><i class="fa fa-plus"></i> &nbsp;Ajouter</a>
            </div>
        </div>

        <div class="panel panel-midnightblue">
            <div class="panel-heading">
                <h4><i class="fa fa-tag"></i> &nbsp;Contenus matières {{ $notes->title }}</h4>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table" style="margin-bottom: 0px;" id="arrets">
                        <thead>
                        <tr>
                            <th class="col-sm-1">Action</th>
                            <th class="col-sm-4">Contenu</th>
                            <th class="col-sm-4">Référence</th>
                            <th class="col-sm-1">Volume</th>
                            <th class="col-sm-1">Page</th>
                            <th class="col-sm-1"></th>
                        </tr>
                        </thead>
                        <tbody class="selects">

                        @if(isset($notes->notes))
                            @foreach($notes->notes as $note)

                            <tr>
                                <td><a class="btn btn-sky btn-sm" href="{{ url('admin/note/'.$note->id) }}">&Eacute;diter</a></td>
                                <td><strong>{!! $note->content !!}</strong></td>
                                <td>
                                    {!! $note->confer_externe or '' !!}
                                    {!! $note->confer_interne or '' !!}
                                </td>
                                <td>{{ $rjn[$note->volume_id] }}</td>
                                <td>{{ $note->page }}</td>
                                <td class="text-right">
                                    <form action="{{ url('admin/note/'.$note->id) }}" method="POST">
                                        <input type="hidden" name="_method" value="DELETE">{!! csrf_field() !!}
                                        <button data-action="contenu: {{ $note->titre}}" class="btn btn-danger btn-sm deleteAction">Supprimer</button>
                                    </form>
                                </td>
                            </tr>

                            @endforeach
                        @endif

                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="col-sm-1">Action</th>
                                <th class="col-sm-4">Contenu</th>
                                <th class="col-sm-4">Référence</th>
                                <th class="col-sm-1">Volume</th>
                                <th class="col-sm-1">Page</th>
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