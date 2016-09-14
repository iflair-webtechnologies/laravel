@extends('emails.layouts.master')

@section('content')
    <a href="mailto: {{ $email }}"> {{ $name }} &lt;{{ $email }}&gt;</a> schreef het volgende:<br/>
    <br/>
    {{ $comment }}
@stop