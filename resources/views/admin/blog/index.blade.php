@extends('layouts.mainAdmin')

@section('title', 'List Product')

@section('content')    
<section>
      <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
          <div class="container-xl">
            <div
              class="row g-3 mb-4 align-items-center justify-content-between"
            >
              <div class="col-auto">
                <h1 class="app-page-title mb-0">Blog</h1>
              </div>
              <div class="col-auto">
                <div class="page-utilities">
                  <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                    <div class="col-auto">
                      <form class="table-search-form row gx-1 align-items-center">
                        <div class="col-auto">
                        <input type="text" name="search" class="form-control" placeholder="Search blogs" value="{{ request('search') }}">
                        </div>
                        <div class="col-auto">
                          <button type="submit" class="btn app-btn-secondary"> Search</button>
                        </div>
                      </form>
                    </div>
                    <div class="col-auto">
                        <select class="form-select w-auto" name="category">
                            <option value="all" selected="">All</option>
                            @foreach($categories as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!--//col-->
                    <div class="col-auto">
                      <a class="btn app-btn-secondary" href="{{route('admin.blogs.create')}}">
                        Add Blog
                      </a>
                    </div>
                  </div>
                  <!--//row-->
                </div>
                <!--//table-utilities-->
              </div>
              <!--//col-auto-->
            </div>
            <!--//row-->

            <div class="tab-content" id="orders-table-tab-content">
              <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                <div class="app-card app-card-orders-table shadow-sm mb-5">
                  <div class="app-card-body">
                    <div class="table-responsive">
                      <table class="table app-table-hover mb-0 text-left">
                        <thead>
                        <tr>
                             <th style="text-align: center; width: 400px ;">Title</th>
                             <th style="text-align: center; width: 100px ;">Image</th>
                             <th style="text-align: center; width: 100px ;">Date</th>
                             <th style="text-align: center; width: 150px ;">Poster</th>
                             <th style="text-align: center; width: 100px ;">Category</th>
                        </tr>
                        </thead>
                        <tbody> 
                        @foreach($blogs as $blog) 
                          <tr>
                          <td><a href="{{ route('admin.blogs.show', $blog->id) }}">{{ $blog->title }}</a></td>
                              <td>
                                  @if($blog->image)
                                      <img src="{{ asset('images/' . $blog->image) }}" alt="" width="100">
                                  @endif
                              </td>
                              <td>{{ \Carbon\Carbon::parse($blog->start_at)->format('Y-m-d') }}</td>        
                              <td style="text-align: center;">{{ $blog->poster_id }}</td>
                              <td style="text-align: center;">{{ $blog->category->name }}</td>
                              <td style="text-align: center;">
                                  <a  href="{{ route('admin.blogs.edit', $blog->id) }}" class="btn btn-primary">Edit</a>
                              </td>
                              <td style="text-align: center;">
                                  <form style="align-items: center;" action="{{ route('admin.blogs.delete', $blog->id) }}" method="post">
                                      @csrf
                                      @method('DELETE')
                                      <input type="submit" value="Delete" class="btn btn-danger" onclick="return confirm('Are you sure?')">
                                  </form>
                              </td>
                          </tr>
                        
                      @endforeach
                        </tbody>
                      </table>
                    </div>
                    <!--//table-responsive-->
                  </div>
                  <!--//app-card-body-->
                </div>
                <!--//app-card-->
              </div>
              <!--//tab-pane-->
            </div>
            <!--//tab-content-->
          </div>
          <!--//container-fluid-->
        </div>
        <!--//app-content-->
      </div>
      <!--//app-wrapper-->
    </section>
    <!-- End -->
@endsection