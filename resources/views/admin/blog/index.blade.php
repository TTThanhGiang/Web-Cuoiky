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
                          <input type="text" id="search-orders" name="searchorders" class="form-control search-orders" placeholder="Search"/>
                        </div>
                        <div class="col-auto">
                          <button type="submit" class="btn app-btn-secondary"> Search</button>
                        </div>
                      </form>
                    </div>
                    <div class="col-auto">
                      <select class="form-select w-auto" name="category" >
                        <option value="all" selected="">All</option>
                        <option></option>
                      </select>
                    </div>
                    <!--//col-->
                    <div class="col-auto">
                      <a class="btn app-btn-secondary" href="#">
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
                             <th style="text-align: center; width: 400px ;">Blog</th>
                             <th style="text-align: center; width: 100px ;">Image</th>
                             <th style="text-align: center; width: 100px ;">Date</th>
                             <th style="text-align: center; width: 150px ;">Poster</th>
                             <th style="text-align: center; width: 100px ;">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Blog</td>
                            <td style="text-align: center;">
                                <img style="width: 100px; height: 100px" src="assets/web/img/blog/c1.jpg" alt="">
                            </td>
                            <td style="text-align: center;">23-11-2024</td>
                            <td style="text-align: center;">Thành Giang</td>
                            <td style="text-align: center;">    
                                <a style="color: red" href="#">Sửa</a>
                                <a style="color: red" href="#">Xóa</a>
                            </td>
                        </tr>
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