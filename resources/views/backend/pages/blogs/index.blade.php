@extends('backend.layouts.app')

@section('title', 'Manage Blogs')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="card-title">Blogs</h4>
                    <a href="{{ route('blogs.create') }}" class="btn btn-primary">Add New Blog</a>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered w-100">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Slug</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($blogs as $blog)
                            <tr>
                                <td>
                                    @if($blog->featured_image)
                                        <img src="{{ $blog->featuredImageUrl() }}" width="60">
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>{{ $blog->title }}</td>
                                <td>{{ $blog->slug }}</td>
                                <td>
                                    <a href="{{ route('blogs.edit', $blog->id) }}" class="btn btn-sm btn-info">Edit</a>
                                    <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this blog?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
