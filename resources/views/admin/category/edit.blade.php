@extends('layouts.mainAdmin')

@section('title', 'Admin Page')

@section('content')
<div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
          <div class="container-xl">
          @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <div
              class="row g-3 mb-4 align-items-center justify-content-between"
            >
              <div class="col-auto">
                <h1 class="app-page-title mb-0">Edit Category</h1>
              </div>
            </div>
            <!--//row-->
            <div class="row g-4">
              <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="container-product">
                <form action="{{ route('admin.category.update', $category->id) }}" method="POST">
                    @csrf
                    @method('POST')

                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $category->name) }}" required>

                        <label for="description">Description</label>
                        <input type="text" name="description" id="description" class="form-control" value="{{ old('description', $category->description) }}">

                    <div class="button-container">
                        <button type="submit" class="btn btn-primary">Update Category</button>
                        <a href="{{ route('admin.category.index') }}" class="btn btn-secondary">Back</a>
                    </div>

                </form>

                </div>
              </div>
            </div>
          </div>
          <!--//container-fluid-->
        </div>
        <!--//app-content-->
      </div>
@endsection
@stack('scripts')@push('scripts')
<script src="{{ asset('js/custom.js') }}"></script>
@endpush
