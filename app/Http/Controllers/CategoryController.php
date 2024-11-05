<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Hiển thị danh sách tất cả các danh mục
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    // Hiển thị form để tạo danh mục mới
    public function create()
    {
        return view('categories.create');
    }

    // Lưu một danh mục mới
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Category::create($request->all());

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully.');
    }

    // Hiển thị một danh mục cụ thể
    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
    }

    // Hiển thị form để chỉnh sửa danh mục
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    // Cập nhật danh mục
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category->update($request->all());

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
    }

    // Xóa danh mục
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully.');
    }
}
