@extends('layouts.app')

@section('content')
<h2>Edit Post</h2>

<form action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data">
    @csrf @method('PUT')

    <div class="mb-2">
        <label>Title</label>
        <input type="text" name="title" class="form-control" value="{{ old('title', $post->title) }}">
        @error('title') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="mb-2">
        <label>Content</label>
        <textarea name="content" class="form-control">{{ old('content', $post->content) }}</textarea>
        @error('content') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="mb-2">
        <label>Category</label>
        <select name="category_id" class="form-control">
            <option value="">Select</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ $post->category_id == $cat->id ? 'selected' : '' }}>
                    {{ $cat->title }}
                </option>
            @endforeach
        </select>
        @error('category_id') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="mb-2">
        <label>Status</label>
        <select name="status" class="form-control">
            <option value="published" {{ $post->status == 'published' ? 'selected' : '' }}>Published</option>
            <option value="draft" {{ $post->status == 'draft' ? 'selected' : '' }}>Draft</option>
        </select>
        @error('status') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="mb-2">
        <label>Thumbnail</label>
        <input type="file" name="thumbnail" class="form-control">
        @if($post->thumbnail)
            <img src="{{ asset('storage/' . $post->thumbnail) }}" width="100" class="mt-2">
        @endif
        @error('thumbnail') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection
