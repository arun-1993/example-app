<h3><a href="{{ route('post.show', ['post' => $post->id]) }}">{{ $post->title }}</a></h3>

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
    <a class="btn btn-primary" href="{{ route('post.edit', ['post' => $post->id]) }}">Edit</a>
    <form class="d-inline" action="{{ route('post.destroy', ['post' => $post->id]) }}" method="POST">
        @csrf
        @method('DELETE')
        <input class="btn btn-primary" type="submit" name="submit" value="Delete" />
    </form>
</div>