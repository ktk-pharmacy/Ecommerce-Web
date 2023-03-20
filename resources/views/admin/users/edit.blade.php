@extends('admin.layouts.master', ['title' => 'Edit User'])

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">
        
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">User Management</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Users</a></li>
                            <li class="breadcrumb-item active">Edit User</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Edit User</h4>
                </div>
            </div>
        </div>     
        <!-- end page title --> 

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form class="parsley-examples" action="{{ route('admin.users.update', $user->id) }}" method="post">
                            @csrf
                            @method('patch')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="userName">User Name<span class="text-danger">*</span></label>
                                        <input type="text" name="name" parsley-trigger="change" required
                                                placeholder="Enter user name" class="form-control" id="userName" value="{{ $user->name }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="emailAddress">Email address<span class="text-danger">*</span></label>
                                        <input type="email" name="email" parsley-trigger="change" required
                                                placeholder="Enter email" class="form-control" id="emailAddress" value="{{ $user->email }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="pass1">Password<span class="text-danger">*</span></label>
                                        <input id="pass1" type="password" name="password" placeholder="Password"
                                                class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="passWord2">Confirm Password <span class="text-danger">*</span></label>
                                        <input data-parsley-equalto="#pass1" type="password" name="confirm-password"
                                                placeholder="Password" class="form-control" id="passWord2">
                                    </div>
                                </div> <!-- end col -->

                                <div class="col-md-6">
                                    <h4 class="header-title mt-5 mt-sm-0">Assign Roles To User</h4>
                                    <div class="mt-3">
                                        @foreach ($roles as $role)
                                            <div class="custom-control custom-checkbox">
                                                <input name="roles[]" type="checkbox" class="custom-control-input" id="role{{ $role->id }}" value="{{ $role->name }}"
                                                @if (in_array($role->id, $userRole))
                                                   checked 
                                                @endif
                                                >
                                                <label class="custom-control-label" for="role{{ $role->id }}">{{ $role->name }}</label>
                                            </div>  
                                        @endforeach
                                    </div>
                                </div> <!-- end col -->
                            </div> <!-- end row -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="text-center mt-3 mb-3">
                                        <a href="{{ route('admin.users.index') }}"><button type="button" class="btn w-sm btn-light waves-effect">Cancel</button></a>
                                        <button type="submit" class="btn w-sm btn-success waves-effect waves-light">Save</button>
                                    </div>
                                </div> <!-- end col -->
                            </div>
                        </form>

                    </div> <!-- end card-body-->
                </div> <!-- end card -->
            </div> <!-- end col -->
        </div>
        <!-- end row -->
        
    </div> <!-- container -->
@endsection

@section('script')
    <!-- Plugins js-->
    <script src="{{asset('assets/libs/parsleyjs/parsleyjs.min.js')}}"></script>

    <!-- Page js-->
    <script src="{{asset('assets/js/pages/form-validation.init.js')}}"></script>
@endsection