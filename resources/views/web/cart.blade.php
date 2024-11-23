@extends('layouts.mainWeb')

@section('title', 'Home Page')

@section('content')
    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Shopping Cart</h1>
                    <nav class="d-flex align-items-center">
                        <a href="index.html">Home<span class="lnr lnr-arrow-right"></span></a>
                        <a href="category.html">Cart</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->

    <!--================Cart Area =================-->
    <section class="cart_area">
        <div class="container">
            <div class="cart_inner">
                <div class="table-responsive">
                @if(isset($cartItems) && $cartItems->count() > 0)
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Product</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Total</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($cartItems as $item)
                            <tr>
                                <td>
                                    <div class="media">
                                        <div class="d-flex">
                                            <a href="{{ route('home.detail', $item->product->id)}}"><img src="{{ asset('assets/' . $item->product->image->path) }}" alt="" style="max-width:100px"></a>
                                        </div>
                                        <div class="media-body">
                                            <p>{{ $item->product->name }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <h5>${{ $item->price }}</h5>
                                </td>
                                <td>
                                <div class="product_count">
                                    <form action="{{ route('cart.update') }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        <input type="hidden" name="cart_item_id" value="{{ $item->id }}">
                                        <input type="hidden" name="action" value="decrease">
                                        <button class="reduced items-count" type="submit">
                                            <i class="lnr lnr-chevron-down"></i>
                                        </button>
                                    </form>

                                    <input type="text" name="qty" id="quantity-{{ $item->id }}" maxlength="12" value="{{ $item->quantity }}" 
                                        title="Quantity:" class="input-text qty" readonly>

                                    <form action="{{ route('cart.update') }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        <input type="hidden" name="cart_item_id" value="{{ $item->id }}">
                                        <input type="hidden" name="action" value="increase">
                                        <button class="increase items-count" type="submit">
                                            <i class="lnr lnr-chevron-up"></i>
                                        </button>
                                    </form>
                                </div>
                                
                                </td>
                                <td>
                                    <h5>${{ $item->price * $item->quantity }}</h5>
                                </td>
                                <td>
                                <form action="{{ route('cart.update') }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        <input type="hidden" name="cart_item_id" value="{{ $item->id }}">
                                        <input type="hidden" name="action" value="remove">
                                        <button type="submit" class="icon-btn">
                                            <i class="lnr lnr-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach


                            <tr class="bottom_button">
                                <td>
                                    
                                </td>
                                <td>

                                </td>
                                <td>
                                    <h5>Subtotal</h5>
                                </td>
                                <td>
                                <h5>${{ $totalPrice }}</h5>
                                </td>
                            </tr>
                            <tr class="out_button_area">
                                <td>

                                </td>
                                <td>

                                </td>
                                <td>
                                    
                                </td>
                                <td>
                                    <div class="checkout_btn_inner d-flex align-items-center">
                                        <a class="gray_btn" href="#">Shopping</a>
                                        <a class="primary-btn" href="#">Proceed to checkout</a>
                                    </div>
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
    </section>
    <!--================End Cart Area =================-->
@endsection