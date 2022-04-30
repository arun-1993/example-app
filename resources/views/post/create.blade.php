@extends('layouts.app')

@section('title', 'Create A Post')

@section('content')
    <form action="{{ route('post.store') }}" method="POST">
        @csrf
        <div>
            <input type="text" name="title" value="{{ old('title') }}" />
        </div>
        @error('title')
            <div>{{ $message }}</div>
        @enderror
        <div>
            <textarea name="content">{{ old('content') }}</textarea>
        </div>

        @if ($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div>
            <input type="submit" name="submit" value="Create" />
        </div>
    </form>
@endsection