@extends('layouts.master')
@section('content')
    @include('includes.account.cart')
    <div id="main">
        @include('includes.back')
        @include('includes.menu')
         <form  action="{{ route('global.account.update.company') }}" method="post" enctype="multipart/form-data" id="form-company">
            <!-- START 'BEDRIJF DETAIL' -->
            <section class="section grid no-bar bedrijf-detail edit-info">
                <h2 class="section-title company_name">
                    <span contenteditable="false" id="name">{{ $company->name }}</span>
                    <a class="potloodje" href=""></a>
                </h2>
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
                    <textarea name="info" id="info" placeholder="Korte beschrijving (verplicht)"> <?php echo ($company->info)?$company->info:'NA'; ?></textarea>
                        <div class="info-unique-content">
                            <div class="info-button-unique-content"></div>
                            <div class="info-box-unique-content">Unieke content is beter voor uw vindbaarheid in Google!</div>
                        </div>
                    </div>

                    <ul class="info-list fa-ul">
                        <li>
                            <i class="fa fa-li fa-phone fa-lg"></i><span class="telefoon-nummer" contenteditable="true" id="phone"><?php echo ($company->phone)?$company->phone:'NA';?></span>
                        </li>
                        <li>
                            <i class="fa fa-li fa-mobile fa-lg"></i><span class="mobiel-nummer" contenteditable="true" id="mobile"> <?php echo ($company->mobile)?$company->mobile:'NA';?></span>
                        </li>
                        <li>
                            <i class="fa fa-li fa-map-marker fa-lg"></i><span class="street" contenteditable="true" id="street"><?php echo ($company->street)?$company->street:'NA';?></span>, <span class="postal_code" contenteditable="true" id="postal_code"><?php echo ($company->postal_code)?$company->postal_code:'NA';?></span>
                        </li>
                        <li>
                            <i class="fa fa-li fa-globe fa-lg"></i>
                            <span class="url-edit" contenteditable="true" id="website"><?php echo ($company->website)?$company->website:'NA';?></span>
                        </li>
                        <li>
                            <i class="fa fa-li fa-facebook-square fa-lg"></i><span class="fb-edit" contenteditable="true" id="facebook"><?php echo ($company->facebook)?$company->facebook:'NA';?></span>
                        </li>
                    </ul>
                    <div class="foto-beheer" id="foto-beheer">
                        <input type="file" id="image-1" name="image[1]" accept="image/*">
                        <input type="file" id="image-2" name="image[2]" accept="image/*">
                        <input type="file" id="image-3" name="image[3]" accept="image/*">
                        <input type="file" id="image-4" name="image[4]" accept="image/*">
                     </div>
                   
                </div><!-- /.content-detail -->

                
            <div class="clearall"></div>
                <div class="extra-info">
                    <textarea name="extra_info" class="more-info" rows="6" placeholder="Geef hier uw extra bedrijfsinformatie op"><?php echo ($company->extra_info)?$company->extra_info:'NA';?></textarea>
                    <div class="info-unique-content">
                        <div class="info-button-unique-content"></div>
                        <div class="info-box-unique-content">Unieke content is beter voor uw vindbaarheid in Google!</div>
                    </div>
                </div>
<div class="regio-detail">
<ul class="info-list">
             <li>
                <label>REGIO</label>
                    <span class="regio-detail-result">{{$userregions}}</span>
                     <span class="add-button">
                        <a href="{{ route('global.account.productregion') }}"><i class="fa fa-plus-circle fa-2x"></i></a>
                   </span>
             </li>
             <li><label>Categorie</label> 
               <span class="regio-detail-result">{{$usercategory}}</span> 
                <span class="add-button"><a href="{{ route('global.account.productregion') }}">
                <i class="fa fa-plus-circle fa-2x"></i></a>
                </span>
             </li>
             <li><label>Producten</label> <span class="regio-detail-result">{{$userproduct}}</span> <span class="add-button"><a href="{{ route('global.account.productregion') }}"><i class="fa fa-plus-circle fa-2x"></i></a></span></li> 
             <li><label>Periode</label> <span class="regio-detail-result">6 maanden</span> <span class="add-button"><a href="{{ route('global.account.balance') }}"><i class="fa fa-plus-circle fa-2x"></i></a></span></li> 
                    </ul>
                    
    <ul class="info-list">
             <li><label>Vacatures</label> <span class="regio-detail-result">Title of placed Vacature (vacancy)</span> <span class="add-button"><a href="{{ route('global.account.accountadvt') }}"><i class="fa fa-plus-circle fa-2x"></i></a></span></li>
             <li><label>Nieuws</label> <span class="regio-detail-result">Title of placed Nieuws (news)</span> <span class="add-button"><a href="{{ route('global.account.accountadvt') }}"><i class="fa fa-plus-circle fa-2x"></i></a></span></li>
             <li><label>Aanbiedingen</label> <span class="regio-detail-result">Title of placed Aanbiedingen (sale product)</span> <span class="add-button"><a href="{{ route('global.account.accountadvt') }}"><i class="fa fa-plus-circle fa-2x"></i></a></span></li> 
                    </ul>
                    
                    </div>
               <!-- <label for="newsletter" class="block">
                    <input type="checkbox" name="newsletter" value="1" checked>
                    <span class="label">Aanmelden voor de nieuwsbrief van Villato</span><br>
                    <span class="dim">Hierbij blijft u op de hoogte van de wijzigingen die wij maken op Villato.</span>
                </label> -->
                <div class="clearall"></div>
                <div class="save-company-info">
                    <button type="submit" class="button" id="save-company" disabled>Opslaan</button>
                </div>
            </section>
            <!-- EINDE 'BEDRIJF DETAIL' -->
        </form>
       

       
       

    </div>
@stop

