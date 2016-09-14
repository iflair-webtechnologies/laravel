@extends('layouts.master')

@section('content')
    <div id="main">
        @include('includes.back')
        <!-- START LOGIN -->
        <section class="section grid no-bar een-kolom">
            <h2 class="section-title">Inloggen</h2>
           
            @if (count($errors) > 0)
                <div class="alert alert-danger">

                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class="inloggegevens" action="{{ route('global.login') }}" method="post">
                <input type="email" name="email" placeholder="Gebruikersnaam (email)" value="{{ old('email') }}">
                <input type="password" name="password" placeholder="Wachtwoord" required>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <label>
                    <input type="checkbox" name="remember"> Remember Me
                </label>
                <button type="submit" class="button" id="login">Inloggen</button>
            </form>

            <a id="forgot-password" href="{{ route('global.password.email') }}">Wachtwoord vergeten?</a>
        </section>
        <!-- EINDE LOGIN -->
    </div>
@stop
