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
                        <a href="single-product.html">Checkout</a>
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
                <h3>Billing Details</h3>
                <div class="row">
                        <div class="col-lg-6">
                        <form class="row contact_form" action="{{ route('checkout.order')}}" method="post" >
                            @csrf
                            <div class="col-md-12 form-group p_star">
                                <input type="text" class="form-control" id="first" name="name" placeholder="Name"  required>
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone"  required>
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <input type="text" class="form-control" id="email" name="email" placeholder="Email"  required>
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <input type="text" class="form-control" id="add1" name="address" placeholder="Address"  required>
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <button type="submit" class="primary-btn">Checkout</button>
                            </div>
                            
                            </form>
                        </div>
                        <div class="col-lg-6">
                            <div class="order_box">
                                <h2>Your Order</h2>
                                <ul class="list">
                                    <li><a href="#">Product <span>Total</span></a></li>
                                    @foreach($cartItems as $item)
                                        <li><a href="#">{{ $item->product->name}} <span class="middle">x {{ $item->quantity}}</span> <span class="last">${{ $item->price * $item->quantity }}</span></a></li>
                                    @endforeach
                                    </ul>
                                <ul class="list list_2">
                                    <li><a href="#">Subtotal <span>${{ $totalPrice }}</span></a></li>
                                    <?php
                                        $ship = ($totalPrice > 100) ? 0 : 3;
                                    ?>
                                    <li><a href="#">Shipping <span><?= $ship ?></span></a></li>
                                    <li><a href="#">Total <span>${{ $totalPrice + $ship }}</span></a></li>
                                </ul>
                            </div>
                        </div>
                </div>
                
            </div>
        </div>
    </section>

    <!--================End Checkout Area =================-->
@endsection