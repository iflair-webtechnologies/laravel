@if($items->render())
    <section class="section grid no-bar pagination-block">
        {!! $items->render() !!}
    </section>
@endif