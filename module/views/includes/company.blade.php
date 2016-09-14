<div class="content-detail company">
    <div class="content-title">
        <a href="<?php echo url($company->slug); ?>"><h3>{{ $company->name }}</h3></a>

        @if($company->website || $company->facebook)
        <div class="social-icon">
            @if($company->website)
                <a href="{{ $company->website }}" target="_blank" rel="nofollow"><img src="{{ asset('images/homepage/web-icon.png') }}" alt="Website van {{ $company->name }}" title="Website van {{ $company->name }}"> <!-- <i class="fa fa-li fa-globe fa-lg"></i>--></a>
            @endif

            @if($company->facebook)
                <a href="{{ $company->facebook }}" target="_blank" rel="nofollow"><img src="{{ asset('images/homepage/facebook-icon.png') }}" alt="{{ $company->name }} op Facebook" title="{{ $company->name }} op Facebook"> <!-- <i class="fa fa-li fa-facebook-square fa-lg"></i>--></a>
            @endif
        </div>
        @endif
    </div>
    <a href="<?php echo url($company->slug); ?>">
        <div class="content-foto">
            <div class="content-foto-foto">
                @include('includes.image',[
                    'image' => $company->images->first(),
                    'size' => 'large',
                    'alt' => $company->name,
                ])
            </div>
        </div>
    </a>
    <div class="content-info">
        <p>{{ $company->info }}</p>
        <a href="<?php echo url($company->slug); ?>">Ga naar {{ $company->name }}</a>
    </div>
</div>