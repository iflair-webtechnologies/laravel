@extends('layouts.master')
@section('content')
    @include('includes.account.cart')
    <div id="main">
        @include('includes.back')
        @include('includes.menu')
         <section class="section grid no-bar bedrijf-detail edit-info">
            <!-- <section class="section no-bar"> -->
            <h2 class="section-title2">Pas hier uw wachtwoord aan</h2>
            <p>Als u inlogt met een door ons aangemaakt wachtwoord raden wij u sterk aan deze aan te passen voor de veiligheid van uw account.</p>
            <form action="{{ route('global.account.update.password') }}" method="post" class="reset-password" id="form-password">
                <div class="form-group">
                    <input type="password" name="password_current" class="form-control" id="password_current"
                           placeholder="Huidig wachtwoord" required>
                </div>
                <div class="form-group">
                    <input type="password" name="password" id="password" class="form-control"
                           placeholder="Nieuw wachtwoord" required minlength="8">
                </div>
                <div class="form-group">
                    <input type="password" name="password_confirmation" class="form-control" id="password_confirmation"
                           placeholder="Herhaal nieuw wachtwoord" required>
                </div>
                <button type="submit" name="submit_change_password" id="submit-change-password" class="button">Opslaan</button>
            </form>

        </section>
       

       
       

    </div>
@stop

