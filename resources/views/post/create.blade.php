@extends('layouts.app')

@section('title', 'Create A Post')

@section('content')
    <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('post.partials.form')
        <div class="form-group d-grid gap-2">
            <input class="btn btn-primary btn-lg" type="submit" name="submit" value="Create" />
        </div>
    </form>
@endsection