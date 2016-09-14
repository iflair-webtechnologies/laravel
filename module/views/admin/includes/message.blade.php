@if (session('message'))
    <div class="alert alert-{{session('message')['type'] }} alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        @if (isset(session('message')['header']))
            <h4>{{ session('message')['header'] }}</h4>
        @endif
        {{ session('message')['content'] }}
    </div>
@endif