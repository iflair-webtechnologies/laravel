@extends('layouts.master')
@section('content')
    @include('includes.account.cart')
    <div id="main">
        @include('includes.back')
        
        @include('includes.menu')
        <?php $regionstring = "";?>
         <section class="section grid no-bar bedrijf-detail edit-info">
        @if (count($errors) > 0)
                    <div class="alert alert-danger">                       
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            <!-- <section class="section no-bar"> -->
            <h2 class="section-title2">Regio & Producten</h2>
            <p>&#8364; 1.00 per product per maand per regio 10.000 inwoners</p>
            <input type="hidden" id="addregionurl" value="{{ route('global.account.insert.addregion') }}">
            <input type="hidden" id="addcategoryurl" value="{{ route('global.account.insert.addcategory') }}">
            <input type="hidden" id="addproducturl" value="{{ route('global.account.insert.addproduct') }}">
            <input type="hidden" id="deleteproducturl" value="<?php echo url('mijn-villato/delete/product'); ?>">
            <input type="hidden" id="deletecategoryurl" value="<?php echo url('mijn-villato/delete/category'); ?>">
              <section class="keuze-blok-wide">
                 <div class="keuze-blok-titels">Regio</div>
                    <div class="keuze-blok-content2">
                        <h2 class="regio-blok-titel">Uw toegevoegde regio</h2>
                         <ul class="info-list2 fa-ul not_user" id="regionlist">                         
                         @foreach($userregions as $key => $value)
                             @if($value->serviceflag == 'free') 
                              <li class="not_user">
                                <i class="fa fa-li fa-check-square-o fa-lg"></i>
                                <span class="regio-var" contenteditable="false" id="{{$value->id}}">{{$value->name}}</span> ({{$value->population}})
                             </li> 
                             @else                                
                            <?php $regionstring .= $value->name.', '?> 
                            <li>
                                <i class="fa fa-li fa-check-square-o fa-lg"></i>
                                <span class="regio-var" contenteditable="false" id="regio">{{$value->name}}</span> ({{$value->population}})
                                <div class="euro"><i class="fa fa-euro fa-2x"></i></div>
                              
                                <a class="delete-button" id="{{$value->id}}" href="{{ route('global.account.delete.region', [$value->id]) }}">
                                        <i class="fa fa-times-circle fa-2x"></i></a>
                              
                            </li>
                            @endif
                             @endforeach  
                         </ul>
                    </div>
                    <div class="keuze-blok-content2">
                    <h2 class="regio-blok-titel">Meer regios toevoegen</h2>
                    <div><label class="regiofilter"> 
                <select id="active-region" name="activeregion">
                <option value="alles" selected>Selecteer extra regio om toe te voegen</option>
                <?php foreach ($regions as $key => $value) {?>
                      <option regionpeople = "<?php echo $value->population; ?>" value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option>                      
                <?php } ?>
                  
                </select>
                </label></div>
                    </div>
                    </section>
               
               <section class="keuze-blok-wide">
                 <div class="keuze-blok-titels">Categorie</div>
                    <div class="keuze-blok-content2">
                    <h2 class="regio-blok-titel">Uw toegevoegde categorie</h2>
                         <ul class="info-list2 fa-ul" id="categorylist">
                           <?php $categorystring = "";?> 
                            @foreach($usercategories as $key => $value)
                            
                              @if($value->serviceflag == 'free')  
                                <li>
                                    <i class="fa fa-li fa-check-square-o fa-lg"></i>
                                    <span class="regio-var" contenteditable="false" id="{{$value->id}}">{{$value->name}}</span> 
                                </li>
                                @else
                                <?php $categorystring .= $value->name.', '?>
                                <li>
                                        <i class="fa fa-li fa-check-square-o fa-lg"></i>
                                        <span class="regio-var" contenteditable="false" id="regio">{{$value->name}}</span>
                                        <div class="euro"><i class="fa fa-euro fa-2x"></i></div>
                                        <a class="delete-button" id="{{$value->id}}" href="{{ route('global.account.delete.category', [$value->id]) }}">
                                        <i class="fa fa-times-circle fa-2x"></i></a>
                                </li> 
                                @endif
                            @endforeach       
                               
                         </ul>
                    </div>
                    <div class="keuze-blok-content2">
                    <h2 class="regio-blok-titel">Meer categorieen toevoegen</h2>
                    <div><label class="regiofilter"> 
                <select name="categorylist" id="active-category">
                <option value="alles" selected>Selecteer extra categorie om toe te voegen</option>
                  <?php foreach ($categories as $key => $value) {?>
                      <option value="<?php echo $value->category_id; ?>"><?php echo $value->name; ?></option>                      
                <?php } ?>
                </select>
                </label></div>
                    </div>
                    </section>
               
               <section class="keuze-blok-wide">
                 <div class="keuze-blok-titels">Producten</div>
                    <div class="keuze-blok-content2">
                    <h2 class="regio-blok-titel">Uw toegevoegde producten</h2>
                     <ul class="info-list2 fa-ul" id="info-productlist" productcount="{{count($userproduct)}}">

                      <?php 
                            $productstring = "";
                            $countproduct = 0;
                            if(count($userproduct)>=1){

                          foreach ($userproduct as $key => $value) {
                            
                        ?>
                        @if($value->serviceflag == 'free')
                        <li><i class="fa fa-li fa-check-square-o fa-lg"></i><span class="regio-var" contenteditable="false" id="regio"><?php echo $value->name; ?></span> </li>
                        @else

                        <?php 
                            $countproduct++;
                            $productstring .= $value->name.", "; ?>
                         <li>
                               <i class="fa fa-li fa-check-square-o fa-lg"></i>
                               <span class="regio-var" contenteditable="false" id="regio">{{$value->name}}</span>
                                 <div class="euro">
                                         <i class="fa fa-euro fa-2x"></i>
                                 </div>
                                 <a class="delete-button" id="{{$value->id}}" href="{{ route('global.account.delete.product', [$value->id]) }}">
                                          <i class="fa fa-times-circle fa-2x"></i>
                                 </a>
                        </li>                        
                        @endif
                      <?php } }else {?>  
                        <li id='emptymsg'><i class="fa fa-li fa-check-square-o fa-lg"></i><span class="regio-var" contenteditable="false" id="regio">No product found</span> </li>
                      <?php } ?>                                                
                        </ul>
                    </div>
                    <div class="keuze-blok-content2">
                    <h2 class="regio-blok-titel">Meer producten toevoegen</h2>
                    <div><label class="regiofilter"> 
                <select id="productlist">
                <option value="alles" selected>Selecteer extra producten om toe te voegen</option>
                   <?php foreach ($products as $key => $value) {?>
                      <option value="<?php echo $value->product_id; ?>"><?php echo $value->name; ?></option>                      
                <?php } ?>
                </select>
                </label></div>
                    </div>
                    </section>
                    
                    <section class="keuze-blok-wide2">
                    <div class="keuze-blok-content3">
                     <ul class="info-list3" id="info-list3">
                     <li>
                        <label>Regio:</label> 
                        <span class="regio-var" contenteditable="false" id="regio">{{ trim($regionstring,', ') }}</span>
                     </li>
                     <li>
                        <label>Categorieen:</label>
                        <span class="regio-var" contenteditable="false" id="categorie">{{ trim($categorystring,', ') }}</span> 
                     </li>
                     <li >
                        <label>Producten:</label> 
                        <span class="regio-var" contenteditable="false" id="payableprolist">{{$countproduct}} producten ({{ rtrim($productstring,', ') }})</span>
                     </li>
                        </ul>
                    </div>
                    <div class="keuze-blok-content4">
                     <ul class="info-list4">
                        <li><label>Subtotaal:</label> &#8364; <span class="price" contenteditable="false" id="subtotalprice"> <?php echo $totalamount; ?></span> pmnd</li>
                        <li><label>Totaal:</label> &#8364; <span class="price" contenteditable="false" id="totalprice"> <?php echo $totalamount;?></span> pmnd</li>
                        </ul>
                    </div>
                    </section>
                    
                    <div class="clearall"></div>
                <div class="save-company-info">
                    <button type="submit" class="button" id="save-company" disabled>Betalen & Opslaan</button>
                </div>
            </section>
            <!-- EINDE 'BEDRIJF DETAIL' -->
        </form>
                   
        </section>
    </div>
@stop
