<section class="row">
    <div class="col-sm-6">
        @if(isset($current_volume))
            <h2>RJN {{ $rjn->find($current_volume)->publication_at->year }}</h2>
        @else
            <h2>RJN</h2>
        @endif
    </div>
    <div class="col-sm-6">

        <form method="post" action="{{ url($section['url'].'/'.$current_id) }}" id="changeVolume" class="form-horizontal">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <label class="col-sm-5 control-label"><strong>Volume</strong></label>
                <div class="col-sm-7">
                    <select style="width: 100%;" name="volume_id" data-placeholder="Domaine" class="chosen-select form-control">
                        @if(!$rjn->isEmpty())
                            @foreach($rjn as $volume)
                                <option <?php echo (isset($current_volume) && $volume->id == $current_volume ? 'selected' : ''); ?> value="{{ $volume->id }}">
                                    {{ $volume->publication_at->year }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
        </form>
    </div>
</section>