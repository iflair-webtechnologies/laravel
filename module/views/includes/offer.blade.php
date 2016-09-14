<div class="content-detail offer">
    <h3>{{ $offer->title }}</h3>
    <a href="{{ route('region.company.offer.detail', [$region->slug, $offer->company->slug, $offer->id]) }}">
        <div class="content-foto">
            <div class="content-foto-foto">
                @include('includes.image',[
                    'image' => $offer->images->first(),
                    'size' => 'medium',
                    'alt' => $offer->title,
                ])
            </div>
        </div>
    </a>
    <div class="content-info">
        <p>{{ str_limit($offer->description, 200) }}</p>
        <a href="{{ route('region.company.offer.detail', [$region->slug, $offer->company->slug, $offer->id]) }}">Bekijk de aanbieding</a>
    </div>
</div>
