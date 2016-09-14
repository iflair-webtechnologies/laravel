@extends('layouts.master')

@section('content')
    <div id="main">
        @include('includes.back')

        <section class="section grid no-bar pagina-titel">
            @if(isset($pageTitle))
                <div class="naam-bedrijf"><h2 class="section-title">{{ $pageTitle }}</h2></div>
            @endif
            <div class="naam-regio"><h2 class="section-title">Aanbiedingen</h2></div>
        </section>

        @foreach($offers as $offer)
            <section class="section grid no-bar aanbieding">
                <h2 class="section-title">{{ $offer->title }}</h2>
                <div class="content-detail">
                    <div class="content-info">
                        <p>{{ str_limit($offer->description) }}</p>
                        <a href="{{ route('region.company.offer.detail', [$region->slug, $offer->company->slug, $offer->id ]) }}">Bekijk de aanbieding</a>
                    </div>
                </div>
            </section>
        @endforeach

        @include('includes.pagination', ['items' => $offers])
    </div>
@stop

