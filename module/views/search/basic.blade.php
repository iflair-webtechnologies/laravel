@extends('layouts.master')

@section('content')
    <div id="main">
        @include('includes.back')

        @if(!$results->isEmpty())
            <section class="section grid no-bar pagina-titel">
                <div class="naam-regio">
                    <h2 class="section-title">Zoekresultaten voor "{{ $query }}"</h2>
                </div>
            </section>
            <section class="section grid villato-profielen een-kolom">
                <h2 class="section-title">Gevonden Profielen</h2>

                <div class="companies">
                    @foreach($results as $company)
                        @include('includes.company', ['company' => $company])
                    @endforeach
                </div>
            </section>

            @include('includes.pagination', ['items' => $results])
        @else
            <div class="section grid no-bar pagina-titel">
                <div class="naam-regio">
                    <h2 class="section-title">Er zijn geen resultaten gevonden voor uw zoekopdracht.</h2>
                </div>
            </div>
        @endif
    </div>
@stop


