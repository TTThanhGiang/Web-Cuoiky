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
                <h1 class="app-page-title mb-0">Products</h1>
              </div>
              <div class="col-auto">
                <div class="page-utilities">
                  <div
                    class="row g-2 justify-content-start justify-content-md-end align-items-center"
                  >
                    <div class="col-auto">
                      <form
                        class="table-search-form row gx-1 align-items-center"
                      >
                        <div class="col-auto">
                          <input
                            type="text"
                            id="search-orders"
                            name="searchorders"
                            class="form-control search-orders"
                            placeholder="Search"
                          />
                        </div>
                        <div class="col-auto">
                          <button type="submit" class="btn app-btn-secondary">
                            Search
                          </button>
                        </div>
                      </form>
                    </div>
                    <div class="col-auto">
                      <select
                        class="form-select w-auto"
                        name="category"
                        onchange="changeCategory(this)"
                      >
                        <option
                          value="all"
                          th:selected="${selectedCategoryId == null}"
                        >
                          All
                        </option>
                      </select>
                    </div>
                    <!--//col-->
                    <div class="col-auto">
                    <a
                        class="btn app-btn-secondary"
                        href="{{ route('admin.product.create') }}"
                    >
                        Add Product
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
              <div
                class="tab-pane fade show active"
                id="orders-all"
                role="tabpanel"
                aria-labelledby="orders-all-tab"
              >
                <div class="app-card app-card-orders-table shadow-sm mb-5">
                  <div class="app-card-body">
                    <div class="table-responsive">
                      <table class="table app-table-hover mb-0 text-left">
                        <thead>
                          <tr>
                            <th style="text-align: center; width: 80px">Id</th>
                            <th style="text-align: center; width: 150px">
                              Hình ảnh
                            </th>
                            <th style="text-align: center; width: 400px">
                              Tên sản phẩm
                            </th>
                            <th style="text-align: center; width: 100px">
                              Đơn giá
                            </th>
                            <th style="text-align: center; width: 100px">
                              Số lượng
                            </th>
                            <th style="text-align: center; width: 100px">
                              Hành động
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td style="text-align: center">{{ $product->id }}</td>
                                    <td style="text-align: center">
                                        <img
                                            style="max-width: 100px; max-height: 100px"
                                            src="{{ asset('assets/web/img/product/' . $product->image) }}"
                                            alt=""
                                        />
                                    </td>
                                    <td>{{ $product->name }}</td>
                                    <td style="text-align: center">{{ number_format($product->price, 0, ',', '.') }} VND</td>
                                    <td style="text-align: center">{{ $product->quantity }}</td>
                                    <td style="text-align: center">
                                        <a
                                            style="color: red"
                                            href="{{ route('admin.product.edit', $product->id) }}"
                                        >
                                            Update
                                        </a>
                                        <form action="{{ route('admin.product.delete', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure to delete this product?');">
    @csrf
    @method('DELETE')
    <button type="submit" style="color: red; background: none; border: none; cursor: pointer;">Delete</button>
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
