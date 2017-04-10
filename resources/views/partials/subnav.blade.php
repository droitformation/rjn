<div id="sidebar" class="col-md-3">

    <h4>Volume</h4>

    <div class="volume">
        @if(!$rjn->isEmpty())
            @foreach($rjn as $volume)
            <div class="volume-item">
                <!-- START partials -->
                @if(Request::is( 'doctrine') || Request::is( 'doctrine/*'))
                    @include('partials.doctrine')
                @elseif(Request::is('jurisprudence/*') || Request::is('domain/*'))
                    @include('partials.jurisprudence')
                @endif
                <!-- END partials -->
            </div>
            @endforeach
        @endif
    </div>

    @if(Request::is('jurisprudence/*'))
        @include('partials.filter')
    @endif

</div>