<section class="section grid no-bar vacature">
    <h2 class="section-title">Vacatures</h2>
    @if(!$vacancies->isEmpty())
        <div class="vacancies">
            @foreach($vacancies as $vacancy)
                @include('includes.vacancy', ['vacancy' => $vacancy])
            @endforeach
        </div>
        @if(isset($totalVacancyCount))
            @if($vacancies->count() < $totalVacancyCount)
                <div class="lees-meer-balk">
                    <div class="totaal">Aantal vacatures: {{ $totalVacancyCount }}</div>
                    @if(isset($company))
                        <a href="{{ route('region.company.vacancy.index', [$region->slug, $company->slug]) }}"
                           class="lees-meer-knop">Meer</a>
                    @else
                        <a href="{{ route('region.vacancy.index', [$region->slug]) }}" class="lees-meer-knop">Meer</a>
                    @endif
                </div>
            @endif
        @endif
    @else
    <p>Er zijn momenteel geen vacatures beschikbaar.</p>
    @endif
</section>

