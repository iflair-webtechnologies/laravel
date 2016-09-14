<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="robots" content="noindex, nofollow">
    <title>@yield('title', $title)</title>
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">
    <meta name="description" content="@yield('description')">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link rel="stylesheet" type="text/css" href="{{ asset('css/normalize.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/animate.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/chosen.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/lightbox.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery-impromptu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/popup/vacancy.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/form/vacancy.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/popup/news.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/form/news.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/popup/offer.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/form/offer.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans:400,300">
    <script type="text/javascript">
    var siteurl = "<?php echo url(); ?>";
    </script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('scripts/jquery-ui-1.10.3.custom.min.js') }}"></script>
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script type="text/javascript" src="{{ asset('scripts/chosen.jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('scripts/jquery-impromptu.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('scripts/jquery.kinetic.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('scripts/lightbox.min.js') }}"></script>
    <script type="text/javascript" src='{{ asset('scripts/jquery.autosize.js') }}'></script>
    <script type="text/javascript" src="{{ asset('scripts/vendor/modernizr-2.6.2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('scripts/company.js') }}"></script>
    <script type="text/javascript" src="{{ asset('scripts/cart.js') }}"></script>
    <script type="text/javascript" src="{{ asset('scripts/edit-products.js') }}"></script>
    <!-- <script type="text/javascript" src="{{ asset('scripts/popup/vacancy.js') }}"></script> -->
    <script type="text/javascript" src="{{ asset('scripts/popup/news.js') }}"></script>

    <script type="text/javascript" src="{{ asset('scripts/popup/offer.js') }}"></script>
    
    <script type="text/javascript" src="{{ asset('scripts/readmore.js') }}"></script>
</head>
<body class="{{ isset($region) ? 'region' : 'no-region' }}">

<!--[if lt IE 7]>
<p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

<div id="wrapper">
    <header>
        @section('header')
            <a href="{{ route('region.detail', 'www') }}" class="logo"></a>
            @if (isset($region))
                <div class="locatie-naam">
                    <a href="{{ route('region.detail', $region->slug) }}">
                        <h1>{{ $region->name }}</h1>
                    </a>
                </div>
            @endif

            @include('includes.search')

            <nav>
                <ul class="menu">
                        @section('menu')
                            <li><img src="{{asset('images/algemeen/menu-button.png') }}" alt="menu button">
                                <ul>
                                    @if (Auth::check())
                                        <li><a href="{{ route('global.account.index') }}">Mijn Villato profiel</a></li>
                                        <li><a href="{{ route('global.logout') }}">Uitloggen</a></li>
                                    @else
                                        <li><a href="{{ route('global.login') }}">Inloggen</a></li>
                                        <li><a href="{{ route('global.register') }}">Meld uw bedrijf aan</a></li>
                                    @endif
                                </ul>
                            </li>
                        @show
                </ul>
            </nav>
        @show
    </header>

    @yield('content')

   
<footer>
        <div class="footer-content">
            <div class="footer-menu">
                <ul>
                    @if(Auth::guest())
                        <li><a href="{{ route('global.login') }}">Inloggen</a></li>
                        <li><a href="{{ route('global.register') }}">Meld uw bedrijf aan</a></li>
                    @endif
                    <li><a href="{{ route('global.about') }}">Over Villato</a></li>
                </ul>
            </div>
            <div class="copyright">
                <p>
                    <span>&copy;  {{ date('Y') }} Villato. </span>
                    <span>Villato is een initiatief van <a href="http://www.mediaversa.nl" target="_blank">Mediaversa</a></span>
                </p>
            </div>
        </div>
    </footer> 
</div>

    <script src="{{ asset('scripts/plugins.js') }}"></script>
    <script src="{{ asset('scripts/main.js') }}"></script>
    <script src="{{ asset('scripts/masonry.pkgd.min.js') }}"></script>

    <script>
        var container = document.querySelector('#main');
        var masonry = new Masonry(container, {
            columnWidth: 50,
            itemSelector: '.grid'
        });

        var container1 = document.querySelector('#main1');
        var masonry = new Masonry(container1, {
            columnWidth: 50,
            itemSelector: '.grid'
        });
    </script>
</body>
</html>

