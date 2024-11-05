@extends('layouts.app')

@section('content')
<div class="container text-center">  <!-- Căn giữa nội dung trong container -->
    <!-- Thêm ảnh bìa cho trang -->
    <div class="cover-image mb-4">
        <img src="https://thietkelogo.phamdinhtuan.com/uploads/1/1/5/7/11579689/banner-nhasach-02_orig.jpg" alt="Ảnh bìa" style="width: 100%; height: 400px; object-fit: cover;" class="mx-auto d-block">
    </div>

    <h1>Đơn hàng của bạn</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(count($orders) > 0)
        <div class="table-responsive">  <!-- Thêm phần table-responsive để có giao diện tốt trên thiết bị di động -->
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Mã đơn hàng</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái</th>
                        <th>Ngày tạo</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ number_format($order->total, 2) }} VND</td>
                        <td>{{ ucfirst($order->status) }}</td>
                        <td>{{ $order->created_at->format('d/m/Y') }}</td>
                        <td><a href="{{ route('orders.show', $order->id) }}" class="btn btn-info">Xem chi tiết</a></td>
                    </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-md-6 d-flex align-items-center">
                <a href="{{ route('user.dashboard') }}" class="btn btn-primary">Tiếp tục mua hàng</a>
            </div>
    @else
        <p>Bạn chưa có đơn hàng nào.</p>
    @endif
</div>
@endsection
