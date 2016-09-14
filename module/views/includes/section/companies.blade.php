<section class="section no-bar nieuw-op-villato">
    <h2 class="section-title">Nieuw op Villato</h2>
    @if (!$companies->isEmpty())
    <?php //dd($companies->pop()) ?>
        @include('includes.company', ['company' => $companies->first()])
        <div class="list-style list">
            <ul class="companies">            
                @foreach($companies as $key => $company)
                     @if ($key != 0)
                    <li class="company">
                        <a href="{{ route('region.company.detail', [$company->slug]) }}"> {{ $company->name }}</a>
                        <!-- <a href="<?php echo url($company->slug); ?>"> {{ $company->name }}</a> -->
                    </li>
                    @endif
                @endforeach
            </ul>
        </div>
    @else
        <p>Er zijn momenteel geen bedrijven beschikbaar.</p>
    @endif
</section>