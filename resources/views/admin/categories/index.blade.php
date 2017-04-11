@extends('layouts.admin')
@section('content')

<div class="row">
    <div class="col-md-12">

        <div class="options text-right" style="margin-bottom: 10px;">
            <div class="btn-toolbar">
               <a href="{{ url('admin/categorie/create') }}" class="btn btn-success"><i class="fa fa-plus"></i> &nbsp;Ajouter</a>
            </div>
        </div>

        <div class="panel panel-midnightblue">
            <div class="panel-heading">
                <h4><i class="fa fa-tasks"></i> &nbsp;Catégories</h4>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table" style="margin-bottom: 0px;" id="generic">
                        <thead>
                        <tr>
                            <th class="col-sm-2">Action</th>
                            <th class="col-sm-4">Titre</th>
                            <th class="col-sm-4">Domaine</th>
                            <th class="col-sm-2"></th>
                        </tr>
                        </thead>
                        <tbody class="selects">

                        @if(!empty($categories))
                            @foreach($categories as $categorie)
                                <tr>
                                    <td><a class="btn btn-sky btn-sm" href="{{ url('admin/categorie/'.$categorie->id) }}">&Eacute;diter</a></td>
                                    <td><strong>{{ $categorie->title }}</strong></td>
                                    <td>{{ $domains[$categorie->domain_id] }}</td>
                                    <td class="text-right">
                                        <form action="{{ url('admin/categorie/'.$categorie->id) }}" method="POST">
                                            <input type="hidden" name="_method" value="DELETE">{!! csrf_field() !!}
                                            <button data-action="categorie: {{ $categorie->title }}" class="btn btn-danger btn-sm deleteAction">Supprimer</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endif

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

@stop