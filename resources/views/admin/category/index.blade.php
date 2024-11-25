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
			            <h1 class="app-page-title mb-0">List Category</h1>
				    </div>
				    <div class="col-auto">
					     <div class="page-utilities">
						    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
							    <div class="col-auto">
								<form action="#" method="" class="table-search-form row gx-1 align-items-center">
								<div class="col-auto">
									<input type="text" id="search-users" name="searchusers" class="form-control search-orders" placeholder="Search" value="{{ request()->input('searchorders') }}">
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
												<th class="cell">Description</th>
                                                <th class="cell">Action</th>
											</tr>
										</thead>
										<tbody>
                                        @foreach($categories as $category)
                                                    <tr>
                                                        <td class="cell">{{ $category->id }}</td>
                                                        <td class="cell">{{ $category->name }}</td>
                                                        <td class="cell">{{ $category->description }}</td> <!-- Địa chỉ -->
                                                        <td>
															<div style="display: flex; gap: 5px; align-items: stretch;">

																<a href="{{ route('admin.category.edit', $category->id) }}"
																class="btn btn-info btn-sm"
																style="flex: none; width: 70px; height: 30px; text-align: center; padding: 5px 0;">
																	View
																</a>

																<!-- Form Delete -->
																<form action="{{ route('admin.category.delete', $category->id) }}"
																	method="POST"
																	onsubmit="return confirm('Are you sure you want to delete?')"
																	style="flex: none; width: 70px; height: 30px">
																	@csrf
																	@method('DELETE')
																	<button type="submit"
																			class="btn btn-danger btn-sm"
																			style="width: 100%;height: 100%; padding: 5px 0;">
																		Delete
																	</button>
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
