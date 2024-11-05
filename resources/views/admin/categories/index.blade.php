@extends('layouts.app')

@section('content')
<div class="mt-2">
                <a href="{{ route('admin.products.index') }}" class="btn btn-primary">Quản lý Sản phẩm</a>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Quản lý Danh mục</a>
                <a href="{{ route('admin.orders.index') }}" class="btn btn-success">Quản lý Đơn hàng</a> <!-- Nút quản lý đơn hàng -->
                <a href="{{ route('admin.reports.index') }}" class="btn btn-danger">Báo Cáo</a>
</div>
<div class="container mt-4">

    <h1 class="mb-4">Danh sách danh mục</h1>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Thêm danh mục mới</a>
    
    <div class="card shadow rounded">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Danh mục</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Tên danh mục</th>
                            <th class="text-center">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-warning btn-sm mx-1">
                                    <i class="fas fa-edit"></i> Chỉnh sửa
                                </a>
                                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm mx-1" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">
                                        <i class="fas fa-trash-alt"></i> Xóa
                                    </button>
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


<!-- Thêm Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
@endsection
