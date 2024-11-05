<?php
// app/Http/Controllers/WelcomeController.php

namespace App\Http\Controllers;

use App\Models\Product; // Import model Product
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $products = Product::all(); // Lấy tất cả sản phẩm từ cơ sở dữ liệu

        return view('welcome', compact('products')); // Truyền biến $products đến view
    }
}
