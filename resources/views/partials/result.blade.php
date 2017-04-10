@foreach($arrets as $arret)

    <?php
        $url  = ($type == 'doctrine' ? 'article' : $type);
        $path = ($type == 'matiere' ? substr($arret->title, 0, 1) : $arret->id);
    ?>

    @if($type == 'matiere')
        <div class="arrets-list-item row">
            <div class="col-md-11">
                <h4><a href="{{ url($type.'/'.$path.'#'.$arret->id) }}"> {{ $arret->title }}</a></h4>
                @if(isset($arret->notes))
                    @foreach($arret->notes as $note)
                        <p>{{ $note->content }}</p>
                    @endforeach
                @endif
            </div>
            <div class="col-md-1"><a class="btn btn-sm btn-default" href="{{ url($url.'/'.$path.'#'.$arret->slug) }}">Voir</a></div>
        </div>
    @elseif($type == 'loi')
    <div class="arrets-list-item row">
        <div class="col-md-11">
            <h4><a href="{{ url('disposition/'.$arret->id) }}">{{ $arret->sigle }}</a></h4>
            @if(isset($arret->dispositions))
                <?php $dispositions = array_unique($arret->dispositions->lists('content')->all()); ?>
                @foreach($dispositions as $disposition)
                    <p>{{ $disposition }}</p>
                @endforeach
            @endif
        </div>
        <div class="col-md-1"><a class="btn btn-sm btn-default" href="{{ url('disposition/'.$arret->id) }}">Voir</a></div>
    </div>
    @else
        <div class="arrets-list-item row">
            <div class="col-md-8">
                <h4><a href="{{ url($url.'/'.$path) }}">{{ $arret->designation or $arret->titre }}</a></h4>
            </div>
            <div class="col-md-3">page {{ $arret->page }}, Volume {{ $rjn->find($arret->volume_id)->publication_at->year }}</div>
            <div class="col-md-1"><a class="btn btn-sm btn-default" href="{{ url($url.'/'.$path) }}">Voir</a></div>
        </div>
    @endif

@endforeach