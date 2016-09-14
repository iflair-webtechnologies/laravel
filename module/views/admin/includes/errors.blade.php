@if (count($errors) > 0)
    <div class="alert alert-danger">
        <h4><i class="icon fa fa-ban"></i>There is a problem with the input!</h4>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif