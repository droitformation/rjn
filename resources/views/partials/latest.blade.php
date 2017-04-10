<div class="widget">
    <h3 class="title">Derniers arrêts commentés</h3>
    <ul class="bra_recent_entries">

        @if(isset($latest) && !$latest->isEmpty())
            @foreach($latest as $last)
                <li>
                    <?php setlocale(LC_ALL, 'fr_FR.UTF-8');  ?>
                    <span class="date">{{ $last->pub_date->formatLocalized('%d %B %Y') }}</span>
                    <a href="{{ url('jurisprudence').'/#'.$last->reference }}">{{ $last->reference }}</a>
                    <p>{{ $last->abstract }}</p>
                </li>
            @endforeach
        @endif

    </ul><!--END UL-->
</div><!--END WIDGET-->
