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
              <a href="{{ route('admin.order.index') }}" class="btn btn-secondary">Back</a>
                <h1 class="app-page-title mb-0">Edit User</h1>
              </div>
            </div>
            <!--//row-->
            <div class="row g-4">
              <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="container-product">
                <table class="table mb-0 text-left">
										<thead>
                                        <tr>
                                            <th>Product Name</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Total</th>
                                        </tr>
										</thead>
										<tbody>
                    @foreach($order->orderItems as $orderItem)
                      <tr>
                          <!-- Hiển thị tên sản phẩm từ quan hệ trong OrderItem -->
                          <td>{{ $orderItem->product->name }}</td>
                          <td>{{ $orderItem->quantity }}</td>
                          <td>${{ number_format($orderItem->price, 2) }}</td>
                          <td>${{ number_format($orderItem->quantity * $orderItem->price, 2) }}</td>
                      </tr>
                  @endforeach

										</tbody>
									</table>

                </div>
              </div>
            </div>
          </div>
          <!--//container-fluid-->
        </div>
        <!--//app-content-->
      </div>
@endsection

