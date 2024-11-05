@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Thêm ảnh bìa cho trang -->
    <div class="cover-image mb-4 text-center">
        <img src="https://thietkelogo.phamdinhtuan.com/uploads/1/1/5/7/11579689/banner-nhasach-02_orig.jpg" alt="Ảnh bìa" style="width: 100%; height: 400px; object-fit: cover;" class="mx-auto d-block">
    </div>


    <!-- Danh sách sản phẩm (hoặc nội dung chào mừng) -->
    <h2>Chào mừng đến với cửa hàng của chúng tôi!</h2>
    <p>Khám phá các sản phẩm mới nhất của chúng tôi.</p>

    <div class="row">
        @foreach($products as $product)
            <div class="col-md-3 mb-4 text-center">
                <div class="product-image" style="width: 100%; height: 300px; overflow: hidden;">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid" style="width: 100%; height: auto; object-fit: cover;">
                </div>
                 <!-- Hiển thị tên sản phẩm dưới dạng liên kết đến trang chi tiết sản phẩm -->
                 <p class="mt-2 h4">
                    <a href="{{ route('product.show', $product->id) }}">{{ $product->name }}</a>
                </p>
                <p class="mt-2 h5">{{ number_format($product->price, 0) }} VND</p>

                @auth
                <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mt-2">
                    @csrf
                    <button type="submit" class="btn btn-primary">Mua hàng</button>
                </form>
                @else
                <p>Vui lòng <a href="{{ route('login') }}">đăng nhập</a> để thêm sản phẩm vào giỏ hàng.</p>
                @endauth
            </div>
        @endforeach
    </div>
</div>
@endsection
