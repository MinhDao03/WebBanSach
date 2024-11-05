@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4 text-center">Chỉnh sửa sản phẩm</h1>
    
    <div class="card shadow-lg rounded">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Thông tin sản phẩm</h4>
        </div>
        <div class="card-body">
            <!-- Thêm enctype để hỗ trợ tải lên file -->
            <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group mb-3">
                    <label for="name" class="form-label font-weight-bold">Tên sản phẩm:</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $product->name) }}" required>
                    @error('name')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="description" class="form-label font-weight-bold">Mô tả:</label>
                    <textarea id="description" name="description" class="form-control" rows="4">{{ old('description', $product->description) }}</textarea>
                    @error('description')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="quantity" class="form-label font-weight-bold">Số lượng:</label>
                    <input type="number" id="quantity" name="quantity" class="form-control" value="{{ old('quantity', $product->quantity) }}" required>
                    @error('quantity')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="price" class="form-label font-weight-bold">Giá:</label>
                    <input type="text" id="price" name="price" class="form-control" value="{{ old('price', $product->price) }}" required>
                    @error('price')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-4">
                    <label for="category_id" class="form-label font-weight-bold">Danh mục:</label>
                    <select id="category_id" name="category_id" class="form-select" required>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Thêm trường tải lên ảnh -->
                <div class="form-group mb-4">
                    <label for="image" class="form-label font-weight-bold">Ảnh sản phẩm:</label>
                    <input type="file" id="image" name="image" class="form-control">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" class="img-thumbnail mt-3" width="150"> <!-- Hiển thị ảnh hiện tại nếu có -->
                    @endif
                    @error('image')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary btn-lg px-4">
                        <i class="fas fa-save"></i> Cập nhật
                    </button>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary btn-lg px-4">
                        <i class="fas fa-times"></i> Hủy
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
