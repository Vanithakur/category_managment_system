@extends('layouts.app')

@section('content')
<h2>Create Post</h2>

<form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-2">
        <label>Title</label>
        <input type="text" name="title" class="form-control" value="{{ old('title') }}">
        @error('title') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="mb-2">
        <label>Content</label>
        <textarea name="content" class="form-control">{{ old('content') }}</textarea>
        @error('content') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="mb-2">
        <label>Category</label>
        <select name="category_id" class="form-control">
            <option value="">Select</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                    {{ $cat->title }}
                </option>
            @endforeach
        </select>
        @error('category_id') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="mb-2">
        <label>Status</label>
        <select name="status" class="form-control">
            <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
            <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
        </select>
        @error('status') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="mb-2">
        <label>Thumbnail</label>
        <input type="file" name="thumbnail" class="form-control">
        @error('thumbnail') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection
