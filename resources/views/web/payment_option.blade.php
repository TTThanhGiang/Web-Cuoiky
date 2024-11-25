@extends('layouts.mainWeb')

@section('title', 'Home Page')

@section('content')
     <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Checkout</h1>
                    <nav class="d-flex align-items-center">
                        <a href="index.html">Home<span class="lnr lnr-arrow-right"></span></a>
                        <a href="single-product.html">Payment</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->

    <!--================Checkout Area =================-->
    <section class="checkout_area section_gap">
        <div class="container">
            <div class="billing_details">
                <h3>Order payment</h3>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="order_box">
                            <h2>Your Order</h2>
                            <ul class="list">
                                <li><a href="#">Product <span>Total</span></a></li>
                                        <?php
                                            $total = 0;
                                        ?>
                                    @foreach($orderItems as $item)
                                        <?php
                                            $total += $item->price;
                                        ?>
                                        <li><a href="#">{{ $item->product->name}} <span class="middle">x {{ $item->quantity}}</span> <span class="last">${{ $item->price * $item->quantity }}</span></a></li>
                                    @endforeach
                                    <li><a href="#">Ship <span class="last">${{  $currentOrder->total_price - $total }}</span></a></li>
                            </ul>
                            <ul class="list list_2">
                                <li><a href="#">Subtotal <span>${{ $currentOrder->total_price }}</span></a></li>
                            </ul>
    
                            <p>Name: {{ $currentOrder->name }}</p>
                            <p>Phone: {{ $currentOrder->phone }}</p>
                            <p>Email: {{ $currentOrder->email }}</p>
                            <p>Address: {{ $currentOrder->address }}</p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="order_box">
                            <h2>Choose Payment Method</h2>
                            <div >
                                <div class="">
                                    <form action="{{ route('checkout.vnpay_payment')}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="order_id" value="{{ $currentOrder->id }}">
                                        <input type="hidden" name="total_price" value="{{ $currentOrder->total_price }}">
                                        <input type="hidden" name="order_info" value="Order payment #{{ $currentOrder->id }}">
                                        <button class="primary-btn" type="submit" name="redirect" >VNPay Payment</button>
                                    </form>
                                    
                                </div>
                                <div class="">
                                <form action="{{ route('checkout.cash_payment')}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="order_id" value="{{ $currentOrder->id }}">
                                        <input type="hidden" name="total_price" value="{{ $currentOrder->total_price }}">
                                        <button class="primary-btn" type="submit" name="redirect" >Payment upon receipt</button>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                    
                </div>
                
            </div>
        </div>
    </section>

    <!--================End Checkout Area =================-->
@endsection