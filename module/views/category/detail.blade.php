@extends('layouts.master')

@section('content')
    <div id="main">
        @include('includes.back')

        @if(!$companies->isEmpty())
            <section class="section grid no-bar pagina-titel">
                <div class="naam-regio">
                    <h2 class="section-title">{{ $category->name }}</h2>
                </div>
                <div class="intro-regio">
                    <p>{{ $category->description }}</p>
                </div>
            </section>

            <section class="section grid villato-profielen een-kolom">
                <h2 class="section-title">Villato Profielen</h2>
                <div class="companies">
                    @foreach($companies as $company)
                        @include('includes.company', ['company' => $company])
                    @endforeach
                </div>
            </section>

            @include('includes.pagination', ['items' => $companies])
            @include('includes.section.offers', ['offers' => $offers])
            @include('includes.section.news', ['news' => $news])
            @include('includes.section.vacancies', ['vacancies' => $vacancies])
        @else
            <div class="section grid no-bar pagina-titel">
                <div class="naam-regio">
                    <h2 class="section-title">Er zijn geen profielen gevonden in {{ $category->name }}</h2>
                </div>
            </div>
        @endif
    </div>
@stop


