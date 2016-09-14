<li id="{{$news->id}}">
    <a href="{{ route('global.account.get.news', [$news->id]) }}" class="edit-news">{{ $news->title }}</a>

    <div class="news-options">
        <a href="{{ route('global.account.get.news', [$news->id]) }}" class="edit-news fa-stack"><i
                    class="fa fa-circle fa-stack-2x"></i> <i class="fa fa-pencil fa-stack-1x fa-inverse"></i></a>
        <a href="{{ route('global.account.delete.news', [$news->id]) }}" class="delete-news"><i
                    class="fa fa-times-circle fa-2x"></i></a>
    </div>
</li>