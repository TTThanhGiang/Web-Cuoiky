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
                <h1 class="app-page-title mb-0">Create Blog</h1>
              </div>
            </div>
            <!--//row-->
            <div class="row g-4">
              <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="container-product">
                <form action="{{ route('admin.blogs.store') }}" method="post" enctype="multipart/form-data">
                  @csrf

                  <label for="blog_title">Title:</label>
                  <input type="text" name="title" required />

                  <label for="blog_image">Image:</label>
                  <input type="file" name="image" required />

                  <label for="blog_start">Start:</label>
                  <input class="form-control" type="date" name="start_at" required />

                  <label for="blog_end">End:</label>
                  <input class="form-control" type="date" name="end_at" required />

                    <label for="product_category">Category:</label>
                    <select  name="blogcate_id" field="" required>
                      <option value="">Chọn danh mục</option>
                      @foreach($categories as $id => $name)
                          <option value="{{ $id }}">{{ $name }}</option>
                      @endforeach
                    </select>

                    <label for="product_description">Mô tả sản phẩm:</label>
                    <textarea  id= "editor" name="content"></textarea>

                    <input type="submit" value="Upload" />
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