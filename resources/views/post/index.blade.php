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

        <p class="text-muted">
            Added {{ $post->created_at->diffForHumans() }}
            by {{ $post->user->name }}
        </p>
        
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
            <div class="card" style="width: 100%;">
                <div class="card-body">
                    <h5 class="card-title">Most Commented Posts</h5>
                    <h6 class="card-subtitle mb-2 text-muted">What people are talking about</h6>
                </div>

                <ul class="list-group list-group-flush">
                    @foreach ($mostCommented as $post)
                    <li class="list-group-item">
                        <a href="{{ route('post.show', ['post' => $post->id]) }}">{{ $post->title }}</a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="row mt-5">
            <div class="card" style="width: 100%;">
                <div class="card-body">
                    <h5 class="card-title">Most Active Users</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Users with most posts written</h6>
                </div>

                <ul class="list-group list-group-flush">
                    @foreach ($mostActive as $user)
                    <li class="list-group-item">
                        {{ $user->name }}
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="row mt-5">
            <div class="card" style="width: 100%;">
                <div class="card-body">
                    <h5 class="card-title">Most Active Users Last Month</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Users with most posts written in the last month</h6>
                </div>

                <ul class="list-group list-group-flush">
                    @foreach ($mostActiveLastMonth as $user)
                    <li class="list-group-item">
                        {{ $user->name }}
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection