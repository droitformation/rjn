<div class="row">
    <div class="col-md-9">
        <div class="post">
            <div class="post-title">
                <?php setlocale(LC_ALL, 'fr_FR.UTF-8');  ?>
                <h2 class="title">{{ $bloc->reference }} du {{ $bloc->pub_date->formatLocalized('%d %B %Y') }}</h2>
                <p>{{ $bloc->abstract }}</p>
            </div><!--END POST-TITLE-->
            <div class="post-entry">
                {{ $bloc->pub_text }}
                @if(isset($bloc->file))
                    <p><a target="_blank" href="{{ asset('files/arrets/'.$bloc->file) }}">Télécharger en pdf</a></p>
                @endif
            </div>
        </div><!--END POST-->
    </div>
    <div class="col-md-3 listCat">
        <?php
        if(!$bloc->arrets_categories->isEmpty() )
        {
            foreach($bloc->arrets_categories as $categorie)
            {
                // Categories
                echo '<a target="_blank" href="'.url('jurisprudence').'#'.$bloc->reference.'"><img width="130" border="0" alt="Loyer" src="'.asset('newsletter/pictos/'.$categorie->image).'"></a>';
            }
        }
        ?>
    </div>
</div>

@if(!$bloc->arrets_analyses->isEmpty())

<!-- Bloc content-->
<div class="row">
    <div class="col-md-9">

        @foreach($bloc->arrets_analyses as $analyse)
            <div class="post">
                    <div class="post-title">
                        <?php setlocale(LC_ALL, 'fr_FR.UTF-8');  ?>
                        <h2 class="title">Analyse de l'arrêt {{ $bloc->reference }}</h2>
                    </div><!--END POST-TITLE-->
                    <div class="post-entry">
                        <h4>{{ $analyse->authors }}</h4>
                        <p>{{ $analyse->abstract }}</p>
                        <p><a target="_blank" href="{{ asset('files/analyses/'.$analyse->file) }}">Télécharger en pdf</a></p>
                    </div>
            </div><!--END POST-->
        @endforeach

    </div>
    <div class="col-md-3 listCat">
        <a href="{{ url('jurisprudence') }}">
            <img width="130" border="0" alt="Analyse" src="{{ asset('images/analyse.png') }}">
        </a>
    </div>
    <!-- Bloc content-->

</div>
@endif
