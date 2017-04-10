@if(!$arrets->isEmpty())
    <div class="arrets-list">
        @foreach($arrets as $arret)
        <div class="arrets-list-item row">
            <div class="col-md-10">
                <p><small><i class="glyphicon glyphicon-book"></i> &nbsp;RJN {{ $rjn->find($arret->volume_id)->publication_at->year }}</small></p>
                <a href="{{ url('arret/'.$arret->id) }}">{{ $arret->designation }}</a>
                <p class="text-muted">{!! $arret->sommaire !!}</p>
                <p><strong>{{ $arret->cotes }}</strong></p>
                <p><em>{!! $arret->portee !!}</em></p>
            </div>
            <div class="col-md-2">
                <a class="btn btn-sm btn-default" href="{{ url('arret/'.$arret->id) }}">Voir</a>
            </div>
        </div>
        <hr>
        @endforeach
    </div>
@else
    <p>Aucun arrêt dans ce domaine pour ce volume</p>
@endif