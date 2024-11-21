@extends('layouts.mainAdmin')

@section('title', 'Admin Page')

@section('content')
<div class="app-wrapper">
	    
<div class="container-xl">
			    
			    <div class="row g-3 mb-4 align-items-center justify-content-between">
				@section('content')                   
                                <!-- Hiển thị thông báo thành công nếu có -->
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
				    <div class="col-auto">
			            <h1 class="app-page-title mb-0">List Users</h1>
				    </div>
				    <div class="col-auto">
					     <div class="page-utilities">
						    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
							    <div class="col-auto">
								    <form class="table-search-form row gx-1 align-items-center">
					                    <div class="col-auto">
					                        <input type="text" id="search-orders" name="searchorders" class="form-control search-orders" placeholder="Search">
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
				<div class="tab-content" id="orders-table-tab-content">
			        <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
					    <div class="app-card app-card-orders-table shadow-sm mb-5">
						    <div class="app-card-body">
							    <div class="table-responsive">
							        <table class="table app-table-hover mb-0 text-left">
										<thead>
											<tr>
												<th class="cell">Id</th>
												<th class="cell">Name</th>
												<th class="cell">Address</th>
												<th class="cell">Email</th>
												<th class="cell">Status</th>
                                                <th class="cell">Action</th>
											</tr>
										</thead>	
										<tbody>
                                        @foreach($users as $user)
                                                    <tr>
                                                        <td class="cell">{{ $user->id }}</td>
                                                        <td class="cell">{{ $user->name }}</td>
                                                        <td class="cell">{{ $user->address }}</td> <!-- Địa chỉ -->
                                                        <td class="cell">{{ $user->email }}</td>
                                                        <td class="cell">{{ $user->status == 1 ? 'Active' : 'Inactive' }}</td> <!-- Trạng thái -->
                                                        <td>
														<div style="display: flex; gap: 5px;">
															<a href="{{ route('admin.User.edit', $user->id) }}" class="btn btn-info btn-sm" style='width: 40px'>View</a>
															<form action="{{ route('admin.User.delete', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete?')">
																@csrf
																@method('DELETE')
																<button type="submit" class="btn btn-danger btn-sm">Delete</button>
															</form>
														</div>
														</td>

                                                    </tr>
                                          @endforeach
		
										</tbody>
									</table>
						        </div><!--//table-responsive-->
						       						    
			    
		    </div>
	    
    </div><!--//app-wrapper-->
@endsection
@section('scripts')
    <script src="{{ asset('js/userToggle.js') }}"></script>
@endsection
