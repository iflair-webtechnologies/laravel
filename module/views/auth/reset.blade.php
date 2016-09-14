@extends('layouts.master')

@section('content')
    <div id="main">
        @include('includes.back')
        <!-- START LOGIN -->
        <section class="section grid no-bar een-kolom">
            <h2 class="section-title">Wachtwoord vergeten?</h2>
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form class="inloggegevens" action="{{ route('global.password.email') }}" method="post">
                <input type="email" name="email" placeholder="Email" required="">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button type="submit" name="password-recovery" class="button" id="login">Wachtwoord Opvragen</button>
            </form>
        </section>
        <!-- EINDE LOGIN -->
    </div>
@stop
