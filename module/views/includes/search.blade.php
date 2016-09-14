<div class="zoeken">
<input type="hidden" name="searchajax" id="searchajax" value="{{ route('region.ajaxsearch') }}">
    <form method="get" action="{{ route('region.search', [!empty($region->slug) ? $region->slug : 'www']) }}">
        <input type="submit" value="">
        <input type="text" name="q" id="search" autocomplete="off" placeholder="Zoek een product, dienst of bedrijf."
               value="{{ old('query') }}">
        <ul class="search-suggestions"></ul>
    </form>
</div>