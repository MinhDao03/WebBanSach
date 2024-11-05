@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Chỉnh sửa danh mục</h1>
    <div class="card shadow-lg rounded">
        <div class="card-header bg-info text-white">
            <h5 class="mb-0">Cập nhật thông tin danh mục</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Tên danh mục:</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $category->name) }}" required>
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="d-flex justify-content-between mt-4">
                    <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Cập nhật</button>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary"><i class="fas fa-times"></i> Hủy</a>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Thêm Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
@endsection
