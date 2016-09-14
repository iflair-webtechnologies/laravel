@extends('layouts.master')

@section('content')
    @include('includes.account.cart')
    <div id="main">
        @include('includes.back')

        <form  action="{{ route('global.account.update.company') }}" method="post" enctype="multipart/form-data" id="form-company">
            <!-- START 'BEDRIJF DETAIL' -->
            <section class="section grid no-bar bedrijf-detail edit-info">
                <h2 class="section-title company_name">
                    <span contenteditable="true" id="name">{{ $company->name }}</span>
                    <a class="potloodje" href=""></a>
                </h2>
                 <?php  //$img =  asset('uploads').'/'.$company->images->shift()->path;
                //      $count = $company->images->count();
                //      echo $title;
                     // echo "<pre>";print_r($company->images);exit;
                ?>
                
                <div class="bedrijf-detail-fotos">
                    <div class="bedrijf-detail-foto-groot">
                        
                        @if ($company->images->count() && !empty($company->images[0]))                        
                            <img src="{{ route('imagecache', ['large', $company->images[0]->path]) }}" id="image[1]" alt="foto groot" />
                            
                        @else
                            <img src="{{ asset('images/no_image_groot.jpg') }}" id="image[1]" alt="geen foto beschikbaar">
                        @endif

                        <!--<label for="image-1"><img id="plus1" src=">res/images/aanmeld-pagina/plus.png" alt="(+)" title="voeg foto toe"/></label>-->

                        <div class="image-options"> <!-- gebruik de class 'image-options-has-image' voor het wisselen -->
                            <div class="image-options-add">
                                <label for="image-1" class="add-button"><i class="fa fa-plus-circle fa-2x"></i></label>
                            </div>
                            <div class="image-options-edit-delete">
                                <label for="image-1" class="edit-button fa-stack">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
                                </label>
                                <div class="delete-button"><i class="fa fa-times-circle fa-2x"></i></div>
                            </div>
                        </div>
                    </div>

                    <div class="bedrijf-detail-foto-klein">
                        @for($i = 1; $i < 4; $i++)
                        <?php $j = $i + 1; ?>
                            <li>
                                @if($company->images->count() && !empty($company->images[$i]))
                                    <img src="{{ route('imagecache', ['medium', $company->images[$i]->path ]) }}" id="image[{{ $j }}]" alt="foto klein" />                                    
                                @else
                                    <img src="{{ asset('images/no_image.jpg') }}" id="image[{{ $j }}]" alt="geen foto beschikbaar" />
                                @endif                                
                                <div class="image-options image-options-klein"> <!-- gebruik de class 'image-options-has-image' voor het wisselen -->
                                    <div class="image-options-add">
                                        <label for="image-{{ $j }}" class="add-button"><i class="fa fa-plus-circle fa-2x"></i></label>
                                    </div>
                                    <div class="image-options-edit-delete">
                                        <label for="image-{{ $j }}" class="edit-button fa-stack">
                                            <i class="fa fa-circle fa-stack-2x"></i>
                                            <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
                                        </label>
                                        <div class="delete-button"><i class="fa fa-times-circle fa-2x"></i></div>
                                    </div>
                                </div>
                            </li>
                        @endfor
                    </div>
                </div>

                <div class="content-detail">
                    <div class="content-edit">
					<textarea name="info" id="info" placeholder="Korte beschrijving (verplicht)">{{ $company->info }}</textarea>
                        <div class="info-unique-content">
                            <div class="info-button-unique-content"></div>
                            <div class="info-box-unique-content">Unieke content is beter voor uw vindbaarheid in Google!</div>
                        </div>
                    </div>

                    <ul class="info-list fa-ul">
                        <li><i class="fa fa-li fa-phone fa-lg"></i><span class="telefoon-nummer" contenteditable="true" id="phone">{{ $company->phone }}</span></li>
                        <li><i class="fa fa-li fa-mobile fa-lg"></i><span class="mobiel-nummer" contenteditable="true" id="mobile">{{ $company->mobile }}</span></li>
                        <li><i class="fa fa-li fa-map-marker fa-lg"></i><span class="street" contenteditable="true" id="street">{{ $company->street }}</span>, <span class="postal_code" contenteditable="true" id="postal_code">{{ $company->postal_code }}</span></li>
                        <li><i class="fa fa-li fa-globe fa-lg"></i><span class="url-edit" contenteditable="true" id="website">{{ $company->website }}</span></li>
                        <li><i class="fa fa-li fa-facebook-square fa-lg"></i><span class="fb-edit" contenteditable="true" id="facebook">{{ $company->facebook }}</span></li>
                    </ul>
                    <select id="region" name="region" required class="drop-down chosen-select" data-placeholder="Kies een Regio...">
                        @foreach($regions as $regionItem)
                            <option value="{{ $regionItem->id }}" {{ $company->region->id == $regionItem->id ? 'selected' : '' }} >
                                {{ $regionItem->name }}
                            </option>
                        @endforeach
                    </select>
                </div><!-- /.content-detail -->

                <div class="foto-beheer" id="foto-beheer">
                    <input type="file" id="image-1" name="image[1]" accept="image/*">
                    <input type="file" id="image-2" name="image[2]" accept="image/*">
                    <input type="file" id="image-3" name="image[3]" accept="image/*">
                    <input type="file" id="image-4" name="image[4]" accept="image/*">
                </div>

                <div class="extra-info">
				    <textarea name="extra_info" class="more-info" rows="6" placeholder="Geef hier uw extra bedrijfsinformatie op">{{ $company->extra_info }}</textarea>
                    <div class="info-unique-content">
                        <div class="info-button-unique-content"></div>
                        <div class="info-box-unique-content">Unieke content is beter voor uw vindbaarheid in Google!</div>
                    </div>
                </div>

                <label for="newsletter" class="block">
                    <input type="checkbox" name="newsletter" value="1" {{ $company->newsletter == true ? 'checked' : '' }}>
                    <span class="label">Aanmelden voor de nieuwsbrief van Villato</span><br>
                    <span class="dim">Hierbij blijft u op de hoogte van de wijzigingen die wij maken op Villato.</span>
                </label>
                <div class="save-company-info">
                    <button type="submit" class="button" id="save-company" disabled>Opslaan</button>
                </div>
            </section>
            <!-- EINDE 'BEDRIJF DETAIL' -->
        </form>
        <section class="section grid no-bar een-kolom">
            <!-- <section class="section no-bar"> -->
            <h2 class="section-title">Pas hier uw wachtwoord aan</h2>
            <p>Als u inlogt met een door ons aangemaakt wachtwoord raden wij u sterk aan deze aan te passen voor de veiligheid van uw account.</p>
            <form action="{{ route('global.account.update.password') }}" method="post" class="reset-password" id="form-password">
                <div class="form-group">
                    <input type="password" name="password_current" class="form-control" id="password_current"
                           placeholder="Huidig wachtwoord" required>
                </div>
                <div class="form-group">
                    <input type="password" name="password" id="password" class="form-control"
                           placeholder="Nieuw wachtwoord" required minlength="8">
                </div>
                <div class="form-group">
                    <input type="password" name="password_confirmation" class="form-control" id="password_confirmation"
                           placeholder="Herhaal nieuw wachtwoord" required>
                </div>
                <button type="submit" name="submit_change_password" id="submit-change-password" class="button">Opslaan</button>
            </form>

        </section>
        <section class="section grid no-bar een-kolom" id="details">
            <h2 class="section-title">Voeg uw regio, categorie&euml;n en producten toe!</h2>
            <div class="content" style="width:100%">
                <p>Dit gedeelte is nog in ontwikkeling, maar het is wel al mogelijk om uw bedrijf onder categorie&euml;n te laten vallen.<br>
                    Deze categorie&euml;n worden bepaalt door de producten die uw bedrijf aanbied.</p>

                <div id="company-products">
                    @include('includes.account.item.products', ['products' => $company->products])
                </div>
            </div>
            <div class="opslaan-pijltje">
                <button class="button button-edit-products">Producten Selecteren</button>
            </div>
        </section>
        <section class="section grid no-bar" style="display:none">
            <div class="edit-openingstijden">
                <h2 class="section-title">Openingstijden</h2>
                <table>
                    <tr>
                        <td>
                            Maandag</td>
                        <td>
                            <input type="time" name="" placeholder="00:00 - 00:00"></td>
                        <td>
                            - </td>
                        <td>
                            <input type="time" name="" placeholder="00:00 - 00:00"></td>
                    </tr>
                    <tr>
                        <td>
                            Dinsdag</td>
                        <td>
                            <input type="time" name="" placeholder="00:00 - 00:00"></td>
                        <td>
                            - </td>
                        <td>
                            <input type="time" name="" placeholder="00:00 - 00:00"></td>
                    </tr>
                    <tr>
                        <td>
                            Woensdag</td>
                        </td>
                        <td>
                            <input type="time" name="" placeholder="00:00 - 00:00"></td>
                        <td>
                            - </td>
                        <td>
                            <input type="time" name="" placeholder="00:00 - 00:00"></td>
                    </tr>
                    <tr>
                        <td>
                            Donderdag</td>
                        <td>
                            <input type="time" name="" placeholder="00:00 - 00:00"></td>
                        <td>
                            - </td>
                        <td>
                            <input type="time" name="" placeholder="00:00 - 00:00"></td>
                    </tr>
                    <tr>
                        <td>
                            Vrijdag</td>
                        <td>
                            <input type="time" name="" placeholder="00:00 - 00:00"></td>
                        <td>
                            - </td>
                        <td>
                            <input type="time" name="" placeholder="00:00 - 00:00"></td>
                    </tr>
                    <tr>
                        <td>
                            Zaterdag</td>
                        <td>
                            <input type="time" name="" placeholder="00:00 - 00:00"></td>
                        <td>
                            - </td>
                        <td>
                            <input type="time" name="" placeholder="00:00 - 00:00"></td>
                    </tr>
                    <tr>
                        <td>
                            Zondag</td>
                        <td>
                            <input type="time" name="" placeholder="00:00 - 00:00"></td>
                        <td>
                            - </td>
                        <td>
                            <input type="time" name="" placeholder="00:00 - 00:00"></td>
                    </tr>
                </table>
                <button type="submit" name="submit_openingstijden" class="button" id="submit-openingstijden">Opslaan</button>
            </div>
        </section>

        <section class="section grid no-bar een-kolom" id="extras">
            <h2 class="section-title">Voeg een vacature, nieuwsbericht en aanbieding toe!</h2>
            <div class="content">
                <p>Door middel van een vacature, nieuwsbericht en aanbieding kunt u uw Villato bedrijfsprofiel onder de aandacht brengen van uw doelgroep. Wilt u meer vacatures, nieuwsberichten en aanbiedingen toevoegen? Dan is dat uiteraard mogelijk tegen betaling!</p>
            </div>
            <div class="keuze-blokken">
                {{--START VACATURE--}}
                <section class="keuze-blok-groot">
                    <div class="keuze-blok-titel">Vacatures</div>
                    <div class="keuze-blok-content">
                        <ul id="vacancy-item-list">
                            @foreach($company->vacancies as $vacancy)
                                @include('includes.account.item.vacancy', ['vacancy' => $vacancy])
                            @endforeach
                            <li>
                                <a href="javascript:" class="add-vacancy">
                                    Nieuwe vacature
                                    <div class="vacancy-options">
                                        <i class="fa fa-plus-circle fa-2x"></i>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="keuze-blok-zoeken">
                    </div>
                </section>
                {{--STOP VACATURE--}}

                {{--START NIEUWS--}}
                <section class="keuze-blok-groot">
                    <div class="keuze-blok-titel">Nieuws</div>
                    <div class="keuze-blok-content">
                        <ul id="news-item-list">
                            @foreach($company->news as $news)
                                @include('includes.account.item.news', ['news' => $news])
                            @endforeach
                            <li>
                                <a href="javascript:" class="add-news">
                                    Nieuwe nieuwsbericht
                                    <div class="news-options">
                                        <i class="fa fa-plus-circle fa-2x"></i>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="keuze-blok-zoeken">
                    </div>
                </section>
                {{--STOP NEWS--}}

                {{--START AANBIEDING--}}
                <section class="keuze-blok-groot">
                    <div class="keuze-blok-titel">Aanbiedingen</div>
                    <div class="keuze-blok-content">
                        <ul id="offer-item-list">
                            @foreach($company->offers as $offer)
                                @include('includes.account.item.offer', ['offer' => $offer])
                            @endforeach
                            <li>
                                <a href="javascript:" class="add-offer">
                                    Nieuwe aanbieding
                                    <div class="offer-options">
                                        <i class="fa fa-plus-circle fa-2x"></i>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="keuze-blok-zoeken">
                    </div>
                </section>
                {{--STOP AANBIEDING--}}
            </div>

            <!-- <div class="opslaan">
                <a href="/">opslaan</a>
            </div> -->
        </section>
        <!-- </div> -->
        <section class="section grid no-bar een-kolom page-cart">
            <h2 class="section-title" id="winkelmand">Winkelmandje</h2>
            <div class="content-detail">
                <div class="lijst-winkel">
                    <ul>
                        <li></li>
                        <li id="totaalprijs"><span>Totaalprijs</span>&euro;0,&#45;</li>
                    </ul>
                </div>
            </div>

            <div class="afrekenen">
                <!-- <a href="pop-up-afrekenen.html">afrekenen</a> -->
                <input type="submit" value="Afrekenen">
            </div>
        </section>
{{-- @todo Feature to be added later.


        <!-- START 'Tell a friend' -->
        <section class="section grid">
            <div class="titel">
                <h2 class="section-title">Vertel een vriend</h2>
            </div>

            <div class="content-detail">
                <div class="content-title">
                    <h3>Krijg een tegoed van &euro;5,&#45; voor uw bedrijf!</h3>
                </div>
                <div class="content-info">
                    <p>Vertel een vriend over Villato en krijg een tegoed voor uw bedrijf! Dit tegoed kunt u besteden aan regio&#39;s, categorie&#235;n, producten, vacatures, nieuws en aanbiedingen. Maak uw bedrijf compleet!</p>
                    <a href="">Lees meer</a>
                </div>
            </div>
        </section>
--}}
    </div>
    @include('includes.popup.products')
    @include('includes.popup.vacancy')
    @include('includes.popup.news')
    @include('includes.popup.offer')
@stop

