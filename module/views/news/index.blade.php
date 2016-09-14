@extends('layouts.master')

@section('content')
<div id="main">
    @include('includes.back')

    <section class="section grid no-bar pagina-titel">
        @if(isset($pageTitle))
            <div class="naam-bedrijf"><h2 class="section-title">{{ $pageTitle }}</h2></div>
        @endif
        <div class="naam-regio"><h2 class="section-title">Nieuws</h2></div>
    </section>

    @foreach($news as $newsItem)
        <section class="section grid no-bar nieuws">
            <h2 class="section-title">{{ $newsItem->title }}</h2>

            <div class="content-detail">
                <div class="content-info">
                    <p>{{ str_limit($newsItem->description) }}</p>
                    <a href="{{ route('region.company.news.detail', [$region->slug, $newsItem->company->slug, $newsItem->id ]) }}">Bekijk
                        het nieuws</a>
                </div>
            </div>
        </section>
    @endforeach

    @include('includes.pagination', ['items' => $news])
</div>
@stop

