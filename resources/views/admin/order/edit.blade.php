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
                <h1 class="app-page-title mb-0">Edit Order</h1>
              </div>
            </div>
            <!--//row-->
            <div class="row g-4">
              <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="container-product">
                <form action="{{ route('admin.order.update', $order->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $order->name) }}" required>
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $order->email) }}" required>
            </div>

            <!-- Phone -->
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $order->phone) }}" required>
            </div>

            <!-- Address -->
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <textarea class="form-control" id="address" name="address" rows="3" required>{{ old('address', $order->address) }}</textarea>
            </div>

            <!-- Total Price -->
            <div class="mb-3">
                <label for="total_price" class="form-label">Total Price</label>
                <input type="number" step="0.01" class="form-control" id="total_price" name="total_price" value="{{ old('total_price', $order->total_price) }}" required>
            </div>

            <!-- Payment Status -->
            <div class="mb-3">
                <label for="payment_status" class="form-label">Payment Status</label>
                <select class="form-control" id="payment_status" name="payment_status" required>
                    <option value="pending" {{ $order->payment_status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="paid" {{ $order->payment_status == 'paid' ? 'selected' : '' }}>Paid</option>
                    <option value="failed" {{ $order->payment_status == 'failed' ? 'selected' : '' }}>Failed</option>
                    <option value="refunded" {{ $order->payment_status == 'refunded' ? 'selected' : '' }}>Refunded</option>
                </select>
            </div>

            <!-- Delivery Status -->
            <div class="mb-3">
                <label for="delivery_status" class="form-label">Delivery Status</label>
                <select class="form-control" id="delivery_status" name="delivery_status" required>
                    <option value="pending" {{ $order->delivery_status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="shipped" {{ $order->delivery_status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                    <option value="delivered" {{ $order->delivery_status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                    <option value="cancelled" {{ $order->delivery_status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>

            <div class="button-container">
                        <button type="submit" class="btn btn-primary">Update Order</button>
                        <a href="{{ route('admin.order.index') }}" class="btn btn-secondary">Back</a>
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
