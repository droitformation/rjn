<a href="{{ url('jurisprudence/'.$domain->id .'/'.$volume->id) }}" class="btn btn-default btn-sm <?php echo ($volume->id == $current ? 'btn-inverse' : '') ?>">
    <i class="glyphicon glyphicon-book"></i> &nbsp;&nbsp;Volume {{ $volume->publication_at->year }}
</a>
