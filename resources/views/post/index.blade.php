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
        </div>
    @empty
        <h1>No Posts Found!</h1>
    @endforelse
    </div>

    <div class="col-4">
        <div class="row">
            @card(['title' => 'Most Commented Posts'])
                @slot('subtitle', 'What people are talking about')

                @slot('items')
                    @foreach ($mostCommented as $post)
                    <li class="list-group-item">
                        <a href="{{ route('post.show', ['post' => $post->id]) }}">{{ $post->title }}</a>
                    </li>
                    @endforeach
                @endslot
            @endcard
        </div>

        <div class="row mt-5">
            @card(['title' => 'Most Active Users'])
                @slot('subtitle', 'Users with most posts written')
                @slot('items', collect($mostActive)->pluck('name'))
            @endcard
        </div>

        <div class="row mt-5">
            @card(['title' => 'Most Active Users Last Month'])
                @slot('subtitle', 'Users with most posts written in the last month')
                @slot('items', collect($mostActiveLastMonth)->pluck('name'))
            @endcard
        </div>
    </div>
</div>
@endsection