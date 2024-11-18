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
                <h1 class="app-page-title mb-0">Thêm sản phẩm mới</h1>
              </div>
            </div>
            <!--//row-->
            <div class="row g-4">
              <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="container-product">
                  <form
                    th:action="@{/admin/products/create}"
                    th:object="${product}"
                    method="post"
                    enctype="multipart/form-data"
                  >
                    <label for="product_id">Mã sản phẩm:</label>
                    <input type="text" th:field="*{id}" required />

                    <label for="product_name">Tên sản phẩm:</label>
                    <input type="text" th:field="*{name}" required />

                    <label for="product_price">Đơn giá:</label>
                    <input type="number" th:field="*{price}" required />

                    <label for="product_quantity">Số lượng tồn:</label>
                    <input type="number" th:field="*{quantity}" required />

                    <label for="product_image">Hình ảnh sản phẩm:</label>
                    <input type="file" th:field="*{image}" />

                    <label for="product_category">Danh mục:</label>
                    <select th:field="*{categoryid}" required>
                      <option value="">Chọn danh mục</option>
                      <option
                        th:each="category : ${categories}"
                        th:value="${category.id}"
                        th:text="${category.name}"
                      ></option>
                    </select>

                    <label for="product_description">Mô tả sản phẩm:</label>
                    <textarea th:field="*{description}"></textarea>

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