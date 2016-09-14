@extends('layouts.master')

@section('content')
    <div id="main">
        @include('includes.back')

        <section class="section grid no-bar een-kolom over-villato">
            <!-- <h2 class="section-title">Over Villato</h2>
            <div class="content-detail">
                <div class="content-info">
                    <p>Villato is opgezet om lokaal zaken doen te promoten.</p>
                    <p>Voordelen van Villato&#58;</p>
                    <ul>
                        <li>Minder milieubewegingen voor verkeer, door stimuleren lokale arbeid en stimuleren inkoop bij lokale leveranciers.</li>
                        <li>Stimulering lokale economie, geld is een ruilmiddel. Wanneer de geldstromen meer binnen een gemeente blijven, wordt er meerwaarde gecree&euml;rd met dezelfde 100 euro.</li>
                        <li>Stimulering lokale initiatieven.</li>
                    </ul>

                    <p>Idee&euml;n voor ondernemerschap en lokale tekorten in een woonplaats kunnen snel en eenvoudig opgevangen worden.</p>
                    <p>Van onze winst investeren we 50&#37; in een beter milieu en een betere maatschappij. De overige winst steken we in de groei van het bedrijf en overige milieubewuste initiatieven.</p>
                    <p>In de toekomst willen we meer idee&euml;n verder gaan uitwerken, zoals lokaal afvalmanagement etc.</p>
                    <p>De website zal meer en meer uitgebreid worden met nieuwe functionaliteiten en nieuwe regio&#39;s. Idee&euml;n en partners die Maatschappelijk Verantwoord Ondernemen (MVO) zijn welkom voor idee&euml;n. </p>
                </div>
            </div>
            <div class="usp">
                <p>Stimuleer uw lokale economie</p>
                <p>Profileer u binnen uw eigen vestigingsplaats</p>
                <p>Selectief adverteren</p>
                <p>Milieubewust zaken doen</p>
            </div>
            <div class="villato-image">
                <img src="{{ asset('images/lokale-economie.png') }}">
            </div> -->
            <?php echo $cms->content; ?>
        </section>
    </div>
@stop
