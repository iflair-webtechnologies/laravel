@extends('layouts.master')

@section('content')
    <div id="main">
        <div class="home-layout grid">
            @include('includes.section.companies', ['companies' => $companies])           
        </div>
       <!--  @include('includes.section.offers', ['offers' => $offers])
        @include('includes.section.news', ['news' => $news])
        @include('includes.section.vacancies', ['vacancies' => $vacancies]) -->
        @include('includes.section.advertisements', ['advertisements' => $categoryadvt])
    </div>
@stop