 @if(!$advertisements->isEmpty())
 <?php foreach ($advertisements as $key => $value) { 

 	if($key%2 != 0){
 		$clrstring = 'vacature';

 	}else if($key%3 != 0){

 		$clrstring = 'aanbieding';
 	}else {
 		$clrstring = 'nieuws';
 	}
 	?>

<section class="section grid no-bar <?php echo $clrstring;?>" >   
                <h2 class="section-title"><?php echo $value->name; ?></h2>      
                <div class="news">
                        @include('includes.advtitem', ['advt' => $value->advertisement->first()])
                </div>
    
</section>
<?php } ?>   
  
@else
<section class="section grid no-bar vacature"> 
    <p>Er zijn momenteel geen vacatures beschikbaar.</p>
</section>
@endif

<style type="text/css">
.section.grid.no-bar .nieuws::before, .section.grid.no-bar .nieuws-homepage::before{
	display: none
}

</style>