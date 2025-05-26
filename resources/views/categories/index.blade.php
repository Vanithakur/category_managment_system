@extends('layouts.app')

@section('content')
<h2>All Categories</h2>
<a href="{{ route('categories.create') }}" class="btn btn-success mb-3">Create Category</a>

<table class="table table-bordered">
    <thead>
        <tr><th>Title</th><th>Actions</th></tr>
    </thead>
    <tbody>
        @forelse($categories as $cat)
        <tr>
            <td>{{ $cat->title }}</td>
            <td>
                <a href="{{ route('categories.edit', $cat) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('categories.destroy', $cat) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @empty
        <tr><td colspan="2">No categories found.</td></tr>
        @endforelse
    </tbody>
</table>
@endsection
