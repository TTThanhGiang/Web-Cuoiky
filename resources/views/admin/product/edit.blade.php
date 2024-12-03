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
                <h1 class="app-page-title mb-0">Update product</h1>
              </div>
            </div>
            <!--//row-->
            <div class="row g-4">
              <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="container-product">
                <form action="{{ route('admin.product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf

    <label for="product_id">Id:</label>
    <input type="text" name="id" value="{{ old('id', $product->id ?? '') }}" readonly />

    <label for="product_name">Product:</label>
    <input type="text" name="name" value="{{ old('name', $product->name ?? '') }}" required />

    <label for="product_price">Price:</label>
    <input type="number" name="price" value="{{ old('price', $product->price ?? '') }}" required />

    <label for="product_price">Discount:</label>
    <input type="number" name="discount" value="{{ old('discount', $product->discount ?? '0') }}" required />

    <label for="product_quantity">Quantity:</label>
    <input type="number" name="quantity" value="{{ old('quantity', $product->quantity ?? '') }}" required />

    <img
        style="max-width: 100px; max-height: 100px"
        src="{{ $product->image ? 'assets/'  .$product->image->path: 'assets/web/img/product/p1.jpg' }}"
    />

<label for="product_image">Image:</label>
<input
    type="file"
    name="image"
    id="product_image"
    accept="image/*"
    onchange="previewImage(event)"
/>

    <label for="product_category">Category:</label>
    <select name="category_id" required>
        <option value="{{ $product->category_id ?? '' }}" selected>{{ $product->category->name ?? 'Category' }}</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>

    <label for="product_description">Description:</label>
    <textarea name="description">{{ old('description', $product->description ?? '') }}</textarea>

    <input type="submit" value="Upload sản phẩm" />
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
