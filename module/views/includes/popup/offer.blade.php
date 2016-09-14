<div class="popup-offer-overlay">
    <div class="form-offer">
        <form updateaction="{{ route('global.account.update.offer') }}"
              createaction="{{ route('global.account.create.offer') }}" method="post">
            <div class="form-offer-header">
                <h3>Aanbieding toevoegen</h3>
                <i class="form-offer-close fa fa-close"></i>
            </div>

            <div class="form-offer-content">
                <div class="form-offer-left">
                    <input type="text" name="title" id="title" placeholder="Titel aanbieding*" required>
                    <textarea name="description" id="description" rows="3" placeholder="Korte omschrijving*" maxlength="150" required></textarea>
                    <textarea name="content" id="content" rows="6" placeholder="Bericht*" required></textarea>
                </div>
                <div class="form-offer-right">
                    <script type="text/javascript">
                        $(function()
                        {
                            $("#offer-image").change(function(e)
                            {
                                if (this.files &&
                                        this.files[0])
                                {
                                    var reader = new FileReader();
                                    reader.onload = function(e)
                                    {
                                        $(".offer-image").css("backgroundImage", "url(" + e.target.result + ")");
                                    };
                                    reader.readAsDataURL(this.files[0]);
                                }
                            });
                        });
                    </script>
                    <div class="offer-image">
                        <label for="offer-image" class="offer-image-icon">
                            <img src="{{ asset('images/aanmeld-pagina/plus.png') }}" alt="foto toevoegen">
                        </label>
                    </div>
                    <input type="file" accept="image/*" name="image" id="offer-image" style="display:none">
                </div>
            </div>

            <div class="form-offer-footer">
                <button type="submit" name="submit_offer" class="button" id="submit-offer">Opslaan</button>
            </div>
        </form>
    </div>
</div>