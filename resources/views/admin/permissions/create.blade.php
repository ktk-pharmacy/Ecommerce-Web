@extends('admin.layouts.master', ['title' => 'Create Permission'])

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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Permissions</a></li>
                            <li class="breadcrumb-item active">Create Permission</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Create Permission</h4>
                </div>
            </div>
        </div>     
        <!-- end page title --> 

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form class="needs-validation" novalidate action="{{ route('admin.permissions.store') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="header-title mt-5 mt-sm-0">Permission Name</h4>
                                        <div class="form-group mt-3">
                                            <input type="text" class="form-control" name="name" placeholder="Enter permission name" required>
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                            <div class="invalid-feedback">
                                                Please enter permission name.
                                            </div>
                                        </div>
                                </div> <!-- end col -->

                                <div class="col-md-6">
                                    <h4 class="header-title mt-5 mt-sm-0">Assign Roles To Permission</h4>
                                    <div class="mt-3">
                                        @foreach ($roles as $role)
                                            <div class="custom-control custom-checkbox">
                                                <input name="roles[]" type="checkbox" class="custom-control-input" id="role{{ $role->id }}" value="{{ $role->id }}">
                                                <label class="custom-control-label" for="role{{ $role->id }}">{{ $role->name }}</label>
                                            </div>  
                                        @endforeach
                                    </div>
                                </div> <!-- end col -->
                            </div> <!-- end row -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="text-center mt-3 mb-3">
                                        <a href="{{ route('admin.permissions.index') }}"><button type="button" class="btn w-sm btn-light waves-effect">Cancel</button></a>
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