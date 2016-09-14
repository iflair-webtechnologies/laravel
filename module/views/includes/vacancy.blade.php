<div class="content-detail vacancy">
    <div class="content-title">
        <h3>{{ $vacancy->name }}</h3>
    </div>
    <p>{{ $vacancy->description }}</p>
    <div class="content-info">
        <a href="{{ route('region.company.vacancy.detail', [$region->slug, $vacancy->company->slug, $vacancy->id]) }}">Bekijk vacature</a>
        <a class="bedrijf-nieuws" href="" style="display: none;"></a>
    </div>
</div>
