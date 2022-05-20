<div class="card" style="width: 100%;">
    <div class="card-body">
        <h5 class="card-title">{{ $title }}</h5>
        <h6 class="card-subtitle mb-2 text-muted">{{ $subtitle }}</h6>
    </div>

    <ul class="list-group list-group-flush">
        @if (is_a($items, 'Illuminate\Support\Collection'))
            @foreach ($items as $item)
            <li class="list-group-item">
                {{--  <a href="{{ route('post.show', ['post' => $post->id]) }}">{{ $post->title }}</a>  --}}
                {{ $item }}
            </li>
            @endforeach
        @else
            {{ $items }}
        @endif
    </ul>
</div>