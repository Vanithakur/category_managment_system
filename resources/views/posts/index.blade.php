@extends('layouts.app')

@section('content')
<h2>All Posts</h2>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Title</th>
            <th>Category</th>
            <th>Status</th>
            <th>Thumbnail</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($posts as $post)
            <tr>
                <td>{{ $post->title }}</td>
                <td>{{ $post->category->title }}</td>
                <td>{{ ucfirst($post->status) }}</td>
                <td>
                    @if($post->thumbnail)
                        <img src="{{ asset('storage/' . $post->thumbnail) }}" width="80">
                    @else
                        <span class="text-muted">No image</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('posts.edit', $post) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('posts.destroy', $post) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="5">No posts found.</td></tr>
        @endforelse
    </tbody>
</table>
@endsection
