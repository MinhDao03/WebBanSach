@extends('layouts.app')

@section('title', 'Báo cáo')

@section('content')
<div class="mt-2">
    <a href="{{ route('admin.products.index') }}" class="btn btn-primary">Quản lý Sản phẩm</a>
    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Quản lý Danh mục</a>
    <a href="{{ route('admin.orders.index') }}" class="btn btn-success">Quản lý Đơn hàng</a> 
    <a href="{{ route('admin.reports.index') }}" class="btn btn-danger">Báo Cáo</a>
</div>

<div class="container">
    <h1>Báo cáo doanh thu</h1>
    <div class="mt-4">
        <h4>Tổng số đơn hàng: {{ $totalOrders }}</h4>
        <h4>Tổng số khách hàng: {{ $totalCustomers }}</h4>
    </div>

    <div class="mt-4">
        <button id="showDailyRevenue" class="btn btn-info">Doanh thu theo ngày</button>
        <button id="showMonthlyRevenue" class="btn btn-info">Doanh thu theo tháng</button>
        <button id="showYearlyRevenue" class="btn btn-info">Doanh thu theo năm</button>
        <button id="showPaymentMethodRevenue" class="btn btn-info">Doanh thu theo phương thức thanh toán</button>
        <button id="showCategoryRevenue" class="btn btn-info">Doanh thu theo danh mục</button>
    </div>

    <div class="charts mt-4">
        <canvas id="revenueByDateChart" class="chart" style="display:none;"></canvas>
        <canvas id="revenueByMonthChart" class="chart" style="display:none;"></canvas>
        <canvas id="revenueByYearChart" class="chart" style="display:none;"></canvas>
        <canvas id="revenueByPaymentMethodChart" class="chart" style="display:none;"></canvas>
        <canvas id="categoryRevenueChart" class="chart" style="display:none;"></canvas>
    </div>
</div>

<style>
    /* Đặt kích thước cho các biểu đồ */
    .chart {
        width: 100%; /* Hoặc một kích thước cụ thể như 600px */
        max-width: 800px; /* Giới hạn kích thước tối đa */
        height: 600px; /* Chiều cao của biểu đồ */
        margin: 0 auto; /* Để căn giữa biểu đồ */
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Các biểu đồ sẽ được định nghĩa ở đây.
    // Giấu tất cả biểu đồ ngoại trừ biểu đồ theo ngày ban đầu
    var charts = {
        daily: document.getElementById('revenueByDateChart'),
        monthly: document.getElementById('revenueByMonthChart'),
        yearly: document.getElementById('revenueByYearChart'),
        paymentMethod: document.getElementById('revenueByPaymentMethodChart'),
        category: document.getElementById('categoryRevenueChart')
    };

    // Biểu đồ doanh thu theo ngày (Line chart)
    var dateLabels = @json($revenueByDate->pluck('date'));
    var dateData = @json($revenueByDate->pluck('total_revenue'));
    var revenueByDateChart = new Chart(charts.daily.getContext('2d'), {
        type: 'line',
        data: {
            labels: dateLabels,
            datasets: [{
                label: 'Doanh thu theo ngày',
                data: dateData,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1,
                fill: true
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Biểu đồ doanh thu theo tháng (Bar chart)
    var monthLabels = @json($revenueByMonth->pluck('month'));
    var monthData = @json($revenueByMonth->pluck('total_revenue'));
    var revenueByMonthChart = new Chart(charts.monthly.getContext('2d'), {
        type: 'bar',
        data: {
            labels: monthLabels,
            datasets: [{
                label: 'Doanh thu theo tháng',
                data: monthData,
                backgroundColor: 'rgba(153, 102, 255, 0.5)',
                borderColor: 'rgba(153, 102, 255, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Biểu đồ doanh thu theo năm (Bar chart)
    var yearLabels = @json($revenueByYear->pluck('year'));
    var yearData = @json($revenueByYear->pluck('total_revenue'));
    var revenueByYearChart = new Chart(charts.yearly.getContext('2d'), {
        type: 'bar',
        data: {
            labels: yearLabels,
            datasets: [{
                label: 'Doanh thu theo năm',
                data: yearData,
                backgroundColor: 'rgba(255, 159, 64, 0.5)',
                borderColor: 'rgba(255, 159, 64, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Biểu đồ doanh thu theo phương thức thanh toán (Pie chart)
    var paymentMethodLabels = @json($revenueByPaymentMethod->pluck('payment_method'));
    var paymentMethodData = @json($revenueByPaymentMethod->pluck('total_revenue'));
    var revenueByPaymentMethodChart = new Chart(charts.paymentMethod.getContext('2d'), {
        type: 'pie',
        data: {
            labels: paymentMethodLabels,
            datasets: [{
                label: 'Doanh thu theo phương thức thanh toán',
                data: paymentMethodData,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(54, 162, 235, 0.5)',
                    'rgba(255, 206, 86, 0.5)',
                    'rgba(75, 192, 192, 0.5)',
                    'rgba(153, 102, 255, 0.5)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function (context) {
                            return context.label + ': ' + new Intl.NumberFormat().format(context.raw) + ' VND';
                        }
                    }
                }
            }
        }
    });

    // Biểu đồ doanh thu theo từng danh mục (Bar chart)
    var categoryLabels = @json($categoryRevenue->pluck('category_id')); // Hoặc bạn có thể lấy tên danh mục nếu bạn đã có thông tin
    var categoryData = @json($categoryRevenue->pluck('total_revenue'));
    var ctx1 = document.getElementById('categoryRevenueChart').getContext('2d');
    var categoryRevenueChart = new Chart(ctx1, {
        type: 'bar',
        data: {
            labels: categoryLabels,
            datasets: [{
                label: 'Doanh thu theo từng danh mục',
                data: categoryData,
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Hàm để hiển thị biểu đồ tương ứng
    function showChart(chartToShow) {
        for (let chart in charts) {
            if (chart === chartToShow) {
                charts[chart].style.display = 'block';
            } else {
                charts[chart].style.display = 'none';
            }
        }
    }

    // Sự kiện khi nhấn nút
    document.getElementById('showDailyRevenue').addEventListener('click', function () {
        showChart('daily');
    });

    document.getElementById('showMonthlyRevenue').addEventListener('click', function () {
        showChart('monthly');
    });

    document.getElementById('showYearlyRevenue').addEventListener('click', function () {
        showChart('yearly');
    });

    document.getElementById('showPaymentMethodRevenue').addEventListener('click', function () {
        showChart('paymentMethod');
    });

    document.getElementById('showCategoryRevenue').addEventListener('click', function () {
        showChart('category');
    });

    // Hiển thị biểu đồ theo ngày mặc định
    showChart('daily');
});
</script>
@endsection
