@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4 text-center animate__animated animate__fadeInDown">Thêm sản phẩm mới</h1>
    
    <div class="card shadow-lg rounded animate__animated animate__fadeInUp"> <!-- Thêm đổ bóng, bo góc và hiệu ứng -->
        <div class="card-header bg-primary text-white"> <!-- Đổi màu nền header -->
            <h4 class="mb-0">Thông tin sản phẩm</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.products.store') }}" method="POST" id="productForm" enctype="multipart/form-data">
                @csrf

                <div class="form-group mb-3">
                    <label for="name" class="form-label font-weight-bold">Tên sản phẩm:</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="description" class="form-label font-weight-bold">Mô tả:</label>
                    <textarea id="description" name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="quantity" class="form-label font-weight-bold">Số lượng:</label>
                    <input type="number" id="quantity" name="quantity" class="form-control" value="{{ old('quantity') }}" required>
                    @error('quantity')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="price" class="form-label font-weight-bold">Giá:</label>
                    <input type="text" id="price" name="price" class="form-control" value="{{ old('price') }}" required>
                    @error('price')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="image" class="form-label font-weight-bold">Ảnh sản phẩm:</label>
                    <input type="file" id="image" name="image" class="form-control">
                    @error('image')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-4">
                    <label for="category_id" class="form-label font-weight-bold">Danh mục:</label>
                    <select id="category_id" name="category_id" class="form-select" required>
                        <option value="">Chọn danh mục</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Nút lưu và hủy với màu sắc đẹp hơn -->
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary btn-lg px-4">
                        <i class="fas fa-save"></i> Lưu
                    </button>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary btn-lg px-4">
                        <i class="fas fa-times"></i> Hủy
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Thêm các thư viện CSS và JS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Thêm SweetAlert2 cho nút Hủy
    document.querySelector('.btn-secondary').addEventListener('click', function(event) {
        event.preventDefault();
        Swal.fire({
            title: 'Bạn có chắc chắn muốn hủy?',
            text: "Mọi thay đổi sẽ không được lưu lại!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Có, hủy bỏ!',
            cancelButtonText: 'Không, tiếp tục!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ route('admin.products.index') }}";
            }
        })
    });
</script>

@endsection
