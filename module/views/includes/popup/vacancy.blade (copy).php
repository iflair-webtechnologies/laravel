<div class="popup-vacancy-overlay">
    <div class="form-vacancy">
        <form updateaction="{{ route('global.account.update.vacancy') }}"
              createaction="{{ route('global.account.create.vacancy') }}" method="post">
            <div class="form-vacancy-header">
                <h3>Vacature toevoegen</h3>
                <i class="form-vacancy-close fa fa-close"></i>
            </div>

            <div class="form-vacancy-content">
                <div class="form-vacancy-left">
                    <input type="text" name="title" value="" id="title" placeholder="Functietitel*" required>
                    <textarea name="description" id="description" rows="3" placeholder="Korte omschrijving*" maxlength="150" required></textarea>
                    <textarea name="function_description" id="function_description" rows="6"
                              placeholder="Functie omschrijving*" required></textarea>
                </div>
                <div class="form-vacancy-right">
                    <input type="email" name="email" value="" id="email" placeholder="Sollicitatie e-mailadres">
                    <input type="text" name="education" value="" id="education" placeholder="Opleidingsniveau">
                    <input type="text" name="duration" value="" id="duration" placeholder="Contract duur">
                    <input type="number" name="hours" value="" id="hours" placeholder="Aantal uren">
                </div>
            </div>

            <div class="form-vacancy-footer">
                <button type="submit" class="button" id="submit-vacancy">Opslaan</button>
            </div>
        </form>
    </div>
</div>

