@extends('layouts.mainAdmin')

@section('title', 'Admin Page')

<div class="app-wrapper">
	    
        <div class="container-xl">
                        @section('content')                   
                                <!-- Hiển thị thông báo thành công nếu có -->
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                        <div class="row g-3 mb-4 align-items-center justify-content-between">
                            <div class="col-auto">
                                <h1 class="app-page-title mb-0">Update Users </h1>
                            </div>
                        </div><!--//row-->	
                        <form action="{{ route('admin.User.update', $user->id) }}" method="POST">
                    @csrf
                    @method('POST')

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" name="address" id="address" class="form-control" value="{{ old('address', $user->address) }}">
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', $user->phone) }}">
                    </div>

                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="1" {{ old('status', $user->status) == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('status', $user->status) == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="role_id">Role</label>
                        <select name="role_id" id="role_id" class="form-control">
                            <option value="1" {{ old('role_id', $user->role_id) == 1 ? 'selected' : '' }}>Admin</option>
                            <option value="2" {{ old('role_id', $user->role_id) == 2 ? 'selected' : '' }}>Customer</option>
                            <option value="3" {{ old('role_id', $user->role_id) == 3 ? 'selected' : '' }}>Employee</option>
                        </select>
                    </div>

                    <div class="button-container">
                        <button type="submit" class="btn btn-primary">Update User</button>
                        <a href="{{ route('admin.User.index') }}" class="btn btn-secondary">Back</a>
                    </div>

                </form>
               
                </div>
                                                                
                        
        </div>
	    
    </div><!--//app-wrapper-->
    @endsection
    <!-- Link tới file JavaScript -->
   @stack('scripts')@push('scripts')
    <script src="{{ asset('js/custom.js') }}"></script>
    @endpush
