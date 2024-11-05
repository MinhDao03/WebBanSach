<?php
namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function dashboard(Request $request)
    {
        // Lấy tất cả danh mục
        $categories = Category::all();

        // Lấy danh mục được chọn (nếu có)
        $selectedCategory = $request->input('category');

        // Lọc sản phẩm theo danh mục được chọn, nếu không chọn thì lấy tất cả sản phẩm
        $products = Product::when($selectedCategory, function ($query, $selectedCategory) {
            return $query->where('category_id', $selectedCategory);
        })->get();

        // Trả view cùng với dữ liệu
        return view('user.dashboard', compact('categories', 'products', 'selectedCategory'));
    }
}
