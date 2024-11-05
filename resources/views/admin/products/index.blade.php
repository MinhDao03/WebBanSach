@extends('layouts.app')

@section('content')
<div class="mt-2">
                <a href="{{ route('admin.products.index') }}" class="btn btn-primary">Quản lý Sản phẩm</a>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Quản lý Danh mục</a>
                <a href="{{ route('admin.orders.index') }}" class="btn btn-success">Quản lý Đơn hàng</a> <!-- Nút quản lý đơn hàng -->
                <a href="{{ route('admin.reports.index') }}" class="btn btn-danger">Báo Cáo</a>
            </div>
<div class="container-fluid mt-4">
    <h1 class="mb-4 text-center">Danh Sách Sản Phẩm</h1>
    <a href="{{ route('admin.products.create') }}" class="btn btn-success mb-3">
        <i class="fas fa-plus"></i> Thêm sản phẩm mới
    </a>
    
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Danh Sách Sản Phẩm</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover text-center">
                    <thead class="thead-light">
                        <tr>
                            
                            <th>ID</th>
                            <th>Tên sản phẩm</th>
                            <th>Mô tả</th>
                            <th>Số lượng</th>
                            <th>Giá (VND)</th>
                            <th>Danh mục</th>
                            <th>Ảnh</th>                          
                            <th>Ngày tạo</th>
                            
                            <!-- <th>Ngày cập nhật</th>  
                            <th>Hành động</th>          -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ Str::limit($product->description, 50) }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td>{{ number_format($product->price, 2) }}</td>
                            <td>{{ $product->category->name }}</td>
                            <td>
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-thumbnail" style="width: 40px;">
                                @else
                                    <span>Chưa có ảnh</span>
                                @endif
                            </td>
                            <!-- <td>{{ $product->created_at->format('d/m/Y') }}</td>
                            
                            <td>{{ $product->updated_at->format('d/m/Y') }}</td> -->
                            <td>
                                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning btn-sm mb-1">
                                    <i class="fas fa-edit"></i> Chỉnh sửa
                                </a>
                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">
                                        <i class="fas fa-trash"></i> Xóa
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
@endsection
