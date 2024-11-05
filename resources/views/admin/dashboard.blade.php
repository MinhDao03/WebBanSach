@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h3>Admin Dashboard</h3>
    <p>Chào mừng đến với trang quản trị!</p>

    <div class="mt-4">
        <a href="{{ route('admin.products.index') }}" class="btn btn-primary">Quản lý Sản phẩm</a>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Quản lý Danh mục</a>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-success">Quản lý Đơn hàng</a>
        <a href="{{ route('admin.reports.index') }}" class="btn btn-danger">Báo Cáo</a>
    </div>

    <div class="row mt-4">
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">Tổng số đơn hàng</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $totalOrders }}</h5>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-secondary mb-3">
                <div class="card-header">Tổng số khách hàng</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $totalCustomers }}</h5>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">Tổng doanh số năm</div>
                <div class="card-body">
                    <h5 class="card-title">{{ number_format($totalRevenueYear, 2) }} VND</h5>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-danger mb-3">
                <div class="card-header">Tổng doanh số tháng</div>
                <div class="card-body">
                    <h5 class="card-title">{{ number_format($totalRevenueMonth, 2) }} VND</h5>
                </div>
            </div>
        </div>
    </div>
    
@endsection
