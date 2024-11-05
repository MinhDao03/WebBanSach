@extends('layouts.app')

@section('content')
<div class="container mt-5">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg rounded">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">Tạo danh mục mới</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.categories.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Tên danh mục:</label>
                            <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save"></i> Lưu
                            </button>
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary" onclick="return confirm('Bạn có chắc chắn muốn hủy?');">
                                <i class="fas fa-times"></i> Hủy
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Thêm Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
@endsection
