<div class="form-floating mb-3">
    <input class="form-control" type="text" id="title" name="title" value="{{ old('title', optional($post ?? null)->title) }}" placeholder="Blog Title" />
    <label for="title">Title</label>
</div>

{{--  @error('title')
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg> {{ $message }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@enderror  --}}

<div class="form-floating mb-3">
    <textarea class="form-control" id="content" name="content" placeholder="Blog Content" style="height: 200px">{{ old('content', optional($post ?? null)->content) }}</textarea>
    <label for="content">Content</label>
</div>

{{--  @error('content')
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg> {{ $message }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@enderror  --}}

<div class="form-floating mb-3">
    <input class="form-control" type="file" id="thumbnail" name="thumbnail" accept="image/*" />
    <label for="thumbnail">Thumbnail</label>
</div>

@errors @enderrors