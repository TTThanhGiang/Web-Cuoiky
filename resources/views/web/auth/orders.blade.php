@extends('layouts.mainWeb')

@section('title', 'Orders Page')

@section('content')
    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Shopping Cart</h1>
                    <nav class="d-flex align-items-center">
                        <a href="index.html">Home<span class="lnr lnr-arrow-right"></span></a>
                        <a href="category.html">Orders</a>
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
                @if(isset($orders))
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Order</th>
                                <th scope="col">Total Price</th>
                                <th scope="col">Payment Status</th>
                                <th scope="col">Delivery Status</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $item)
                            <tr>
                                <td>
                                    <h5>#{{ $item->id }}</h5>
                                </td>
                                <td>
                                    <h5>${{ $item->total_price }}</h5>
                                </td>
                                <td>
                                    <h5>{{ $item->payment_status}}</h5>
                                </td>
                                <td>
                                    <h5>{{ $item->delivery_status}}</h5>
                                </td>
                                <td>
                                @if ($item->payment_status == 'failed')
                                    <h5>Failed</h5>
                                @elseif ($item->delivery_status == 'cancelled')
                                    <h5>Cancelled</h5>
                                @elseif ($item->delivery_status == 'delivered')
                                    <h5>Delivered</h5>
                                @elseif ($item->payment_status == 'paid' && $item->delivery_status == 'shipped')
                                    <h5>Transit</h5>
                                @elseif ($item->payment_status == 'paid' && $item->delivery_status == 'pending')
                                    <h5>Shipment</h5>
                                @elseif ($item->payment_status == 'pending')
                                    <h5>Pending</h5>
                                @else
                                    <h5>Status: Unknown</h5>
                                @endif
                                </td>
                                <td>
                                    <h5>View</h5>
                                </td>
                            </tr>
                            @endforeach
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