@extends('backend.layouts.app')

@section('title', isset($category) ? 'Edit Category' : 'Add Category')

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">{{ isset($category) ? 'Edit Category' : 'Add Category' }}</h4>

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ isset($category) ? route('blog-categories.update', $category->id) : route('blog-categories.store') }}" method="POST">
                    @csrf
                    @if(isset($category)) @method('PUT') @endif

                    <div class="mb-3">
                        <label class="form-label">Category Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $category->name ?? '') }}" required>
                    </div>

                    <button type="submit" class="btn btn-success">Save</button>
                    <a href="{{ route('blog-categories.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
