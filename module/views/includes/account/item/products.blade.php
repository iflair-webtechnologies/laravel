@if(!$products->isEmpty())
    <p>Momenteel zijn de volgende producten gekoppeld aan uw bedrijf:
        <strong>{{ $products->implode('name', ', ') }}</strong><p>
@else
    <p>Momenteel zijn er <strong>geen</strong> producten gekoppeld aan uw bedrijf.</p>
@endif