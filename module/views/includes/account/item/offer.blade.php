<li id="{{ $offer->id }}">
    <a href="{{ route('global.account.get.offer', [$offer->id]) }}" class="edit-offer">{{ $offer->title }}</a>

    <div class="offer-options">
        <a href="{{ route('global.account.get.offer', [$offer->id]) }}" class="edit-offer fa-stack"><i
                    class="fa fa-circle fa-stack-2x"></i> <i class="fa fa-pencil fa-stack-1x fa-inverse"></i></a>
        <a href="{{ route('global.account.delete.offer', [$offer->id]) }}" class="delete-offer"><i
                    class="fa fa-times-circle fa-2x"></i></a>
    </div>
</li>
