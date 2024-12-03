<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\User;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function index(){
        $categories = BlogCategory::pluck('name','id');
        $blogs = Blog::all();

        $childView = 'management-blog'; //Không đụng vào phần này
        $view = 'blogs'; //Không đụng vào phần này
        return view('admin.blog.index', compact('childView','view','blogs','categories'));  //Không đụng vào childView và  view
    }

    public function create(){
        $categories = BlogCategory::pluck('name','id');

        $childView = 'create-blog'; //Không đụng vào phần này
        $view = 'blogs'; //Không đụng vào phần này
        return view('admin.blog.create', compact('childView','view','categories'));  //Không đụng vào childView và  view
    }

    public function store(Request $request)
    {
        // Validate dữ liệu
        $params = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'start_at' => 'required|date',
            'end_at' => 'required|date',
            'blogcate_id' => 'required|exists:blogcategories,id', 
        ]);

        // Handle file upload
        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $params['image'] = $imageName;
        }

        $params['poster_id'] = Auth::id();
        $blog = Blog::create($params);

        // Quay lại danh sách blog với thông báo thành công
        return redirect()->route('admin.blogs.index')->with('success', 'Blog created successfully.');
    }

    public function edit($id){
        $blog = Blog::find($id);
        $categories = BlogCategory::pluck('name', 'id');

        $childView = 'management-blog'; //Không đụng vào phần này
        $view = 'blogs'; //Không đụng vào phần này
        return view('admin.blog.edit', compact('childView','view','blog','categories'));  //Không đụng vào childView và  view
    }

    public function update(Request $request,  $id){
        $blog = Blog::find($id);
        // Validate dữ liệu
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'start_at' => 'required|date',
            'end_at' => 'required|date',
            'blogcate_id' => 'required|exists:blogcategories,id',
        ]);

        // Handle file upload
        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
        }

        // Cập nhật blog
        $blog->title = $request->title;
        $blog->content = $request->content;
        $blog->image = $imageName;
        $blog->start_at = Carbon::parse($request->start_at)->format('Y-m-d');
        $blog->end_at = Carbon::parse($request->end_at)->format('Y-m-d');
        $blog->blogcate_id = $request->blogcate_id;
        $blog->save();

        // Quay lại danh sách blog với thông báo thành công
        return redirect()->route('admin.blogs.index')->with('success', 'Blog updated successfully.');
    }

    public function destroy($id){
        $blog = Blog::find($id);
        $blog->delete();
        return redirect()->route('admin.blogs.index')->with('success', 'Blog deleted successfully.');
    }

    public function show($id){
        $blog = Blog::find($id);
        $categories = BlogCategory::pluck('name', 'id');

        $childView = 'management-blog'; //Không đụng vào phần này
        $view = 'blogs'; //Không đụng vào phần này
        return view('admin.blog.show', compact('childView','view','blog','categories'));  //Không đụng vào childView và  view
    }

    // create function search
    public function search(Request $request)
    {
        $search = $request->input('search');
        $view = 'blogs';
        $childView = 'management-blog';

        $blogs = Blog::when($search, function ($query) use ($search) {
            return $query->where('title', 'like', '%' . $search . '%');
        })->get();
        return view('admin.blog.index', compact('childView','view','blogs'));  //Không đụng vào childView và  view
    }
}
