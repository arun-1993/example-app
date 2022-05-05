@extends('layouts.app')

@section('title', 'Create A Post')

@section('content')
    <form action="{{ route('post.update', ['post' => $post->id]) }}" method="POST">
        @csrf
        @method('PUT')
        @include('post.partials.form')
        <div class="form-group d-grid gap-2">
            <input class="btn btn-primary btn-lg" type="submit" name="submit" value="Update" />
        </div>
    </form>
@endsection