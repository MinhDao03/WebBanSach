@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4 text-center">Chi tiết Đơn hàng #{{ $order->id }}</h1>

    <div class="row mb-4">
        <div class="col-md-6">
            <h5>Thông tin người dùng</h5>
            <p><strong>Tên:</strong> {{ $order->user->name }}</p>
            <p><strong>Email:</strong> {{ $order->user->email }}</p>
            <p><strong>Số điện thoại:</strong> {{ $order->phone }}</p> <!-- Hiển thị số điện thoại -->
            <p><strong>Địa chỉ:</strong> {{ $order->address }}</p> <!-- Hiển thị địa chỉ -->
        </div>
        <div class="col-md-6 text-right">
            <h5>Thông tin đơn hàng</h5>
            <p><strong>ID Đơn hàng:</strong> {{ $order->id }}</p>
            <p><strong>Tổng tiền:</strong> {{ number_format($order->total, 2) }} VND</p>
            <p><strong>Trạng thái:</strong> {{ ucfirst($order->status) }}</p>
            <p><strong>Phương thức thanh toán:</strong> {{ ucfirst($order->payment_method) }}</p>
        </div>
    </div>

    <h5 class="mt-4">Các sản phẩm trong đơn hàng:</h5>
    <table class="table table-bordered table-hover">
        <thead class="thead-dark">
            <tr>
                <th>Tên sản phẩm</th>
                <th>Số lượng</th>
                <th>Giá</th>
                <th>Thành tiền</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->orderItems as $item)
            <tr>
                <td>{{ $item->product->name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ number_format($item->price, 2) }} VND</td>
                <td>{{ number_format($item->price * $item->quantity, 2) }} VND</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="text-right">
        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">Quay lại</a>
    </div>
</div>
@endsection
