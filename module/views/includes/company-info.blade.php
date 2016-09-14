<div class="naam-bedrijf">
    <h2 class="section-title">Bedrijfsinformatie</h2>
</div>

<div class="content-detail">
    <ul class="info-list fa-ul">
        <li>
            <i class="fa fa-li fa-phone fa-lg"></i>{{ $company->phone }}
        </li>
        @if($company->mobile)
            <li>
                <i class="fa fa-li fa-mobile fa-lg"></i>{{ $company->mobile }}
            </li>
        @endif
        <li>
            <i class="fa fa-li fa-map-marker fa-lg"></i>{{ $company->fullAddress }}
        </li>
        <li>
            <i class="fa fa-li fa-briefcase fa-lg"></i><a href="{{ route('region.company.detail', [$region->slug, $company->slug]) }}">{{ $company->name }}</a>
        </li>
        @if($company->website)
            <li>
                <i class="fa fa-li fa-globe fa-lg"></i><a href="{{ $company->website }}" target="_blank" rel="nofollow">Website van {{ $company->name }}</a>
            </li>
        @endif
        @if($company->facebook)
            <li><i class="fa fa-li fa-facebook-square fa-lg"></i><a href="{{ $company->facebook }}" target="_blank" rel="nofollow">{{ $company->name }} op Facebook</a></li>
        @endif
    </ul>
</div>
