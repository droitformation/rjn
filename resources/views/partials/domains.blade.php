@if(!empty($all_domains))
    <?php $chunks = $all_domains->chunk(3,true); ?>
    @foreach($chunks as $domains)
    <div class="row">
        @foreach($domains as $domain)
        <div class="col-md-4">
                <h5 class="titleList"><a href="{{ url('domain/'.$domain->id) }}"><strong>{{ $domain->title }}</strong></a></h5>
                @if(isset($domain->categories) && !$domain->categories->isEmpty())
                <ul class="nav nav-pills red nav-stacked">
                    @foreach($domain->categories as $categories)
                    <li><a href="{{ url('categorie/'.$categories->id) }}">{{ $categories->title }}</a></li>
                    @endforeach
                </ul>
                @endif
            </div>
        @endforeach
    </div>
    @endforeach
@endif