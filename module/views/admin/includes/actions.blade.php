<form method="post" action="{{ $destroyUrl }}">
    <div class="btn-group btn-group-sm" role="group">
        <a role="button" href="{{ $editUrl }}" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>
        <input type="hidden" name="_method" value="DELETE">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
    </div>
</form>