
@extends('layouts.mainWeb')

@section('title', 'Home Page')

@section('content')
    <!-- Start Banner Area -->
	<section class="banner-area organic-breadcrumb">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
				<div class="col-first">
					<h1>Shop Category page</h1>
					<nav class="d-flex align-items-center">
						<a href="index.html">Home<span class="lnr lnr-arrow-right"></span></a>
						<a href="#">Shop<span class="lnr lnr-arrow-right"></span></a>
						<a href="category.html">Fashon Category</a>
					</nav>
				</div>
			</div>
		</div>
	</section>
	<!-- End Banner Area -->
	<div class="container">
		<div class="row">
			<div class="col-xl-3 col-lg-4 col-md-5">
				<div class="sidebar-categories">
					<div class="head">Products Category</div>
					<ul class="main-categories">
						<li class="main-nav-list">
							<a class="category-link {{ is_null($category) ? 'active' : '' }}" href="{{ route('category.products') }}">
								All<span class="number">({{ \App\Models\Product::count() }})</span>
							</a>
						</li>
						@foreach ($categories as $cat)
							<li class="main-nav-list">
								<a class="category-link {{ ($category && $cat->id === $category->id) ? 'active' : '' }}" href="{{ route('category.products', $cat->id) }}">
									{{ $cat->name }} <span class="number">({{ $cat->products_count }})</span>
								</a>
							</li>
						@endforeach

					</ul>
				</div>
				<!-- <div class="sidebar-filter mt-50">
					<div class="top-filter-head">Product Filters</div>
					<div class="common-filter">
						<div class="head">Brands</div>
						<form action="#">
							<ul>
								<li class="filter-list"><input class="pixel-radio" type="radio" id="apple" name="brand"><label for="apple">Apple<span>(29)</span></label></li>
								<li class="filter-list"><input class="pixel-radio" type="radio" id="asus" name="brand"><label for="asus">Asus<span>(29)</span></label></li>
								<li class="filter-list"><input class="pixel-radio" type="radio" id="gionee" name="brand"><label for="gionee">Gionee<span>(19)</span></label></li>
								<li class="filter-list"><input class="pixel-radio" type="radio" id="micromax" name="brand"><label for="micromax">Micromax<span>(19)</span></label></li>
								<li class="filter-list"><input class="pixel-radio" type="radio" id="samsung" name="brand"><label for="samsung">Samsung<span>(19)</span></label></li>
							</ul>
						</form>
					</div>
					<div class="common-filter">
						<div class="head">Color</div>
						<form action="#">
							<ul>
								<li class="filter-list"><input class="pixel-radio" type="radio" id="black" name="color"><label for="black">Black<span>(29)</span></label></li>
								<li class="filter-list"><input class="pixel-radio" type="radio" id="balckleather" name="color"><label for="balckleather">Black
										Leather<span>(29)</span></label></li>
								<li class="filter-list"><input class="pixel-radio" type="radio" id="blackred" name="color"><label for="blackred">Black
										with red<span>(19)</span></label></li>
								<li class="filter-list"><input class="pixel-radio" type="radio" id="gold" name="color"><label for="gold">Gold<span>(19)</span></label></li>
								<li class="filter-list"><input class="pixel-radio" type="radio" id="spacegrey" name="color"><label for="spacegrey">Spacegrey<span>(19)</span></label></li>
							</ul>
						</form>
					</div>
					<div class="common-filter">
						<div class="head">Price</div>
						<div class="price-range-area">
							<div id="price-range"></div>
							<div class="value-wrapper d-flex">
								<div class="price">Price:</div>
								<span>$</span>
								<div id="lower-value"></div>
								<div class="to">to</div>
								<span>$</span>
								<div id="upper-value"></div>
							</div>
						</div>
					</div>
				</div> -->
			</div>
			<div class="col-xl-9 col-lg-8 col-md-7">
				<!-- Start Filter Bar -->
				<div class="filter-bar d-flex flex-wrap align-items-center">
					<div class="sorting mr-auto">
						<form method="GET" action="{{ route('category.products', ['id' => request('id') ?? '']) }}">
							<select name="per_page" onchange="this.form.submit()">
								<option value="6" {{ request('per_page') == 6 ? 'selected' : '' }}>Show 6 products</option>
								<option value="9" {{ request('per_page') == 9 ? 'selected' : '' }}>Show 9 products</option>
								<option value="12" {{ request('per_page') == 12 ? 'selected' : '' }}>Show 12 products</option>
							</select>
						</form>
					</div>
					<div class="pagination">
						
					</div>
				</div>
				<!-- End Filter Bar -->
				<!-- Start Best Seller -->
				<section class="lattest-product-area pb-40 category-list">
					<div class="row">
						<!-- single product -->
						@forelse($products as $product)
						<div class="col-lg-4 col-md-6">
							<div class="single-product">
								<a href="{{ route('home.detail', $product->id)}}"><img class="img-fluid" src="{{ $product->image ? 'assets/'  .$product->image->path: 'assets/web/img/product/p1.jpg' }}" alt=""></a>
								<div class="product-details">
									<h6>{{ $product->name }}</h6>
									<div class="price">
										@if($product->discount && $product->discount > 0)
											<h6>{{ $product->discount }} $</h6>
											<h6 class="l-through">{{ $product->price }} $</h6>
										@else
											<h6>{{ $product->price }} $</h6>
										@endif
									</div>
									<div class="prd-bottom">
										<form id="add-to-cart-{{ $product->id }}" action="{{ route('cart.add') }}" method="POST" class="social-info">
											@csrf
											<input type="hidden" name="product_id" value="{{ $product->id }}">
											<input type="hidden" name="quantity" value="1">
											<a href="javascript:void(0);" onclick="document.getElementById('add-to-cart-{{ $product->id }}').submit();">
												<span class="ti-bag"></span>
												<p class="hover-text">add to bag</p>
											</a>
										</form>
										<a href="" class="social-info">
											<span class="lnr lnr-heart"></span>
											<p class="hover-text">Wishlist</p>
										</a>
										<a href="" class="social-info">
											<span class="lnr lnr-sync"></span>
											<p class="hover-text">compare</p>
										</a>
										<a href="" class="social-info">
											<span class="lnr lnr-move"></span>
											<p class="hover-text">view more</p>
										</a>
									</div>
								</div>
							</div>
						</div>
						@empty
						<div class="col-12 text-center">
							<p>No products found in this category.</p>
						</div>
						@endforelse

					</div>
				</section>
				<!-- End Best Seller -->
				<!-- Start Filter Bar -->
				@if ($products->hasPages())
					<div class="filter-bar d-flex flex-wrap align-items-center">
							<div class="pagination">
								{{ $products->links('vendor.pagination.bootstrap-4') }}
							</div>					
					</div>
				@endif
				<!-- End Filter Bar -->
			</div>
		</div>
	</div>
	<!-- Start related-product Area -->
	
	<!-- End related-product Area -->
	
	<!-- End related-product Area -->
@endsection
