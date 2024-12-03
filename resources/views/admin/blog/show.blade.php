@extends('layouts.mainAdmin')

@section('title', 'List Product')

@section('content')    
<section>
    <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                <div class="row g-3 mb-4 align-items-center justify-content-between">
                    <div class="col-auto">
                        <h1 class="app-page-title mb-0">Blog Details</h1>
                    </div>
                </div>
                <!--//row-->
                <div class="row g-4">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="container-product">
                            <form>
                                <label for="blog_title">Title:</label>
                                <input type="text" name="title" value="{{ $blog->title }}" readonly />

                                <label for="blog_image">Image:</label>
                                @if($blog->image)
                                    <img src="{{ asset('images/' . $blog->image) }}" alt="{{ $blog->title }}" width="100">
                                @endif

                                <label for="blog_start">Start:</label>
                                <input class="form-control" type="date" name="start_at" value="{{ \Carbon\Carbon::parse($blog->start_at)->format('Y-m-d') }}" readonly />

                                <label for="blog_end">End:</label>
                                <input class="form-control" type="date" name="end_at" value="{{ \Carbon\Carbon::parse($blog->end_at)->format('Y-m-d') }}" readonly />

                                <label for="product_category">Category:</label>
                                <select class="form-control" name="blogcate_id" readonly>
                                    <option value="">Select Category</option>
                                    @foreach($categories as $id => $name)
                                        <option value="{{ $id }}" {{ $blog->blogcate_id == $id ? 'selected' : '' }}>{{ $name }}</option>
                                    @endforeach
                                </select>

                                <label for="product_description">Content:</label>
                                <textarea id="editor" name="content" readonly>{{ $blog->content }} </textarea>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection