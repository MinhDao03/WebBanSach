@extends('layouts.app')

@section('content')
<div class="container">

    <!-- Thêm ảnh bìa cho trang -->
    <div class="cover-image mb-4 text-center">
        <img src="https://thietkelogo.phamdinhtuan.com/uploads/1/1/5/7/11579689/banner-nhasach-02_orig.jpg" alt="Ảnh bìa" style="width: 100%; height: 400px; object-fit: cover;" class="mx-auto d-block">
    </div>
    
    <!-- Biểu tượng giỏ hàng -->
    <div class="position-relative">
        <a href="{{ route('cart.index') }}" class="btn btn-outline-secondary position-absolute" style="top: 1px; right: 10px;">
            <i class="fas fa-shopping-cart"></i> Giỏ hàng
        </a>
    </div>

    <!-- Select box danh mục sản phẩm -->
    <h2>Danh Sách Sản Phẩm</h2>
    
    <form action="{{ route('user.dashboard') }}" method="GET" class="mb-4">
        <div class="form-group d-flex align-items-center">
            <label for="category" class="mr-2">Chọn danh mục:</label>
            <select name="category" id="category" class="form-control mr-2" style="width: auto;">
                <option value="">Tất cả</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $selectedCategory == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-primary">Lọc</button>
        </div>
    </form>

    <!-- Danh sách sản phẩm -->
    <div class="row">
        @forelse($products as $product)
            <div class="col-md-3 mb-4 text-center">
                <div class="product-image" style="width: 100%; height: 300px; overflow: hidden;">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid" style="width: 100%; height: auto; object-fit: cover;">
                </div>
                <!-- Hiển thị tên sản phẩm dưới dạng liên kết đến trang chi tiết sản phẩm -->
                <p class="mt-2 h4">
                    <a href="{{ route('product.show', $product->id) }}">{{ $product->name }}</a>
                </p>
                
                <!-- Hiển thị giá tiền -->
                <p class="mt-2 h5">{{ number_format($product->price, 0) }} VND</p>

                @auth
                <!-- Form để thêm sản phẩm vào giỏ hàng -->
                <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mt-2">
                    @csrf
                    <button type="submit" class="btn btn-primary">Thêm vào giỏ hàng</button>
                </form>
                @else
                <p>Vui lòng <a href="{{ route('login') }}">đăng nhập</a> để thêm sản phẩm vào giỏ hàng.</p>
                @endauth
            </div>
        @empty
            <p>Không có sản phẩm nào.</p>
        @endforelse
    </div>
</div>
@endsection
