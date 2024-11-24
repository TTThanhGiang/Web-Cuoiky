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
                  <form action="" object="" method="post" enctype="multipart/form-data">

                    <label for="blog_title">Title:</label>
                    <input type="text" name="name" required />

                    <label for="blog_image">Image:</label>
                    <input type="file" name="image" required />

                    <label for="blog_image">Start:</label>
                    <input class="form-control" type="date" name="start" required />

                    <label for="blog_image">End:</label>
                    <input class="form-control" type="date" name="end" required />


                    <label for="product_category">Category:</label>
                    <select field="" required>
                      <option value="">Chọn danh mục</option>
                      <option
                      ></option>
                    </select>

                    <label for="product_description">Mô tả sản phẩm:</label>
                    <textarea  id= "editor" name="description"></textarea>

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