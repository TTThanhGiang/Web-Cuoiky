@extends('layouts.mainAdmin')

@section('title', 'Admin Page')


<div class="app-wrapper">
	    
        <div class="container-xl">
			    
			    <div class="row g-3 mb-4 align-items-center justify-content-between">
				@section('content')                   
				<div class="app-content pt-3 p-md-3 p-lg-4">
		    <div class="container-xl">
			    
			    <div class="row g-3 mb-4 align-items-center justify-content-between">
				    <div class="col-auto">
			            <h1 class="app-page-title mb-0">Orders</h1>
				    </div>
				    <div class="col-auto">
					     <div class="page-utilities">
						    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
							    <div class="col-auto">
								<form action="{{ route('admin.order.search') }}" method="GET" class="table-search-form row gx-1 align-items-center">
								<div class="col-auto">
									<input type="text" id="search-orders" name="searchorders" class="form-control search-orders" placeholder="Search" value="{{ request()->input('searchorders') }}">
								</div>
								<div class="col-auto">
									<button type="submit" class="btn app-btn-secondary">Search</button>
								</div>
							</form>

					                
							    </div><!--//col-->
							   
							   
						    </div><!--//row-->
					    </div><!--//table-utilities-->
				    </div><!--//col-auto-->
			    </div><!--//row-->
		   			    
					    <div class="app-card app-card-orders-table mb-5">
						    <div class="app-card-body">
							    <div class="table-responsive">
									<table class="table mb-0 text-left">
										<thead>
											<tr>
												<th class="cell">id</th>
												<th class="cell">User_id</th>
												<th class="cell">Name</th>
												<th class="cell">address</th>
												<th class="cell">phone</th>
												<th class="cell">total_price</th>
												<th class="cell">payment_status</th>
												<th class="cell">delivery_status</th>
											</tr>
										</thead>
										<tbody>
										@foreach($orders as $order)
											<tr>
												<td class="cell">{{ $order->id }}</td>
												<td class="cell">{{ $order->user_id }}</td>
												<td class="cell">{{ $order->name }}</td>
												<td class="cell">{{ $order->address }}</td>
												<td class="cell">{{ $order->phone }}</td>
												<td class="cell">${{ number_format($order->total_price, 2) }}</td>											
												<td class="cell">
												@if($order->payment_status == 'Paid')
													<a style="color: green;">{{ $order->payment_status }}</a>  
												@elseif($order->payment_status == 'Pending')
													<a style="color: orange;">{{ $order->payment_status }}</a>  
												@elseif($order->payment_status == 'Refunded')
													<a style="color: red;">{{ $order->payment_status }}</a>  
												@else
													<a style="color: gray;">{{ $order->payment_status }}</a>
												@endif
											</td>

											<td class="cell">
												@if($order->delivery_status == 'Completed')
													<a style="color: blue;">{{ $order->delivery_status }}</a> 
												@elseif($order->delivery_status == 'Processing')
													<a style="color: purple;">{{ $order->delivery_status }}</a>  
												@elseif($order->delivery_status == 'shipped')
													<a style="color: darkblue;">{{ $order->delivery_status }}</a> 
												@else 
													<a style="color: gray;">{{ $order->delivery_status }}</a>
												@endif
											</td>
	
												<td>											
															<div style="display: flex; gap: 5px; align-items: stretch;">
																<!-- Nút View -->
																<a href="{{ route('admin.order.show', $order->id) }}" 
																class="btn btn-info btn-sm" 
																style="flex: none; width: 70px; height: 30px; text-align: center; padding: 5px 0;">
																	View
																</a>
																</div>
												</td>
												<td>
															<div style="display: flex; gap: 5px; align-items: stretch;">
																<!-- Nút View -->
																<a href="{{ route('admin.order.edit', $order->id) }}" 
																class="btn btn-info btn-sm" 
																style="flex: none; width: 70px; height: 30px; text-align: center; padding: 5px 0;">
																	Edit
																</a>
																</div>
												</td>
											@endforeach

										</tbody>
									</table>

						        </div><!--//table-responsive-->
						    </div><!--//app-card-body-->		
						</div><!--//app-card-->
			        </div><!--//tab-pane-->
				</div><!--//tab-content-->
				
				
			    
	
	    
</div><!--//app-wrapper-->
@endsection
