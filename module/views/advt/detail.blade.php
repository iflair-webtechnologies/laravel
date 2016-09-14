@extends('layouts.master')

@section('content')
    <div id="main">
        @include('includes.back')

        <section class="section grid no-bar pagina-titel">
            <div class="naam-bedrijf">
                <h2 class="section-title">{{ $company->name }}</h2>
            </div>
            <div class="naam-regio">
                <h2 class="section-title">Advertisements</h2>
            </div>
        </section>

        <section class="section grid no-bar nieuws nieuws-detail">
            <h2 class="section-title"><?php echo trim(strip_tags(str_limit($news->name))) ; ?></h2>

            <div class="content-detail">
                <div class="content-info">
                    <p><?php echo trim(strip_tags(str_limit($news->content))) ; ?></p>

                    <div class="bedrijf-detail-foto-groot">
                        @include('includes.image', [
                            'image' => $news->images->first(),
                            'size' => 'large',
                            'alt' => $news->name,
                        ])
                    </div>

                    <p id="content-nieuws-bericht"><?php echo trim(strip_tags(str_limit($news->content))) ; ?></p>

                </div>
            </div>
        </section>

        <section class="section grid no-bar nieuws ">
            @include('includes.company-info', [
                'company' => $company,
            ])
        </section>

        @if(!$moreNews->isEmpty())
            <section class="section grid nieuws">
                <div class="naam-bedrijf">
                    <h2 class="section-title">Meer nieuws</h2>
                </div>
                <div class="naam-vacature">
                    <h2 class="section-title">{{ $company->name }}</h2>
                </div>
                <div class="list-style list">
                    <ul>
                        @foreach($moreNews as $news)
                            <li>
                                <a href="<?php echo url($company->slug.'/advertisement/'.$news->id);?>"> {{ $news->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                @if(isset($totalNewsCount))
                    @if($moreNews->count() < $totalNewsCount)

                        <div class="lees-meer-balk">
                            <a href="<?php echo url($company->slug.'/advertisement/');?>"
                               class="lees-meer-knop">
                                Alle Advertisement {{ $company->name }}
                            </a>
                        </div>
                    @endif
                @endif
            </section>
        @endif
    </div>
@stop

