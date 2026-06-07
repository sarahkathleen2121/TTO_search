@extends('backend.layouts.app')

@section('title', 'Manage Moodboards')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="card-title">Moodboards</h4>
                    <a href="{{ route('moodboards.create') }}" class="btn btn-primary text-white">Add New Moodboard</a>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered w-100 align-middle">
                        <thead>
                            <tr>
                                <th style="width: 100px;">Image</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th style="width: 120px;">Status</th>
                                <th style="width: 180px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($moodboards as $moodboard)
                            <tr>
                                <td>
                                    @if($moodboard->image)
                                        <img src="{{ $moodboard->imageUrl() }}" width="60" height="60" style="object-fit: cover; border-radius: 8px;">
                                    @else
                                        <div style="width: 60px; height: 60px; background-color: #eff0f0; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #aaa;">N/A</div>
                                    @endif
                                </td>
                                <td class="fw-bold">{{ $moodboard->title }}</td>
                                <td>{{ Str::limit($moodboard->description, 100) }}</td>
                                <td>
                                    @if($moodboard->status)
                                        <span class="badge bg-success text-white">Active</span>
                                    @else
                                        <span class="badge bg-secondary text-white">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('moodboards.edit', $moodboard->id) }}" class="btn btn-sm btn-info text-white">Edit</a>
                                    <form action="{{ route('moodboards.destroy', $moodboard->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this moodboard?')">Delete</button>
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
