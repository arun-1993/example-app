@extends('layouts.app')

@section('title', 'Contact')

@section('content')
<h1>Welcome to Contact!</h1>
<p>This is the content of the contact page.</p>

@can('home.secret')
<p><a href="{{ route('home.secret') }}">Go to special contact details</a></p>
@endcan

@endsection