@extends('admin.layouts.master', ['title' => 'Edit Role'])

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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Roles</a></li>
                            <li class="breadcrumb-item active">Edit Role</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Edit Role</h4>
                </div>
            </div>
        </div>     
        <!-- end page title --> 

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form class="needs-validation" novalidate action="{{ route('admin.roles.update', $role->id) }}" method="post">
                            @csrf
                            @method('patch')
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="header-title mt-5 mt-sm-0">Role Name</h4>
                                        <div class="form-group mt-3">
                                            <input type="text" class="form-control" name="name" value="{{ $role->name }}" placeholder="Enter role name" required>
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                            <div class="invalid-feedback">
                                                Please enter role name.
                                            </div>
                                        </div>
                                </div> <!-- end col -->

                                <div class="col-md-6">
                                    <h4 class="header-title mt-5 mt-sm-0">Assign Permissions To Role</h4>
                                    <div class="mt-3">
                                        @foreach ($permissions as $permission)
                                            <div class="custom-control custom-checkbox">
                                                <input name="permissions[]" type="checkbox" class="custom-control-input" id="permission{{ $permission->id }}" value="{{ $permission->id }}"
                                                @if (in_array($permission->id, $rolePermissions))
                                                   checked 
                                                @endif   
                                                >
                                                <label class="custom-control-label" for="permission{{ $permission->id }}">{{ $permission->name }}</label>
                                            </div>  
                                        @endforeach
                                    </div>
                                </div> <!-- end col -->
                            </div> <!-- end row -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="text-center mt-3 mb-3">
                                        <a href="{{ route('admin.roles.index') }}"><button type="button" class="btn w-sm btn-light waves-effect">Cancel</button></a>
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