@extends('emails.layouts.master')

@section('content')
    Op schreef u &lt; {{ $name }} ({{ $email }}) &gt; het volgende in het Villato feedback formulier.:<br/>
    <br/>
    {{ $comment }}
@stop