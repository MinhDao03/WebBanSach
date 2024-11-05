@extends('layouts.app')

@section('content')
<div class="container my-5">
    <!-- Khung cho trang web -->
    <div class="border rounded shadow-lg p-4 bg-light">
        <!-- Tên sản phẩm -->
        <h2 class="text-center mb-4 font-weight-bold">{{ $product->name }}</h2>

        <!-- Ảnh sản phẩm -->
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="product-image text-center mb-4">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" 
                         class="img-fluid rounded shadow" 
                         style="width: 50%; height: auto; max-height: 400px; object-fit: cover;">
                </div>
            </div>
        </div>

        <!-- Thông tin sản phẩm -->
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card p-4 shadow-sm">
                    <!-- Giá sản phẩm -->
                    <p class="h4 text-primary">Giá: <span class="font-weight-bold">{{ number_format($product->price, 0) }} VND</span></p>

                    <!-- Danh mục sản phẩm -->
                    <p class="h5 mt-3">Danh mục: <span class="text-secondary">{{ $product->category->name }}</span></p>

                    <!-- Số lượng sản phẩm -->
                    <p class="h5">Số lượng còn lại: <span class="badge badge-info">{{ $product->quantity }}</span></p>

                    <!-- Mô tả sản phẩm -->
                    <p class="h5 mt-4">Mô tả:</p>
                    <p>{{ $product->description }}</p>

                    <!-- Thêm vào giỏ hàng -->
                    <div class="text-center mt-4">
                        @auth
                        <form action="{{ route('cart.add', $product->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success btn-lg">Thêm vào giỏ hàng</button>
                        </form>
                        @else
                        <p class="mt-3">Vui lòng <a href="{{ route('login') }}" class="text-decoration-none text-primary font-weight-bold">đăng nhập</a> để thêm sản phẩm vào giỏ hàng.</p>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
