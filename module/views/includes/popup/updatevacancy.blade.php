<div class="popup-vacancy-overlay" id="popup-vacancy-overlay">
    <div class="form-vacancy">
        <form action="{{ route('global.account.update.advertisement') }}" method="post" enctype="multipart/form-data" id="editadvt">
            <div class="form-vacancy-header">
                <h3>Edit advertisement</h3>
                <i class="form-vacancy-close fa fa-close"></i>
            </div>

            <div class="form-vacancy-content">
                <div class="form-vacancy-left">
                    <input type="text" name="name" value="" id="namecat" placeholder="Functietitel*" required>
                    <textarea name="content" id="content" rows="3" placeholder="Korte omschrijving*" maxlength="150" required></textarea>
                    <input type="file" id="editimage" name="image" class="form-control"/>
                    <img src="" height='50px' width='50px' id="advtimage">
                     <a href="javascript:;" class="btn btn-default" id='removeimg'>Remove</a>

                </div>
                <!-- <div class="form-vacancy-right">
                    <input type="email" name="email" value="" id="email" placeholder="Sollicitatie e-mailadres">
                    <input type="text" name="education" value="" id="education" placeholder="Opleidingsniveau">
                    <input type="text" name="duration" value="" id="duration" placeholder="Contract duur">
                    <input type="number" name="hours" value="" id="hours" placeholder="Aantal uren">
                </div> -->
            </div>

            <div class="form-vacancy-footer">
                <input type="hidden" name="category" value="5">
                <input type="hidden" name="advtid" id="advtid">
                <input type="hidden" name="imgstatus" id="imgstatus" value="">
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                <input type="hidden" name="company_id" value="<?php echo Auth::user()->id;?>">
                <button type="submit" class="button" id="submit-vacancyin">Save</button>
            </div>
        </form>
    </div>
</div>

<script>
        $(document).ready(function() {
            

            $('.form-vacancy-close').click(function(){
                $("#popup-vacancy-overlay").hide();
            });
            
            jQuery(".info-list").click(function(){
               var editable = jQuery(this).find('.news-title').attr('contenteditable'); 
               var company_id = jQuery(this).find('.news-title').attr('id'); 

               if(editable == 'true' && company_id == <?php echo Auth::user()->id; ?>){                
                      $("#popup-vacancy-overlay").show();
                      jQuery('#advtid').val(jQuery(this).attr('id'));
                      jQuery('#imgstatus').val(jQuery(this).prev('.advertentie-foto-thumb').attr('id'));
                      jQuery("#content").text(jQuery(this).next(".textarea").find('textarea').val());
                      jQuery("#namecat").attr('value',jQuery(this).find("span").text());
                      jQuery('#advtimage').attr('src',jQuery(this).prev('.advertentie-foto-thumb').find('img').attr('src'));
                      CKEDITOR.replace( 'content' );
                      CKEDITOR.config.extraAllowedContent = 'div(*)';   
                }
            });

            jQuery('#removeimg').click(function () {           
                jQuery(this).prev('#advtimage').remove();
                jQuery('#imgstatus').val('noimage');

            });
        });
    </script>