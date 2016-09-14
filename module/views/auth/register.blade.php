@extends('layouts.master')
@section('content')
    
    <div id="main">
        @include('includes.back')
        
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
                       
                            <img src="{{ asset('images/no_image_groot.jpg') }}" id="image[1]" alt="geen foto beschikbaar">
                       
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
                            <img src="{{ asset('images/no_image.jpg') }}" alt="foto klein" id="image[2]">
                            

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
                            <img src="{{ asset('images/no_image.jpg') }}" alt="foto klein" id="image[3]">
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
                            <img src="{{ asset('images/no_image.jpg') }}" alt="foto klein" id="image[4]">
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
					<div class="extra-info">
						<textarea name="extra_info" style=" width: 390px;margin-left:0px!important;" class="more-info" rows="6" placeholder="Geef hier uw extra bedrijfsinformatie op"></textarea>
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
					 <div class="mobiel-nummer">
                        <i class="fa fa-mobile fa-2x" style="margin-right:15px;"></i>
                        <input style="padding: 5px 10px 5px 13px !important;width: 343px !important;" type="tel" pattern="([^0-9]*[0-9]){10,11}[^0-9]*" title="Geef een geldig mobiel nummer op." name="mobile" id="mobile" value="{{ old('mobile') }}" placeholder="mobile*" required>
                    </div>
                    <div class="street">
                        <i class="fa fa-map-marker fa-2x"></i>
                        <input type="text" style="margin-left:4px;" name="street" id="street" value="{{ old('street') }}" placeholder="Adres*" required>
                    </div>
                    <div class="postal_code"><input style="margin: 0 0 10px 25px;" type="text" name="postal_code" id="postal_code" value="{{ old('postal_code') }}" pattern="[1-9][0-9]{3}\s*[a-zA-Z]{2}" placeholder="1234 AA*" required></div>
                    <div class="url">
                        <i class="fa fa-globe fa-2x"></i>
                        <input type="url" name="website" id="website" value="{{ old('website') }}" placeholder="Website URL">
                    </div>
                     <div style="display:block;height:110px">
                          <p style="color:#c0392b;">Villato is alleen beschikbaar voor de selecteerbare regio('s), meer regio's zullen worden toegevoegd naarmate wij uitbreiden.</p>
                          
                        <select id="region" name="region[]"  multiple required class="drop-down chosen-select" data-placeholder="Kies een Regio...">
                            @foreach($regions as $regionItem)
                            <?php (old('region'))?(in_array($regionItem->id,old('region')))? $selected = "selected = selected":$selected ='':$selected =''; ?>
                                <option value="{{ $regionItem->id }}" <?php echo $selected; ?> >{{ $regionItem->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <?php print_r(old('category_id')); ?>
                    <div style="display:block;height:70px">
                        <select  name="category[]" id="regcategory" multiple required class="drop-down chosen-select" data-placeholder="Kies een categorie...">
                       
                        </select>
                    </div>
                    <div style="display:block;height:200px">
                    <select id="regproduct" multiple name="product[]"  class="drop-down" data-placeholder="Kies een Product...">
                    
                    </select>
                    </div>
                   
                </div><!-- /.content-detail -->

                <div class="foto-beheer" id="foto-beheer">
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
                    <input type="submit" class="button" id="save-company" value="Opslaan">

            </section>
            <!-- EINDE 'BEDRIJF DETAIL' -->
        </form>
    </div>
    <script>
 jQuery(document).ready(function() {
      
        jQuery("#regcategory").change(function(e){
                e.preventDefault();
                jQuery.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{ route('global.getproductsbycat') }}",
                    data: {'catid' : $(this).val()},
                    success: function (json) { 

                           jQuery("#regproduct").html(json); 
                           $("#regproduct").chosen('destroy');
                           $("#regproduct").chosen(
                                {
                                    no_results_text: "Niets gevonden",                                    
                                });          
                    }, error: function () {
                        //alert("er is iets fout gegaan");
                    }
                });
            });

        jQuery("#region").change(function(e){
                e.preventDefault();
                jQuery.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{ route('global.getcategorybyregion') }}",
                    data: {'regid' : $(this).val()},
                    success: function (json) { 

                           jQuery("#regcategory").html(json); 
                           $("#regcategory").chosen('destroy');
                           $("#regcategory").chosen(
                                {
                                    no_results_text: "Niets gevonden",                                    
                                });          
                    }, error: function () {
                        //alert("er is iets fout gegaan");
                    }
                });
            });

        $("#regcategory").chosen(
                {
                        no_results_text: "Niets gevonden",                        
                });
        $("#region").chosen(
                {
                        no_results_text: "Niets gevonden",                        
                });

  });
</script>
@stop

