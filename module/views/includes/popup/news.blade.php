<div class="popup-news-overlay">
    <div class="form-news">
        <form updateaction="{{ route('global.account.update.news') }}"
              createaction="{{ route('global.account.create.news') }}" method="post">
            <div class="form-news-header">
                <h3>Nieuwsbericht toevoegen</h3>
                <i class="form-news-close fa fa-close"></i>
            </div>

            <div class="form-news-content">
                <div class="form-news-left">
                    <input type="text" name="title" id="title" placeholder="Nieuwstitel*" required>
                    <textarea name="description" id="description" rows="3" placeholder="Korte omschrijving*"
                              maxlength="150" required></textarea>
                    <textarea name="content" id="content" rows="6" placeholder="Bericht*" required></textarea>
                </div>
                <div class="form-news-right">
                    <script type="text/javascript">
                        $(function () {
                            $('#news-image').change(function (e) {
                                if (this.files && this.files[0]) {
                                    var reader = new FileReader();
                                    reader.onload = function (e) {
                                        $(".news-image").css("backgroundImage", "url(" + e.target.result + ")");
                                    };
                                    reader.readAsDataURL(this.files[0]);
                                }
                            });
                        });
                    </script>
                    <div class="news-image">
                        <label for="news-image" class="news-image-icon">
                            <img src="{{ asset('images/aanmeld-pagina/plus.png') }}" alt="foto toevoegen">
                        </label>
                    </div>
                    <input type="file" accept="image/*" name="image" id="news-image" style="display:none">
                </div>
            </div>

            <div class="form-news-footer">
                <button type="submit" class="button" id="submit-news">Opslaan</button>
            </div>
        </form>
    </div>
</div>