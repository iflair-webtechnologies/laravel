@extends('layouts.master')
@section('content')
    @include('includes.account.cart')
    <div class="main2">
     @if (count($errors) > 0)
                <div class="alert alert-danger">

                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        @include('includes.back')
        @include('includes.menu')
       <section class="section no-bar bedrijf-detail edit-info " >
            <h2 class="section-title2">Voeg een vacature, nieuwsbericht en aanbieding toe!</h2>
            <div class="content">
                <p>Op deze pagina kunt u uzelf profileren door nieuwsberichten, vacatures en of aanbiedingen te plaatsen.
Om onze website actueel te houden worden aanbiedingen en vacatures 1 maand geplaatst, u kunt deze daarna wel kostenloos verlengen. U ontvangt een e-mail.</p>

<p>Nieuwsberichten blijven 3 maanden staan, waarna u kan aangeven of u ze kostenloos langer wilt plaatsen met weer 3 maanden. U ontvangt een e-mail.</p>

<p>U kunt 1 nieuwsbericht + 1 vacature + 1 aanbieding gratis plaatsen. Meer berichten kosten 1 euro per bericht per maand per 10.000 inwoners.</p>
            </div>
            <div class="keuze-blokken inner_blocks" id="main1">
            <?php foreach ($Categoryadvt as $key => $value) {
                if($key%2 != 0){
        $clrstring = 'vacature';

    }else if($key%3 != 0){

        $clrstring = 'aanbieding';
    }else {
        $clrstring = 'nieuws';
    }
                ?>

               
            
                <section class="keuze-blok-groot grid  <?php echo $clrstring;?>">
                    <div class="keuze-blok-titel-vacature"><?php echo $value->name; ?></div>
                    <ul id="vacancy-item-list">
                            <li>
                                <a href="javascript:" class="add-vacancy" id="<?php echo $value->id; ?>">
                                   New <?php echo $value->name; ?>
                                    <div class="vacancy-options" >
                                        <i class="fa fa-plus-circle fa-2x"></i> 
                                         <img class="potlood" src="<?php //echo url().'/images/mijn-villato/potloodje.png'; ?>"  alt=""/>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    <div class="keuze-blok-content">
             <?php foreach ($value->advertisement as $subkey => $subvalue) {

                $imagepath = Villato\Advertisement::find($subvalue->id)->image;

                ?>  
                <div class="rowone">
              <?php if(!empty($imagepath)) { ?>   
                        <div class="advertentie-foto-thumb" id='<?php echo $subvalue->id; ?>'>                   
                                <img src="<?php echo $imagepath; ?>" alt="geen foto beschikbaar"   />   
                         </div>       
                 <?php } else { ?>

                        <div class="advertentie-foto-thumb" id="noimage">
                                <img src="<?php echo url().'/images/no_image.jpg'; ?>" alt="geen foto beschikbaar"    />   
                        </div>

                <?php } ?>    
            

                 <?php if ($subvalue->company_id == Auth::user()->id) {
                        # code...
                     ?>
                <ul class="info-list" id=<?php  echo $subvalue->id?>>
                    <li>                   
                     <span class="news-title" id="<?php echo $subvalue->company_id ?>" contenteditable="true" id="news"><?php echo $subvalue->name; ?></span>
                    </li>
                        </ul>
                         <?php }else{?>
                            <ul class="info-list not_user" id=<?php  echo $subvalue->id?>>
                            <li class='not_user'>                   
                                <span class="news-title" id="<?php echo $subvalue->company_id ?>" contenteditable="false" id="news"><?php echo $subvalue->name; ?></span>
                            </li>
                             </ul>

                        <?php }?>
            
            <div class="textarea">  
            <?php if ($subvalue->company_id != Auth::user()->id) { ?>
                <div style="text-align:justify"><?php echo trim(strip_tags($subvalue->content)) ; ?></div>
                 <?php }else{?>
                 	<textarea name="vacancy" id="vacancy" placeholder="Laatste nieuws (verplicht)"><?php echo trim(strip_tags($subvalue->content)) ; ?></textarea>
                 	<?php }?>
                <?php 
                       $company = Villato\Company::where('id','=',$subvalue->company_id)->get();                       
                ?>
                <h4><span>Name:</span> <?php echo $company[0]->name ?></h4>
                <h4><span>Email:</span> <a href="mailto:<?php echo $company[0]->email; ?>"><?php echo $company[0]->email; ?></a></h4>
            </div>
            </div>

            <?php }?>
            <div class="keuze-blok-zoeken">
            </div>
                </section>

                <?php } ?>
                <div class="clearb"></div>
                
                                <!-- <section class="keuze-blok-groot">
                    <div class="keuze-blok-titel-nieuws">Nieuws</div>
                    <div class="keuze-blok-content">
                        <ul id="news-item-list">
                                                        <li>
                                <a href="javascript:" class="add-news">
                                    Nieuwe nieuwsbericht
                                    <div class="news-options">
                                    <i class="fa fa-plus-circle fa-2x"></i> <img class="potlood" src="images/mijn-villato/potloodje.png" width="15" height="15" alt=""/>
                                    </div>
                                </a>
                            </li>
                        </ul>
                           
   <div class="advertentie-foto-thumb">
      <img src="http://www.villato.nl/images/no_image.jpg" alt="geen foto beschikbaar" />
        </div>
            <div>
                <ul class="info-list">
                    <li><span class="news-title" contenteditable="true" id="news">Title nieuwsbericht</span></li>
                        </ul></div>
                      <div class="textarea">  <textarea name="news" id="news" placeholder="Laatste nieuws (verplicht)">Type hier uw tekst (maximaal 25 woorden)</textarea>
                        </div>
                    <div class="keuze-blok-zoeken">
                    
                    </div>
                </section>
                
                                <section class="keuze-blok-groot">
                    <div class="keuze-blok-titel-aanbieding">Aanbiedingen</div>
                    <div class="keuze-blok-content">
                        <ul id="offer-item-list">
                                                        <li>
                                <a href="javascript:" class="add-offer">
                                    Nieuwe aanbieding
                                    <div class="offer-options">
                                    <i class="fa fa-plus-circle fa-2x"></i> <img class="potlood" src="images/mijn-villato/potloodje.png" width="15" height="15" alt=""/>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    <div class="advertentie-foto-thumb">
      <img src="<?php echo url(); ?>/images/no_image.jpg" alt="geen foto beschikbaar" />
        </div>
            <div>
                <ul class="info-list">
                    <li><span class="news-title" contenteditable="true" id="news">Title aanbieding</span></li>
                        </ul></div>
                      <div class="textarea">  <textarea name="news" id="news" placeholder="Laatste nieuws (verplicht)">Type hier uw tekst (maximaal 25 woorden)</textarea>
                        </div>
                    <div class="keuze-blok-zoeken">
                    </div>
                </section>
                            </div>

            <div class="clearall"></div>
                <div class="save-company-info">
                    <button type="submit" class="button" id="save-company" disabled>Opslaan</button>
                </div>
            </section> -->
            
        </form>
        </section>  

    </div>

    @include('includes.popup.updatevacancy') 
    @include('includes.popup.vacancy')           
@stop


