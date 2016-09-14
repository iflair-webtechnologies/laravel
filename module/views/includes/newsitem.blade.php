<div class="news-detail nieuws">
    <h3>{{ $news->title }}</h3>
    <a href="{{ route('region.company.news.detail', [$region->slug, $news->company->slug, $news->id]) }}">
        <div class="content-foto">
            <div class="content-foto-foto">
                @include('includes.image',[
                    'image' => $news->images->first(),
                    'size' => 'medium',
                    'alt' => $news->title,
                ])
            </div>
        </div>
    </a>

    <div class="content-info">
        <p>{{ str_limit($news->description, 200) }}</p>
        <a href="{{ route('region.company.news.detail', [$region->slug, $news->company->slug, $news->id]) }}">Lees het
            hele bericht</a>
    </div>
</div>
