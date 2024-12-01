@extends('layouts.mainAdmin')

@section('title', 'Home Page')

@section('content')

<section>
    <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                <div class="row g-3 mb-4 align-items-center justify-content-between">
                    <div class="col-auto">
                        <h1 class="app-page-title mb-0">Add product</h1>
                    </div>
                </div>
                <!--//row-->
                <div class="row g-4">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="container-product">
                            <form
                                action="{{ route('admin.product.store') }}"
                                method="POST"
                                enctype="multipart/form-data"
                            >
                                @csrf

                                <label for="product_name">Name:</label>
                                <input type="text" name="name" value="" required />

                                <label for="product_price">Price:</label>
                                <input type="number" name="price" value="" required />

                                <label for="product_quantity">Quantity:</label>
                                <input type="number" name="quantity" value="" required />

                                <label for="product_image">Discount:</label>
                                <input type="number" name="discount" />

                                <label for="product_image">Image:</label>
                                <input type="file" name="image" />

                                <label for="product_category">Category:</label>
                                <select name="category_id" required>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>

                                <label for="product_description">Description:</label>
                                <textarea name="description"></textarea>

                                <input type="submit" value="Add product" />
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
