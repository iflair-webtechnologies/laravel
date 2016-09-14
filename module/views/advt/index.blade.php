@extends('layouts.master')

@section('content')
<div id="main">
    @include('includes.back')
 
    <section class="section grid no-bar pagina-titel">
        @if(isset($pageTitle->name))
            <div class="naam-bedrijf"><h2 class="section-title"><?php echo trim(strip_tags(str_limit($pageTitle->name))) ; ?></h2></div>
        @endif
        <div class="naam-regio"><h2 class="section-title">Advertisement</h2></div>
    </section>
    <?php //dd($news);?>

    @foreach($news as $newsItem)
        <section class="section grid no-bar nieuws">
            <h2 class="section-title">{{ $newsItem->name }}</h2>
            <div class="content-detail">
                <div class="content-info">
                    <p><?php echo trim(strip_tags(str_limit($newsItem->content))) ; ?></p>
                    <a href="<?php echo url($pageTitle->slug.'/advertisement/'.$newsItem->id);?>">Bekijk
                        het nieuws</a>
                </div>
            </div>
        </section>
    @endforeach
@include('includes.pagination', ['items' => $news])
    
</div>
@stop

