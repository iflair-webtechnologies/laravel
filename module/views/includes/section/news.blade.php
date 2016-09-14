<section class="section grid no-bar nieuws">
    <h2 class="section-title">Nieuws</h2>
    @if(!$news->isEmpty())
        <div class="news">
            @include('includes.newsitem', ['news' => $news->pop()])
        </div>
        <div class="list-style list-full-width list">
            <ul class="news">
                @foreach($news as $newsItem)
                    <li class="news-item">
                        <a href="{{ route('region.company.news.detail', [$region->slug, $newsItem->company->slug, $newsItem->id]) }}">{{ $newsItem->title }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
        @if(isset($totalNewsCount))
            @if($news->count()+1 < $totalNewsCount)
                <div class="lees-meer-balk">
                    <div class="totaal">Aantal nieuwsberichten: {{ $totalNewsCount }}</div>
                    @if(isset($company))
                        <a href="{{ route('region.company.news.index', [$region->slug, $company->slug]) }}"
                           class="lees-meer-knop">Meer</a>
                    @else
                        <a href="{{ route('region.news.index', [$region->slug]) }}" class="lees-meer-knop">Meer</a>
                    @endif
                </div>
            @endif
        @endif
    @else
        <p>Er zijn momenteel geen nieuwsberichten beschikbaar.</p>
    @endif
</section>


