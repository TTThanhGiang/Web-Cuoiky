@extends('layouts.mainAdmin')

@section('title', 'Home Page')
    
@section('content')

<section>
      <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
          <div class="container-xl">
            <div
              class="row g-3 mb-4 align-items-center justify-content-between"
            >
              <div class="col-auto">
                <h1 class="app-page-title mb-0">Edit Blog</h1>
              </div>
            </div>
            <!--//row-->
            <div class="row g-4">
              <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="container-product">
                <form action="{{ route('admin.blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('POST')

                  <label for="blog_title">Title:</label>
                  <input type="text" name="title" value="{{ $blog->title }}" required />

                  <label for="blog_image">Image:</label>
                  <input type="file" name="image" />
                  @if($blog->image)
                      <img src="{{ asset('images/' . $blog->image) }}" alt="{{ $blog->title }}" width="100">
                  @endif

                  <label for="blog_start">Start:</label>
                  <input class="form-control" type="date" name="start_at" value="{{ \Carbon\Carbon::parse($blog->start_at)->format('Y-m-d') }}" required />

                  <label for="blog_end">End:</label>
                  <input class="form-control" type="date" name="end_at" value="{{ \Carbon\Carbon::parse($blog->end_at)->format('Y-m-d') }}" required />

                  <label for="product_category">Category:</label>
                  <select class="form-control" name="blogcate_id" required>
                      <option value="">Select Category</option>
                      @foreach($categories as $id => $name)
                          <option value="{{ $id }}" {{ $blog->blogcate_id == $id ? 'selected' : '' }}>{{ $name }}</option>
                      @endforeach
                  </select>

                  <label for="product_description">Content:</label>
                  <textarea id="editor" name="content" required>{{ $blog->content }}</textarea>

                  <input type="submit" value="Update" />
              </form>
                </div>
              </div>
            </div>
          </div>
          <!--//container-fluid-->
        </div>
        <!--//app-content-->
      </div>
    </section>

@endsession