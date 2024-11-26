<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $childView = 'management-category';
        $view = 'categories';
        return view('admin.category.index', compact('childView','view','categories'));
    }

    public function create()
    {
        $childView = 'createCategory';
        $view = 'categories';
        return view('admin.category.create', compact('childView','view'));
    }

    public function store(Request $request)
    {
        // Validate dữ liệu
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        // Tạo người dùng mới
        $category = new Category();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();

        // Quay lại danh sách người dùng với thông báo thành công
        return redirect()->route('admin.category.index')->with('success', 'Category created successfully');
    }

    public function edit($id)
    {
        $category = Category::find($id);
        if (!$category) {
            abort(404, 'Category not found');
        }

        $childView = 'management-category';
        $view = 'categories';

        return view('admin.category.edit', compact('category','childView','view'));
    }



    public function update(Request $request, $id)
    {
        $category = Category::find($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $category->name = $request->input('name');
        $category->description = $request->input('description');
        $category->save();

        return redirect()->route('admin.category.index', ['id' => $id])->with('success', 'Category updated successfully');
    }

    public function delete($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('admin.category.index')->with('success', 'Category deleted successfully');
    }
}
