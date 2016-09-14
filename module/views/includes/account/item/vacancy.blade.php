<li id="{{ $vacancy->id }}">
    <a href="{{ route('global.account.get.vacancy', [$vacancy->id]) }}" class="edit-vacancy">{{ $vacancy->title }}</a>

    <div class="vacancy-options">
        <a href="{{ route('global.account.get.vacancy', [$vacancy->id]) }}" class="edit-vacancy fa-stack"><i
                    class="fa fa-circle fa-stack-2x"></i> <i class="fa fa-pencil fa-stack-1x fa-inverse"></i></a>
        <a href="{{ route('global.account.delete.vacancy', [$vacancy->id]) }}" class="delete-vacancy"><i
                    class="fa fa-times-circle fa-2x"></i></a>
    </div>
</li>