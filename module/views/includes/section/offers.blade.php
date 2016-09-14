<section class="section grid no-bar aanbieding">
    <h2 class="section-title">Aanbiedingen</h2>
    @if(!$offers->isEmpty())
        <div class="offers">
            @include('includes.offer', ['offer' => $offers->pop()])
        </div>
        <div class="list-style list">
            <ul class="offers">
                @foreach($offers as $offer)
                    <li class="offer-item"><a
                                href="{{ route('region.company.offer.detail', [$region->slug, $offer->company->slug, $offer->id]) }}">{{ $offer->title }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
        @if(isset($totalOfferCount))
            @if($offers->count()+1 < $totalOfferCount)
                <div class="lees-meer-balk">
                    <div class="totaal">Aantal aanbiedingen: {{ $totalOfferCount }}</div>
                    @if(isset($company))
                        <a href="{{ route('region.company.offer.index', [$region->slug, $company->slug]) }}"
                           class="lees-meer-knop">Meer</a>
                    @else
                        <a href="{{ route('region.offer.index', [$region->slug]) }}" class="lees-meer-knop">Meer</a>
                    @endif
                </div>
            @endif
        @endif
    @else
        <p>Er zijn momenteel geen aanbiedingen beschikbaar.</p>
    @endif
</section>