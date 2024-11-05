@extends('layouts.app')

@section('content')
<div class="mt-2">
                <a href="{{ route('admin.products.index') }}" class="btn btn-primary">Quản lý Sản phẩm</a>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Quản lý Danh mục</a>
                <a href="{{ route('admin.orders.index') }}" class="btn btn-success">Quản lý Đơn hàng</a> <!-- Nút quản lý đơn hàng -->
                <a href="{{ route('admin.reports.index') }}" class="btn btn-danger">Báo Cáo</a>
            </div>
<div class="container mt-5">
    <h1 class="mb-4 text-center">Quản lý Đơn hàng</h1>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <table class="table table-bordered table-hover table-striped">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Tên người dùng</th>
                <th class="text-end">Tổng tiền</th>
                <th>Trạng thái</th>
                <th>Phương thức thanh toán</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->user->name }}</td>
                <td class="text-end">{{ number_format($order->total, 2) }} VND</td>
                <td>
                    <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <select name="status" class="form-select" onchange="this.form.submit()">
                            <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Đang xử lý</option>
                            <option value="paid" {{ $order->status == 'paid' ? 'selected' : '' }}>Đã thanh toán</option>
                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
                        </select>
                    </form>
                </td>
                <td>{{ $order->payment_method }}</td>
                <td>
                    <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-info btn-sm">Xem chi tiết</a>
                    <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này?');" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
