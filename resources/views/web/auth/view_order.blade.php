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
                        <a href="single-product.html">Order Details</a>
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
                <h3>Orders Details</h3>
                <div class="row">
                        <div class="col-lg-4">
                            <div class="col-md-12 form-group p_star">
                                <input type="text" class="form-control" id="first" name="name" placeholder="Name"  value="{{ $order->name}}" readonly>
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" value="{{ $order->phone}}" readonly>
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="{{ $order->email}}" readonly>
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <input type="text" class="form-control" id="add1" name="address" placeholder="Address" value="{{ $order->address}}" readonly >
                            </div>
                            <div class="checkout_btn_inner d-flex align-items-center">
                                @if($order->delivery_status == 'pending' )
                                    <form action="{{ route('updateStatus')}}" method="POST">
                                        @csrf
                                        <input type="hidden" class="form-control" name="id" value="{{ $order->id}}">
                                        <button type="submit" class="gray_btn" style="background: -webkit-linear-gradient(90deg, #ffba00 0%, #ff6c00 100%); color:aliceblue;">Receive</button>
                                    </form>
                                @elseif($order->delivery_status == 'shipped' || $order->delivery_status == 'delivered')
                                    <a class="gray_btn" style="background: -webkit-linear-gradient(90deg, #ffba00 0%, #ff6c00 100%); color:aliceblue;" href="">Received <span>&#10003;</span></a>
                                @else
                                    <a class="gray_btn" href="">Canceled</a>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="order_box">
                                <h2>Your Order</h2>
                                <div class="cart_inner">
                                    <div class="table-responsive">
                                        @if(isset($orderItems) && $orderItems->count() > 0)
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col" style="padding-top: 10px; padding-bottom: 10px;">Product</th>
                                                        <th scope="col" style="padding-top: 10px; padding-bottom: 10px;">Price</th>
                                                        <th scope="col" style="padding-top: 10px; padding-bottom: 10px;">Quantity</th>
                                                        <th scope="col" style="padding-top: 10px; padding-bottom: 10px;">Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($orderItems as $item)
                                                    <tr>
                                                        <td style="padding-top: 5px; padding-bottom: 5px;">
                                                            <div class="media">
                                                                <div class="d-flex">
                                                                    <a href="{{ route('home.detail', $item->product->id)}}"><img src="{{ asset('assets/' . $item->product->image->path) }}" alt="" style="max-width:50px"></a>
                                                                </div>
                                                                <div class="media-body">
                                                                    <p>{{ $item->product->name }}</p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td style="padding-top: 5px; padding-bottom: 5px;">
                                                            <h5>${{ $item->price }}</h5>
                                                        </td>
                                                        <td style="padding-top: 5px; padding-bottom: 5px;">
                                                            <h5>{{ $item->quantity }}</h5>
                                                        </td>
                                                        <td style="padding-top: 5px; padding-bottom: 5px;">
                                                            <h5>${{ $item->price * $item->quantity }}</h5>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                    <tr class="bottom_button">
                                                        <td></td>
                                                        <td></td>
                                                        <td>
                                                            <h5>Subtotal</h5>
                                                        </td>
                                                        <td>
                                                        <h5>${{ $order->total_price }}</h5>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            @else
                                                <p>Your cart is empty!</p>
                                            @endif
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