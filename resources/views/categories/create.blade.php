@extends('layouts.app')

@section('content')
<h2>Create Category</h2>

<form action="{{ route('categories.store') }}" method="POST">
    @csrf

    <div class="mb-2">
        <label>Title</label>
        <input type="text" name="title" class="form-control" value="{{ old('title') }}">
        @error('title') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <button type="submit" class="btn btn-primary">Create</button>
</form>
@endsection
