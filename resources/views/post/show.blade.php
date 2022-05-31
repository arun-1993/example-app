@extends('layouts.app')

@section('title', $post->title)

@section('content')
<div class="row">
    <div class="col-8">
        <h1>
            {{ $post->title }}

            @badge(['show' => now()->diffInMinutes($post->created_at) < 10080])
                New!
            @endbadge
        </h1>

        @tags(['tags' => $post->tags])
        @endtags

        <p>{{ $post->content }}</p>
        
        @updated(['date' => $post->created_at, 'name' => $post->user->name])
        @endupdated

        @updated(['date' => $post->updated_at])
        Updated
        @endupdated

        <p>Currently being read by {{ $counter }} {{ $counter == 1 ? 'person' : 'people' }}.</p>

        <h4>Comments</h4>
        
        @include('comments._form')

        @forelse ($post->comments as $comment)
            <p>{{ $comment->content }}</p>
            
            @updated(['date' => $comment->created_at, 'name' => $comment->user->name])
            @endupdated
        @empty
            <p>No Comments Yet!</p>
        @endforelse
    </div>

    <div class="col-4">
        @include('post.partials.activity');
    </div>
</div>
@endsection