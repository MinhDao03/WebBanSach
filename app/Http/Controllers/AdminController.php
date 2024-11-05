<?php
namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Orders; 
use App\Models\User;   
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminController extends Controller
{
    // Trang dashboard hiển thị danh mục và sản phẩm
    public function index()
    {
        $categories = Category::all();
        $products = Product::with('category')->get();
        
        // Lấy tổng số đơn hàng
        $totalOrders = Orders::count();
        
        // Lấy tổng số khách hàng
        $totalCustomers = User::count();

         // Tổng doanh số theo năm
         $totalRevenueYear = Orders::whereYear('created_at', Carbon::now()->year)
         ->sum('total');

         // Tổng doanh số theo tháng
         $totalRevenueMonth = Orders::whereYear('created_at', Carbon::now()->year)
         ->whereMonth('created_at', Carbon::now()->month)
         ->sum('total');

        return view('admin.dashboard', compact('categories', 'products', 'totalOrders', 'totalCustomers','totalRevenueYear', 'totalRevenueMonth'));
    }
}
