@extends('layouts.master')

@section('content')
    <div id="main">
        @include('includes.back')
        <!-- START 'BEDRIJF DETAIL' -->
        <section class="section grid no-bar bedrijf-detail">
            <h2 class="section-title">{{ $company->name }}</h2>

            <div class='bedrijf-detail-fotos'>
                @if ($company->images->count())
                    <a data-lightbox="image-1" href="{{ route('imagecache', ['large', $company->images->first()->path]) }}">
                        <div class="bedrijf-detail-foto-groot">
                            <img src="{{ route('imagecache', ['large', $company->images->shift()->path]) }}" alt="foto groot" />
                        </div>
                    </a>
                @else
                    <div class="bedrijf-detail-foto-groot">
                        <img src="{{ asset('images/no_image_groot.jpg') }}" alt="geen foto beschikbaar">
                    </div>
                @endif
                <div class="bedrijf-detail-foto-klein">

                    @foreach($company->images as $image)
                        <li>
                            <a data-lightbox="image-1" href="{{ route('imagecache', ['medium', $image->path]) }}">
                                <img src="{{ route('imagecache', ['medium', $image->path]) }}" alt="foto klein" />
                            </a>
                        </li>
                    @endforeach
                </div>
            </div>
            <div class="content-detail">
                <div class="content-info">
                    {{ $company->info }}
                </div>
                <ul class="info-list fa-ul">
                    <li>
                        <i class="fa fa-li fa-phone fa-lg"></i>{{ $company->phone }}
                    </li>
                    <li>
                        <i class="fa fa-li fa-map-marker fa-lg"></i>{{ $company->fullAddress }}
                    </li>
                    @if($company->website)
                        <li>
                            <i class="fa fa-li fa-globe fa-lg"></i>
                            <a href="{{ $company->website }}" target="_blank" rel="nofollow">
                                Website van {{ $company->name }}
                            </a>
                        </li>
                    @endif
                    @if($company->facebook)
                        <li>
                            <i class="fa fa-li fa-facebook-square fa-lg"></i>
                            <a href="{{ $company->facebook }}" target="_blank" rel="nofollow">
                                {{ $company->name }} op Facebook
                            </a>
                        </li>
                    @endif
                </ul>
                <div class="content-tags">
                    @if(!$categories->isEmpty())
                        <div class="bedrijf-detail-content-categorie">
                            <span>Categorie</span>
                            @foreach ($categories as $category)
                                <a href="{{ route('region.category.detail', [$category->slug]) }}">
                                    {{ $category->name }}
                                </a>
                            @endforeach
                        </div>
                    @endif

                    @if(!$company->products->isEmpty())
                        <div class="bedrijf-detail-content-producten">
                            <span>Producten</span>
                                {{ $company->products->implode('name', ', ') }}
                        </div>
                    @endif
                    @if(!$company->regions->isEmpty())
                        <div class="bedrijf-detail-content-producten">
                            <span>Region</span>
                                {{ $company->regions->implode('name', ', ') }}
                        </div>
                    @endif
                </div>
            </div>
        </section>
        <!-- EINDE 'BEDRIJF DETAIL' -->

        <!-- START 'Extra' -->
        @if($company->extra_info)
            <section class="section grid no-bar">
                <h2 class="section-title">Bedrijfsinformatie</h2>
                <div class="content-detail">
                    <div class="content-info">
                        <p>{{ $company->extra_info }}</p>
                    </div>
                </div>
            </section>
        @endif
    </div>
@stop