@extends('layouts.app')

@section('title', 'All Posts')

@section('content')
    @forelse ($posts as $key => $post)
        @include('post.partials.post')
    @empty
        <h1>No Posts Found!</h1>
    @endforelse
@endsection