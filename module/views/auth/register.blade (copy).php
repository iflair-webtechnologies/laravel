@extends('layouts.master')

@section('content')
    <div id="main">
        @include('includes.back')
        
            <section class="section grid no-bar bedrijf-detail aanmeld-pagina">
                <h2 class="section-title">Maak uw Villato profiel aan!</h2>
                <div class="content aanmaken-profiel">
                    <p><strong>Een profiel aanmaken op Villato is gratis. Het doel van Villato is om lokaal zaken doen te promoten. Lokaal zaken doen is beter voor het milieu en het stimuleert de lokale economie.</strong><p>
                    <p>Met een Villato-profiel kan u:</p>
                    <ul>
                        <li>Gratis een profiel van uw bedrijf of instelling opzetten</li>
                        <li>Vacatures aanmaken</li>
                        <li>Nieuws plaatsen</li>
                        <li>Aanbieding uitzetten</li>
                    </ul>
                    <p>In de toekomst zullen de mogelijkheden worden uitgebreid, altijd met onderliggend doel mens en milieu te ondersteunen.</p>
                    <p>Tegen betaling kan u:</p>
                    <ul>
                        <li>Een grotere regio bereiken</li>
                        <li>Extra aanbiedingen, vacatures en nieuwsberichten plaatsen</li>
                        <li>Extra categorie&euml;n toevoegen</li>
                        <li>Meer producten &#47; diensten toevoegen</li>
                    </ul>

                    <p>De opbrengsten van deze inkomsten uit Villato zullen voor 50&#37; geherinvesteerd worden in goede doelen die mens en milieu ondersteunen binnen uw eigen regio.<p>
                        <!-- <p>Villato is van start gegaan in Oost&#45;Brabant, enige tijd terug gekozen als de meest innovatieve regio van de wereld. Villato zal op korte termijn in Nederland verder uitgerold worden en daarna zijn andere landen in Europa en de rest van de wereld aan de beurt. </p> -->
                </div>
                @include('includes.usp')
                <div class="villato-image">
                    <img src="{{ asset('images/milieu.png') }}">
                </div>
            </section>
        
        <form action="{{ route('global.register') }}" method="post" enctype="multipart/form-data">
            <section class="section grid no-bar bedrijf-detail aanmeld-pagina">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <h2 class="section-title">Snel aanmelden:</h2>

                <div class="section-title company_name">
                    <input name="name" type="text" value="{{ old('name') }}" placeholder="Uw bedrijfsnaam* (max 35 tekens)" maxlength="35" required>
                </div>

                <div class="bedrijf-detail-fotos">
                    <div class="bedrijf-detail-foto-groot">
                        <img src="{{ asset('images/no-image-logo.jpg') }}" id="image[1]" alt="Plaats hier uw logo" id="company-featured-image">

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
                        <li>
                            <img src="{{ asset('images/no_image.jpg') }}" alt="foto klein" id="image2">
                            <!--<label for="image-2"><img id="plus2" src="res/images/aanmeld-pagina/plus.png" alt="(+)" title="voeg foto toe"/></label>-->

                            <div class="image-options image-options-klein"> <!-- gebruik de class 'image-options-has-image' voor het wisselen -->
                                <div class="image-options-add">
                                    <label for="image-2" class="add-button"><i class="fa fa-plus-circle fa-2x"></i></label>
                                </div>
                                <div class="image-options-edit-delete">
                                    <label for="image-2" class="edit-button fa-stack">
                                        <i class="fa fa-circle fa-stack-2x"></i>
                                        <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
                                    </label>
                                    <div class="delete-button"><i class="fa fa-times-circle fa-2x"></i></div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <img src="{{ asset('images/no_image.jpg') }}" alt="foto klein" id="image3">
                            <!--<label for="image-3"><img id="plus3" src=">res/images/aanmeld-pagina/plus.png" alt="(+)" title="voeg foto toe"/></label>-->

                            <div class="image-options image-options-klein"> <!-- gebruik de class 'image-options-has-image' voor het wisselen -->
                                <div class="image-options-add">
                                    <label for="image-3" class="add-button"><i class="fa fa-plus-circle fa-2x"></i></label>
                                </div>
                                <div class="image-options-edit-delete">
                                    <label for="image-3" class="edit-button fa-stack">
                                        <i class="fa fa-circle fa-stack-2x"></i>
                                        <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
                                    </label>
                                    <div class="delete-button"><i class="fa fa-times-circle fa-2x"></i></div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <img src="{{ asset('images/no_image.jpg') }}" alt="foto klein" id="image4">
                            <!--<label for="image-4"><img id="plus4" src="res/images/aanmeld-pagina/plus.png" alt="(+)" title="voeg foto toe"/></label>-->

                            <div class="image-options image-options-klein"> <!-- gebruik de class 'image-options-has-image' voor het wisselen -->
                                <div class="image-options-add">
                                    <label for="image-4" class="add-button"><i class="fa fa-plus-circle fa-2x"></i></label>
                                </div>
                                <div class="image-options-edit-delete">
                                    <label for="image-4" class="edit-button fa-stack">
                                        <i class="fa fa-circle fa-stack-2x"></i>
                                        <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
                                    </label>
                                    <div class="delete-button"><i class="fa fa-times-circle fa-2x"></i></div>
                                </div>
                            </div>
                        </li>
                    </div>
                </div>

                <div class="content-detail">
                    <div class="small-info">
                        <textarea name="info" id="info" class="more-info" placeholder="Korte beschrijving van uw bedrijf* (max 150 tekens)" maxlength="150" required>{{ old('info') }}</textarea>
                        <div class="info-unique-content">
                            <div class="info-button-unique-content"></div>
                            <div class="info-box-unique-content">Unieke content is beter voor uw vindbaarheid in Google!</div>
                        </div>
                    </div>
                    <div class="telefoon-nummer">
                        <i class="fa fa-phone fa-2x"></i>
                        <input type="tel" pattern="([^0-9]*[0-9]){10,11}[^0-9]*" title="Geef een geldig telefoon nummer op." name="phone" id="phone" value="{{ old('phone') }}" placeholder="Telefoonnummer*" required>
                    </div>
                    <div class="street">
                        <i class="fa fa-map-marker fa-2x"></i>
                        <input type="text" name="street" id="street" value="{{ old('street') }}" placeholder="Adres*" required>
                    </div>
                    <div class="postal_code"><input type="text" name="postal_code" id="postal_code" value="{{ old('postal_code') }}" pattern="[1-9][0-9]{3}\s*[a-zA-Z]{2}" placeholder="1234 AA*" required></div>
                    <div class="url">
                        <i class="fa fa-globe fa-2x"></i>
                        <input type="url" name="website" id="website" value="{{ old('website') }}" placeholder="Website URL">
                    </div>
                    <select id="region" name="region" required class="drop-down chosen-select" data-placeholder="Kies een Regio...">
                        @foreach($regions as $regionItem)
                            <option value="{{ $regionItem->id }}" {{ old('region_id') == $regionItem->id ? 'selected' : '' }} >{{ $regionItem->name }}</option>
                        @endforeach
                    </select>
                    <p style="color:#c0392b;">Villato is alleen beschikbaar voor de selecteerbare regio('s), meer regio's zullen worden toegevoegd naarmate wij uitbreiden.</p>
                </div><!-- /.content-detail -->

                <div class="foto-beheer">
                    <input type="file" id="image-1" name="image[1]" accept="image/*">
                    <input type="file" id="image-2" name="image[2]" accept="image/*">
                    <input type="file" id="image-3" name="image[3]" accept="image/*">
                    <input type="file" id="image-4" name="image[4]" accept="image/*">
                </div>

                <div class="voordelen-profiel">
                    <h4>Met een bedrijfsaccount heeft u de volgende voordelen:</h4>
                    <ul>
                        <li>(Gratis) Aanmaken vacatures</li>
                        <li>(Gratis) Aanmaken nieuwsberichten</li>
                        <li>(Gratis) Aanmaken aanbiedingen</li>
                        <li>Opgeven extra bedrijfsinformatie</li>
                        <li>Profileren buiten de eigen regio</li>
                    </ul>
                </div>

                <div class="content-detail registreren">
                    <div class="content-title">
                        <h3 class="section-title">Maak een bedrijfsprofiel account aan</h3>
                        <input type="email" value="{{ old('email')  }}" id="email" name="email" placeholder="E-mailadres*" required>
                        <input type="password" class="password" name="password" placeholder="Wachtwoord*" required minlength="8">
                        <input type="password" class="password" name="password_confirmation" placeholder="Uw wachtwoord bevestigen*" required>
                    </div>
                </div>

                <div>
                    <label for="newsletter" class="block">
                        <input id="newsletter" name="newsletter" type="checkbox" value="1">
                        <span class="label">Aanmelden voor de nieuwsbrief van Villato</span><br>
                        <span class="dim">Hierbij blijft u op de hoogte van de wijzigingen die wij maken op Villato.</span>
                    </label>
                    <!--<label for="newsletter-mediaversa" class="block">
				<input id="newsletter-mediaversa" name="newsletter_mediaversa" type="checkbox" value="1">
				<span class="label">Aanmelden voor de nieuwsbrief van Mediaversa</span><br>
				<span class="dim">Hierbij blijft u op de hoogte van aanbiedingen die wij kunnen maken voor bijvoorbeeld websites en internetmarketing.</span>
			</label>-->
                </div>

                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="submit" class="button" id="save-company">Opslaan</button>

            </section>
            <!-- EINDE 'BEDRIJF DETAIL' -->
        </form>
    </div>
@stop
