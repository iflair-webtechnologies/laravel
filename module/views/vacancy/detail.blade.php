@extends('layouts.master')

@section('content')
    <div id="main">
        @include('includes.back')

        <section class="section grid no-bar pagina-titel">
            <div class="naam-bedrijf">
                <h2 class="section-title">{{ $company->name }}</h2>
            </div>
            <div class="naam-regio">
                <h2 class="section-title">Vacatures</h2>
            </div>
        </section>

        <section class="section grid no-bar vacature">
            <h2 class="section-title">{{ $vacancy->title }}</h2>
            <div class="content-detail">
                <div class="content-info">
                    <p>{{ $vacancy->description }}</p><br>

                    <div class="lijst-b">
                        <ul>
                            @if($vacancy->education)
                                <li>
                                    <span>Opleidingsniveau:</span> {{ $vacancy->education }}
                                </li>
                            @endif

                            @if($vacancy->duration)
                                <li>
                                    <span>Contract duur:</span> {{ $vacancy->duration }}
                                </li>
                            @endif

                            @if($vacancy->hours)
                                <li>
                                    <span>Aantal uren:</span> {{ $vacancy->hours }}
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section class="section grid no-bar vacature ">
            @include('includes.company-info', [
                'company' => $company,
            ])
        </section>

        @if(!$moreVacancies->isEmpty())
            <section class="section grid vacature">
                <div class="naam-bedrijf">
                    <h2 class="section-title">Meer vacatures</h2>
                </div>
                <div class="naam-vacature">
                    <h2 class="section-title">{{ $company->name }}</h2>
                </div>
                <div class="list-style list">
                    <ul>
                        @foreach($moreVacancies as $vacancy)
                            <li>
                                <a href="{{ route('region.company.vacancy.detail', [$region->slug, $company->slug, $vacancy->id]) }}"> {{ $vacancy->title }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                @if(isset($totalVacancyCount))
                    @if($moreVacancies->count() < $totalVacancyCount)
                        <div class="lees-meer-balk">
                            <a href="{{ route('region.company.vacancy.index', [$region->slug, $company->slug]) }}"
                               class="lees-meer-knop">
                                Alle vacatures {{ $company->name }}
                            </a>
                        </div>
                    @endif
                @endif
            </section>
        @endif
    </div>
@stop

