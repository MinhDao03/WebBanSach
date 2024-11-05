<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Thêm validation cho ảnh
        ]);

        $data = $request->all();

        // Xử lý tải ảnh lên
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public'); // Lưu ảnh vào thư mục 'products' trong 'public'
            $data['image'] = $imagePath; // Lưu đường dẫn ảnh vào mảng dữ liệu
        }

        Product::create($data);
        return redirect()->route('admin.products.index')->with('success', 'Sản phẩm đã được tạo thành công.');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Thêm validation cho ảnh
        ]);

        $data = $request->all();

        // Xử lý tải ảnh lên
        if ($request->hasFile('image')) {
            // Xóa ảnh cũ nếu có
            if ($product->image) {
                Storage::delete('public/' . $product->image);
            }
            $imagePath = $request->file('image')->store('products', 'public');
            $data['image'] = $imagePath;
        }

        $product->update($data);
        return redirect()->route('admin.products.index')->with('success', 'Sản phẩm đã được cập nhật thành công.');
    }

    public function destroy(Product $product)
    {
        // Xóa ảnh khi xóa sản phẩm
        if ($product->image) {
            Storage::delete('public/' . $product->image);
        }

        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Sản phẩm đã được xóa thành công.');
    }

    public function show($id) {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

}



