@extends('layouts.master')

@section('content')
    <div id="main">
        @include('includes.back')

        <div class="section grid no-bar pagina-titel">
            <div class="naam-bedrijf"><h2 class="section-title">{{ $company->name }}</h2></div>
            <div class="naam-regio"><h2 class="section-title">Aanbiedingen</h2></div>
        </div>

        <section class="section grid no-bar aanbieding aanbieding-detail">
            <h2 class="section-title">{{ $offer->title }}</h2>
            <div class="content-detail">
                <div class="content-info">
                    <p>{{ $offer->description }}</p><br>
                        <div class="bedrijf-detail-foto-groot">
                            @include('includes.image', [
                                'image' => $offer->images->first(),
                                'size' => 'large',
                                'alt' => $offer->title,
                            ])
                        </div>
                    <p id="detail-bericht"> {{ $offer->content }}</p>
                </div>
            </div>
        </section>

        <section class="section grid no-bar aanbieding">
            @include('includes.company-info', [
                'company' => $company,
            ])
        </section>
        
        @if(!$moreOffers->isEmpty())
            <section class="section grid aanbieding">
                <div class="naam-bedrijf">
                    <h2 class="section-title">Meer aanbiedingen</h2>
                </div>
                <div class="naam-vacature">
                    <h2 class="section-title">{{ $company->name }}</h2>
                </div>
                <div class="list-style list-full-width list">
                    <ul>
                        @foreach($moreOffers as $offer)
                            <li>
                                <a href="{{ route('region.company.offer.detail', [$region->slug, $company->slug, $offer->id]) }}"> {{ $offer->title }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                @if(isset($totalOfferCount))
                    @if($moreOffers->count() < $totalOfferCount)
                        <div class="lees-meer-balk">
                            <a href="{{ route('region.company.offer.index', [$region->slug, $company->slug]) }}" class="lees-meer-knop">
                                Alle aanbiedingen {{ $company->name }}
                            </a>
                        </div>
                    @endif
                @endif
            </section>
        @endif
    </div>
@stop
