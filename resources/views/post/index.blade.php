@extends('layouts.app')

@section('title', 'All Posts')

@section('content')
<div class="row">
    <div class="col-8">
    @forelse ($posts as $post)
        <h3>
            @if ($post->trashed())
            <del>
            @endif

            <a class="{{ $post->trashed() ? 'text-muted' : '' }}" href="{{ route('post.show', ['post' => $post->id]) }}">{{ $post->title }}</a>

            @if ($post->trashed())
            </del>
            @endif
        </h3>

        @tags(['tags' => $post->tags])
        @endtags

        @updated(['date' => $post->created_at, 'name' => $post->user->name])
        @endupdated

        @updated(['date' => $post->updated_at])
            Updated
        @endupdated
        
        @if ($post->comments_count)
            @if ($post->comments_count === 1)
            <p>{{ $post->comments_count }} Comment</p>
            @else
            <p>{{ $post->comments_count }} Comments</p>
            @endif
        @else
            <p>No Comments Yet!</p>
        @endif
        
        <div class="mb-3">
        @auth
        @if (!$post->trashed())
            @can('update', $post)
            <a class="btn btn-primary" href="{{ route('post.edit', ['post' => $post->id]) }}">Edit</a>    
            @endcan
            
            @can('delete', $post)
            <form class="d-inline" action="{{ route('post.destroy', ['post' => $post->id]) }}" method="POST">
                @csrf
                @method('DELETE')
                <input class="btn btn-primary" type="submit" name="submit" value="Delete" />
            </form>
            @endcan
        @endif
        @endauth
        </div>
    @empty
        <h1>No Posts Found!</h1>
    @endforelse
    </div>

    <div class="col-4">
        @include('post.partials.activity')
    </div>
</div>
@endsection