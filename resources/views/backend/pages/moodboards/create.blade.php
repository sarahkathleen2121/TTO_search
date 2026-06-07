@extends('backend.layouts.app')

@section('title', isset($moodboard) ? 'Edit Moodboard' : 'Add Moodboard')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">{{ isset($moodboard) ? 'Edit Moodboard' : 'Add New Moodboard' }}</h4>

                <form action="{{ isset($moodboard) ? route('moodboards.update', $moodboard->id) : route('moodboards.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if(isset($moodboard)) 
                        @method('PUT') 
                    @endif

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Title</label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $moodboard->title ?? '') }}" required placeholder="e.g. Native Light Chair">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Description</label>
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4" required placeholder="Dignissim sed sit sit mattis. Elit adipiscing pretium sed neque nam.">{{ old('description', $moodboard->description ?? '') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Image</label>
                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" {{ isset($moodboard) ? '' : 'required' }}>
                        <small class="text-muted d-block mt-1">Recommended size: Square (e.g. 500x500 px). Allowed formats: JPG, PNG, WEBP.</small>
                        @error('image')
                            <div class="invalid-feedback text-danger d-block mt-1">{{ $message }}</div>
                        @enderror

                        @if(isset($moodboard) && $moodboard->image)
                            <div class="mt-3">
                                <label class="form-label d-block text-muted">Current Image:</label>
                                <img src="{{ asset('storage/'.$moodboard->image) }}" width="120" height="120" style="object-fit: cover; border-radius: 10px; border: 1px solid #ddd;">
                            </div>
                        @endif
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Status</label>
                        <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                            <option value="1" {{ old('status', $moodboard->status ?? '1') == '1' ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('status', $moodboard->status ?? '1') == '0' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-success px-4 me-2">Save</button>
                    <a href="{{ route('moodboards.index') }}" class="btn btn-secondary px-4">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
