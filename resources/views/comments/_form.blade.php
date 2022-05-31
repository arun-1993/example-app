<div class="mb-4 mt-4">
@auth
    <form action="#" method="POST">
        @csrf

        <div class="form-floating mb-3">
            <textarea class="form-control" id="content" name="comment" placeholder="Blog Content" style="height: 100px"></textarea>
            <label for="content">Comment</label>
        </div>

        <div class="form-group d-grid gap-2">
            <input class="btn btn-primary btn-lg" type="submit" name="submit" value="Add Comment" />
        </div>
    </form>
@else
    <a href="{{ route('login') }}">Sign In</a> to post comments!
@endauth
</div>