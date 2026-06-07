@extends('backend.layouts.app')

@section('title', $title)

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="card-title">{{ $title }}</h4>
                    <a href="{{ route($route.'.create') }}" class="btn btn-primary">Add New</a>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered w-100">
                        <thead>
                            <tr>
                                <th>Name</th>
                                @if(isset($hasColor) && $hasColor)
                                <th>Color Preview</th>
                                @endif
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                @if(isset($hasColor) && $hasColor)
                                <td>
                                    <div style="width: 30px; height: 30px; background-color: {{ $item->hex_code }}; border-radius: 4px; border: 1px solid #ddd;"></div>
                                    <small>{{ $item->hex_code }}</small>
                                </td>
                                @endif
                                <td>
                                    <a href="{{ route($route.'.edit', $item->id) }}" class="btn btn-sm btn-info">Edit</a>
                                    <form action="{{ route($route.'.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
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
