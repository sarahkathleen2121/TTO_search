@extends('backend.layouts.app')

@section('title', isset($product) ? 'Edit Product' : 'Add Product')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">{{ isset($product) ? 'Edit Product' : 'Add Product' }}</h4>

                <form action="{{ isset($product) ? route('products.update', $product->id) : route('products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if(isset($product)) @method('PUT') @endif

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $product->name ?? '') }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Price ($)</label>
                            <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price', $product->price ?? '') }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Brand</label>
                            <select name="brand_id" class="form-select">
                                <option value="">Select Brand</option>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}" {{ (old('brand_id', $product->brand_id ?? '') == $brand->id) ? 'selected' : '' }}>{{ $brand->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Product Type</label>
                            <select name="product_type_id" class="form-select">
                                <option value="">Select Type</option>
                                @foreach($productTypes as $type)
                                    <option value="{{ $type->id }}" {{ (old('product_type_id', $product->product_type_id ?? '') == $type->id) ? 'selected' : '' }}>{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Multi-select attributes -->
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Industries</label>
                            <select name="industries[]" class="form-select" multiple style="height:100px;">
                                @foreach($industries as $item)
                                    <option value="{{ $item->id }}" {{ (isset($product) && $product->industries->contains($item->id)) ? 'selected' : '' }}>{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Spaces</label>
                            <select name="spaces[]" class="form-select" multiple style="height:100px;">
                                @foreach($spaces as $item)
                                    <option value="{{ $item->id }}" {{ (isset($product) && $product->spaces->contains($item->id)) ? 'selected' : '' }}>{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Colors</label>
                            <select name="colors[]" class="form-select" multiple style="height:100px;">
                                @foreach($colors as $item)
                                    <option value="{{ $item->id }}" {{ (isset($product) && $product->colors->contains($item->id)) ? 'selected' : '' }}>{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Materials</label>
                            <select name="materials[]" class="form-select" multiple style="height:100px;">
                                @foreach($materials as $item)
                                    <option value="{{ $item->id }}" {{ (isset($product) && $product->materials->contains($item->id)) ? 'selected' : '' }}>{{ $item->name }}</option>
                                @endforeach
                            </select>
                            <small class="text-muted">Hold CTRL to select multiple</small>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="3">{{ old('description', $product->description ?? '') }}</textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Thumbnail Image</label>
                            <input type="file" name="thumbnail" class="form-control">
                            @if(isset($product) && $product->thumbnail)
                                <img src="{{ asset('storage/'.$product->thumbnail) }}" alt="img" width="100" class="mt-2">
                            @endif
                        </div>
                        <div class="col-md-6 mb-3 d-flex align-items-center">
                            <div class="form-check form-switch mt-4">
                                <input class="form-check-input" type="checkbox" name="is_featured" value="1" {{ (old('is_featured', $product->is_featured ?? 0)) ? 'checked' : '' }}>
                                <label class="form-check-label">Featured Product</label>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success mt-3">Save Product</button>
                    <a href="{{ route('products.index') }}" class="btn btn-secondary mt-3">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
