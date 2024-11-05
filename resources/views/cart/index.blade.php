@extends('layouts.app')

@section('content')
<div class="container">
     <!-- Thêm ảnh bìa cho trang -->
     <div class="cover-image mb-4 text-center">
        <img src="https://thietkelogo.phamdinhtuan.com/uploads/1/1/5/7/11579689/banner-nhasach-02_orig.jpg" alt="Ảnh bìa" style="width: 100%; height: 400px; object-fit: cover;" class="mx-auto d-block">
    </div>
    <h1>Danh sách mua hàng</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(count($cart) > 0)
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Tên sản phẩm</th>
                    <th>Danh mục</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                    <th>Thành tiền</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach ($cart as $id => $details)
                    @php $total += $details['price'] * $details['quantity']; @endphp
                    <tr>
                        <td>{{ $details['name'] }}</td>
                        <td>{{ $details['category'] }}</td>
                        <td>
                            <form action="{{ route('cart.update', $id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('PATCH')
                                <input type="number" name="quantity" value="{{ $details['quantity'] }}" min="1" class="form-control" style="width: 80px; display: inline;">
                                <button type="submit" class="btn btn-sm btn-secondary">Cập nhật</button>
                            </form>
                        </td>
                        <td>{{ number_format($details['price'], 0, ',', '.') }} VND</td>
                        <td>{{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }} VND</td>
                        <td>
                            <form action="{{ route('cart.remove', $id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="text-right mb-3">
            
            <h3>Tổng tiền: {{ number_format($total, 0, ',', '.') }} VND</h3>
        </div>

        <!-- Form đặt hàng -->
        <form action="{{ route('order.store') }}" method="POST">
            @csrf
            <input type="hidden" name="total" value="{{ $total }}">
            
            <!-- Thêm trường số điện thoại -->
            <div class="form-group mb-3">
                <label for="phone">Số điện thoại:</label>
                <input type="text" name="phone" id="phone" class="form-control" placeholder="Nhập số điện thoại" required>
            </div>

            <!-- Thêm trường địa chỉ -->
            <div class="form-group mb-3">
                <label for="address">Địa chỉ giao hàng:</label>
                <input type="text" name="address" id="address" class="form-control" placeholder="Nhập địa chỉ giao hàng" required>
            </div>

                <!-- Phương thức thanh toán -->
            <div >
            <div class="text-right mb-3">
                <label for="payment_method" class="form-label">Phương thức thanh toán:</label>
                <select class="text-right mb-3" name="payment_method" id="payment_method" class="form-control">
                    <option value="COD">COD</option>
                    <option value="online">Trực tuyến</option>
                </select>
            </div>
        </div>

        <div class="row">
            
            <div class="col-md-6 d-flex align-items-center">
                <a href="{{ route('user.dashboard') }}" class="btn btn-primary">Tiếp tục mua hàng</a>
            </div>

            
            <div class="col-md-6 d-flex justify-content-end">
                <button type="submit" class="btn btn-success">Thanh Toán</button>
            </div>
        </div>

        <H1></H1>
    @else
        <p>Giỏ hàng của bạn trống.</p>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="{{ route('user.dashboard') }}" class="btn btn-primary">Tiếp tục mua hàng</a>
        </div>
    @endif

</div>
@endsection
