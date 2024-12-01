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
                <h1 class="app-page-title mb-0">Add category</h1>
              </div>
            </div>
            <!--//row-->
            <div class="row g-4">
              <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="container-category">
                <form action="{{ route('admin.category.store') }}" method="POST">
                    @csrf
                    @method('POST')

                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="" required>

                        <label for="description">Description</label>
                        <input type="text" name="description" id="description" class="form-control" value="">

                    <div class="button-container">
                        <button type="submit" class="btn btn-primary">Add Category</button>
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
    </section>

@endsession
