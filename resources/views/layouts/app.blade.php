<!DOCTYPE html>
<html>
<head>
    <title>Mini Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <nav class="mb-4">
        <a href="{{ route('posts.index') }}" class="btn btn-primary">Posts</a>
        <a href="{{ route('posts.create') }}" class="btn btn-success">Create Post</a>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Categories</a>
    </nav>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @yield('content')
</div>
</body>
</html>
