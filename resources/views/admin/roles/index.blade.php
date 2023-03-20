@extends('admin.layouts.master', ['title' => 'Roles'])

@section('css')
    <!-- Plugins css -->
    <link href="{{asset('assets/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/jquery-toast-plugin/jquery-toast-plugin.min.css')}}" rel="stylesheet" type="text/css" />

@endsection

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">
        
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Users Management</a></li>
                            <li class="breadcrumb-item active">Roles</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Roles</h4>
                </div>
            </div>
        </div>     
        <!-- end page title --> 

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        @can('role-create')
                        <a href="{{ route('admin.roles.create') }}">
                            <button type="button" class="btn btn-sm btn-blue waves-effect waves-light float-right">
                                <i class="mdi mdi-plus-circle"></i> Add Role
                            </button>
                        </a>
                        @endcan
                        <h4 class="header-title mb-4">All Roles</h4>

                        <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Role Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        
                        
                            <tbody>
                                @foreach ($roles as $key => $role)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $role->name }}</td>
                                        <td>
                                            @can('role-edit')
                                            <a href="{{ route('admin.roles.edit', $role->id) }}" class="action-icon">
                                                <i class="mdi mdi-square-edit-outline"></i>
                                            </a>
                                            @endcan
                                            @if($role->name != 'Superadmin')
                                                @can('role-delete')
                                                <a
                                                href="javascript:void(0);"
                                                class="action-icon"
                                                data-toggle="modal"
                                                data-target="#deleteFormModal"
                                                data-id="{{ $role->id }}"
                                                data-url="{{ url('admin/roles/'.$role->id)}} " 
                                                >
                                                    <i class="mdi mdi-delete"></i>
                                                </a>
                                                @endcan
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>
        <!-- end row-->
        
    </div> <!-- container -->
@endsection

@section('script')
    <!-- Plugins js-->
    <script src="{{asset('assets/libs/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('assets/libs/jquery-toast-plugin/jquery-toast-plugin.min.js')}}"></script>

    <!-- Page js-->
    <script src="{{asset('assets/js/pages/datatables.init.js')}}"></script>
    <script src="{{asset('assets/js/pages/toastr.init.js')}}"></script>
@endsection