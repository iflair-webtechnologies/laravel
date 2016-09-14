@extends('layouts.master')

@section('content')
    <div id="main">
        <div class="home-layout grid">
            @include('includes.section.companies', ['companies' => $companies])
            @include('includes.section.categories', ['categories' => $categories])
            @include('includes.section.regions', ['regions' => $regions])
        </div>
        @include('includes.section.offers', ['offers' => $offers])
        @include('includes.section.news', ['news' => $news])
        @include('includes.section.vacancies', ['vacancies' => $vacancies])
    </div>
@stop