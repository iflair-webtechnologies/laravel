@extends('layouts.master')

@section('content')
    <div id="main">
        @include('includes.back')

        <section class="section grid no-bar pagina-titel">
            <div class="naam-bedrijf"><h2 class="section-title">{{ $pageTitle }}</h2></div>
            <div class="naam-regio"><h2 class="section-title">Vacatures</h2></div>
        </section>

        @foreach($vacancies as $vacancy)
            <section class="section grid no-bar vacature">
                <h2 class="section-title">{{ $vacancy->title }}</h2>
                <div class="content-detail">
                    <div class="content-info">
                        <p>{{ str_limit($vacancy->description) }}</p>
                        <a href="{{ route('region.company.vacancy.detail', [$vacancy->company->region->slug, $vacancy->company->slug, $vacancy->id ]) }}">Bekijk de vacature</a>
                    </div>
                </div>
            </section>
        @endforeach

        @include('includes.pagination', ['items' => $vacancies])
    </div>
@stop

