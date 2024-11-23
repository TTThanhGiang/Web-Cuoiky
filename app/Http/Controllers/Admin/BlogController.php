<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(){


        $childView = 'management-blog'; //Không đụng vào phần này
        $view = 'blogs'; //Không đụng vào phần này
        return view('admin.blog.index', compact('childView','view'));  //Không đụng vào childView và  view
    }

    public function create(){


        $childView = 'create-blog'; //Không đụng vào phần này
        $view = 'blogs'; //Không đụng vào phần này
        return view('admin.blog.create', compact('childView','view'));  //Không đụng vào childView và  view
    }

    public function edit(){
        
        $childView = 'management-blog'; //Không đụng vào phần này
        $view = 'blogs'; //Không đụng vào phần này
        return view('admin.blog.edit', compact('childView','view'));  //Không đụng vào childView và  view
    }

    

}
