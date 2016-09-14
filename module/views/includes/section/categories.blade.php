<section class="section no-bar categorie">
    <h2 class="section-title">Categorie&euml;n</h2>
    <div class="list list-style">
        @if(!$categories->isEmpty())
            <ul>
                @foreach($categories as $category)
                    <!-- <li><a href="{{ route('region.category.detail', [$region->slug, $category->slug]) }}">{{ $category->name }}</a></li> -->
                    <li><a href='<?php echo url()."/categorie-$category->slug"; ?>'>{{ $category->name }}</a></li> 
                @endforeach
            </ul>
        @else
            <p>Er zijn momenteel geen categorie&euml;n beschikbaar.</p>
        @endif
    </div>
</section>
