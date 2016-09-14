<div class="popup-vacancy-overlay">
    <div class="form-vacancy">
        <form action="{{ route('global.account.create.updateadvertisement') }}" method="post" enctype="multipart/form-data" id="addvtform">
            <div class="form-vacancy-header">
                <h3>New advertisement</h3>
                <i class="form-vacancy-close fa fa-close"></i>
            </div>

            <div class="form-vacancy-content">
                <div class="form-vacancy-left">
                    <input type="text" name="name" value="" id="name" placeholder="Functietitel*" required>
                    <textarea name="content" id="content" rows="3" placeholder="Korte omschrijving*" maxlength="150" required></textarea>
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
                <input type="hidden" name="category" id="category">
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        <input type="hidden" name="company_id" value="<?php echo Auth::user()->id; ?>">
                <button type="submit" class="button" id="submit-vacancynn">Save</button>
            </div>
        </form>
    </div>
</div>
<script>
        $(document).ready(function() {
            jQuery("#vacancy-item-list a").click(function(){
                jQuery('#category').val($(this).attr('id'));
            });
            jQuery(".info-list").click(function(){
                $("html").addClass("popup-vacancy-lock");
                jQuery('#addvtform').attr('action', '<?php echo route('global.account.create.updateadvertisement') ?>');
                
                jQuery("#name").attr('value',jQuery(this).find("span").text());         
                // jQuery("#name").val(jQuery(this).find("span").text());         

            });
        });
    </script>

