<div class="news-detail nieuws">
    <h3>{{ $advt->name }}</h3>
    <a >
        <div class="content-foto">
            <div class="content-foto-foto">
            <?php $imagepath = Villato\Advertisement::find($advt->id)->image;?>
                 <img src="{{ $imagepath }}" alt="{{$advt->name }}">                    
            </div>
        </div>
    </a>

    <div class="content-info">
    <?php  $companyslug = Villato\Company::select('slug')->where('id','=',$advt->company_id)->get();
         
    // $slug =  json_decode($companyslug);
    // var_dump($slug); 
        ?>
        <p>{{ str_limit(strip_tags($advt->content), 200) }}</p>
        <a href="<?php echo url($companyslug[0]->slug.'/advertisement/'.$advt->id);?>">Lees het
            hele bericht</a>
            
    </div>
</div>
