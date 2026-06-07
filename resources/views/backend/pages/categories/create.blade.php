@extends('backend.layouts.app')

@section('title', isset($item) ? 'Edit ' . $singleName : 'Add ' . $singleName)

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">{{ isset($item) ? 'Edit ' . $singleName : 'Add ' . $singleName }}</h4>

                <form action="{{ isset($item) ? route($route.'.update', $item->id) : route($route.'.store') }}" method="POST">
                    @csrf
                    @if(isset($item)) @method('PUT') @endif

                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $item->name ?? '') }}" required>
                    </div>

                    @if(isset($hasColor) && $hasColor)
                    <div class="mb-3">
                        <label class="form-label">Color (Hex Code)</label>
                        <div class="d-flex align-items-center gap-2">
                            <input type="color" id="colorPicker" class="form-control form-control-color" value="{{ old('hex_code', $item->hex_code ?? '#000000') }}" style="max-width: 50px;">
                            <input type="text" id="hexCodeInput" name="hex_code" class="form-control" value="{{ old('hex_code', $item->hex_code ?? '#000000') }}" required>
                        </div>
                        <script>
                            document.getElementById('colorPicker').addEventListener('input', function(e) {
                                document.getElementById('hexCodeInput').value = e.target.value;
                            });
                            document.getElementById('hexCodeInput').addEventListener('input', function(e) {
                                document.getElementById('colorPicker').value = e.target.value;
                            });
                        </script>
                    </div>
                    @endif

                    <button type="submit" class="btn btn-success">Save</button>
                    <a href="{{ route($route.'.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
