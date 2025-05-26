@extends('layouts.app')

@section('content')
<h2>Edit Category</h2>

<form action="{{ route('categories.update', $category) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-2">
        <label>Title</label>
        <input type="text" name="title" class="form-control" value="{{ old('title', $category->title) }}">
        @error('title') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection
