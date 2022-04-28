@extends('layouts.app')

@section('title', 'All Posts')

@section('content')
    @forelse ($posts as $key => $post)
        @include('post.partials.post')
    @empty
        <h1>No Posts Found!</h1>
    @endforelse

    <div>
        @php
            $done = false
        @endphp

        @while (!$done)
            <div>I'm not done</div>

            @php
                if(random_int(0,1) === 1) $done = true
            @endphp
        @endwhile
    </div>
@endsection