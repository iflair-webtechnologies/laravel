@extends('layouts.master')
@section('content')
    @include('includes.account.cart')
    <div id="main">
        @include('includes.back')
        @include('includes.menu')
         <section class="section grid no-bar bedrijf-detail edit-info">
            <!-- <section class="section no-bar"> -->
            <h2 class="section-title2">Saldo</h2>
            <p>Hier vindt u informatie over uw factuur of VILLATO rekening: eerdere transacties, uw actuele kredietlimiet en uw openstaande saldo. <br/ > Voor vragen kunt u contact opnemen met de Klantenservice op telefoon 0413 XXXXXX.</p>
            
           <section class="keuze-blok-wide">
                    <div class="keuze-blok-content5">
                     <ul class="info-list6">
                     <li><label>Uw huidige periode:</label> <span class="regio-var" contenteditable="true" id="periode">6 maanden</span> </li>
                      <li><label>Uw huidige betaalwijze:</label> <span class="regio-var" contenteditable="true" id="betaalwijze">per maand</span> </li>
                      <li><label>Uw huidige saldo is:</label> &#8364; <span class="regio-var" contenteditable="true" id="saldo">120.00</span> </li>
                      <li><label>Maandelijkse betaling:</label> &#8364; <span class="regio-var" contenteditable="true" id="price">6.00</span> </li>
                        </ul>
                    </div>
                    </section>
                    
                     <section class="keuze-blok-wide">
                     <div class="keuze-blok-titels2">Overschrijvingen</div>
                     <div class="keuze-blok-content6">
                    <h2 class="regio-blok-titel">Datum</h2>
                    </div>
                    <div class="keuze-blok-content6">
                    <h2 class="regio-blok-titel">Omschrijving</h2>
                    </div>
                    <div class="keuze-blok-content6">
                    <h2 class="regio-blok-titel">Bedrag (&#8364;)</h2>
                     </div>
                     </section>
                     <section class="keuze-blok-wide">
                     <ul class="overschrijvingen">
                     <li><div class="datum"><span id="datum">05-10-2015</span></div> <div class="omschrijving">Betaling <br/ >boekingsnummer <span id="boekingsnummer">32034511</span></div> <div class="bedrag">- 6.00</span></div></li>
                     <li><div class="datum"><span id="datum">05-09-2015</span></div> <div class="omschrijving">Betaling <br/ >boekingsnummer <span id="boekingsnummer">32017584</span></div> <div class="bedrag">- 6.00</span></div></li>
                     </ul>
                     <div class="clearall"></div>
                <div class="save-company-info">
                    <button type="submit" class="button" id="save-company" disabled>Alle overschrijvingen</button>
                </div>
                     </section>
                     
                     <section class="keuze-blok-wide">
                    <form action="{{ route('global.account.checkideal') }}" method="post" >
                 <div class="keuze-blok-titels2">Periode aanpassen</div>
                  
                    <div class="keuze-blok-content2">
                    <h2 class="regio-blok-titel">Kies de gewenste periode</h2>
                     
                <input type="radio" name="periode" value="6maanden" checked> 6 maanden
                <input type="radio" name="periode" value="1jaar"> 1 jaar
                <input type="radio" name="periode" value="3jaren">  3 jaren*
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    </div>
                    <div class="keuze-blok-content2">
                    <h2 class="regio-blok-titel"></h2>
                    <p style="padding-top:27px;">* Als u kiest voor een periode van 3 jaar, dan ontvangt u 20% korting</p>
                    <div class="save-company-info2">
                    <button type="submit" class="button" id="save-company" disabled>Opslaan</button>
                </div></div>
                 </form> 
                    </section>
                    
                    <section class="keuze-blok-wide">
                 <div class="keuze-blok-titels2">Betaalwijze aanpassen</div>
                    <div class="keuze-blok-content2">
                    <h2 class="regio-blok-titel">Kies de gewenste betaalwijze</h2>
                      <form>
                          <input type="radio" name="betaalwijze" value="6maanden" checked> per maand
                          <input type="radio" name="betaalwijze" value="1jaar"> per kwartaal
                          <input type="radio" name="betaalwijze" value="3jaren">  per jaar
                    </form> 
                    </div>
                    <div class="keuze-blok-content2">
                    <h2 class="regio-blok-titel"></h2>
                    <p style="padding-top:27px;"> </p>
                    <div class="save-company-info">
                    <button type="submit" class="button" id="save-company" disabled>Opslaan</button>
                </div></div>
                    </section>
                    <section class="keuze-blok-wide">
                 <div class="keuze-blok-titels2">Saldo verhogen met iDEAL <img src="<?php echo url(); ?>/images/ideal_logo.png" alt=""/></div>
                    <div class="keuze-blok-content3">
                    <p style="margin-left:20px;">Vul de gewenste bedrag in, selecteer uw bank en klik op "Naar mijn bank".</p>
                    </div>
                    <div class="keuze-blok-content8">
                    <div>
                    <form id="saldos">
  &#8364; <input type="text" name="euro"> , 
  <input type="text" name="cent">
</form> 
                    </div>
                    </div>
                    
                    <div class="keuze-blok-content8">
                     <div><label class="bankfilter"> 
                <select>
                <option value="select" selected>SELECTEER UW BANK ...</option>
                  <option value="ing">ING</option>
                  <option value="abnamro">ABN AMRO</option>
                  <option value="rabobank">RABOBANK</option>
                </select>
                </label></div>
                    </div>
                    
                    <div class="keuze-blok-content7">
                    <div class="save-company-info3">
                    <button type="submit" class="button" id="checkout" disabled>NAAR MIJN BANK</button>
                </div></div>
                    </section>
                    
<div class="clearall"></div>
                
            </section>
            <!-- EINDE 'BEDRIJF DETAIL' -->
        </form>
        </section>
       

       
       

    </div>
@stop

