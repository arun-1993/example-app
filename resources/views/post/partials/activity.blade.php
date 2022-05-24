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