@if(!$regions->isEmpty())
    <section class="section no-bar regio">
        <h2 class="section-title">Meer Villato in de regio</h2>

        <div class="list list-style">
            <ul>
                @foreach($regions as $region)
                    <li><a href="{{ route('region.detail', [$region->slug]) }}">{{ $region->name }}</a></li>
                @endforeach
            </ul>
        </div>
    </section>
@endif
