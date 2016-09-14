<div class="popup-vacancy-overlay" id="popup-vacancy-overlay1">
    <div class="form-vacancy">
        <form action="{{ route('global.account.create.advertisement') }}" method="post" enctype="multipart/form-data" id="addvtform">
            <div class="form-vacancy-header">
                <h3>New advertisement</h3>
                <i class="form-vacancy-close fa fa-close"></i>
            </div>

            <div class="form-vacancy-content">
                <div class="form-vacancy-left">
                    <input type="text" name="name"  id="name" placeholder="Functietitel*" required>
                    <textarea name="content" id="contentadd" rows="3" placeholder="Korte omschrijving*"  maxlength="150" required></textarea>
                    <input type="file" id="image" name="image" class="form-control"/>

                </div>
                <!-- <div class="form-vacancy-right">
                    <input type="email" name="email" value="" id="email" placeholder="Sollicitatie e-mailadres">
                    <input type="text" name="education" value="" id="education" placeholder="Opleidingsniveau">
                    <input type="text" name="duration" value="" id="duration" placeholder="Contract duur">
                    <input type="number" name="hours" value="" id="hours" placeholder="Aantal uren">
                </div> -->
            </div>

            <div class="form-vacancy-footer">
                <input type="hidden" name="category" id="addcategory">
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        <input type="hidden" name="company_id" value="<?php echo Auth::user()->id; ?>">
                <button type="submit" class="button" id="submit-vacancynn">Save</button>
            </div>
        </form>
    </div>
</div>
<script>
        $(document).ready(function() {
            CKEDITOR.replace( 'contentadd' );
            CKEDITOR.config.extraAllowedContent = 'div(*)';

             $('.form-vacancy-close').click(function(){
                $("#popup-vacancy-overlay1").hide();
            });
            jQuery("#vacancy-item-list a").click(function(){
                $("#popup-vacancy-overlay1").show();
              //  alert($(this).attr('id'));
                jQuery('#addcategory').val($(this).attr('id'));
            });

            
        });
    </script>

