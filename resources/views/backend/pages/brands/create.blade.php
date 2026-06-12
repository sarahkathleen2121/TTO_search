@extends('backend.layouts.app')

@section('title', isset($brand) ? 'Edit Brand' : 'Add Brand')

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">{{ isset($brand) ? 'Edit Brand' : 'Add Brand' }}</h4>

                <form action="{{ isset($brand) ? route('brands.update', $brand->id) : route('brands.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if(isset($brand)) @method('PUT') @endif

                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $brand->name ?? '') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Image (Logo)</label>
                        <input type="file" name="image" class="form-control">
                        @if(isset($brand) && $brand->image)
                            <img src="{{ $brand->imageUrl() }}" width="80" class="mt-2 d-block">
                        @endif
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Background Image</label>
                        <input type="file" name="bg_image" class="form-control">
                        @if(isset($brand) && $brand->bg_image)
                            <img src="{{ $brand->bgImageUrl() }}" width="150" class="mt-2 d-block">
                        @endif
                    </div>

                    <button type="submit" class="btn btn-success">Save</button>
                    <a href="{{ route('brands.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
