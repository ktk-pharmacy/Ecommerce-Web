@extends('admin.layouts.master', ['title' => 'Categories'])

@section('css')
<!-- Plugins css -->
<link href="{{ asset('assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/libs/jquery-toast-plugin/jquery-toast-plugin.min.css') }}" rel="stylesheet" type="text/css" />
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
                  <li class="breadcrumb-item"><a href="javascript: void(0);">Categories Management</a></li>
                  <li class="breadcrumb-item active">Categories</li>
               </ol>
            </div>
            <h4 class="page-title">Categories</h4>
         </div>
      </div>
   </div>
   <!-- end page title -->

   <div class="row">
      <div class="col-12">
         <div class="card">
            <div class="card-body">
               @can('category-create')
               <div class="float-right">
                  <a href="{{ route('admin.categories.create') }}?type=main-category">
                     <button type="button" class="btn btn-sm btn-blue waves-effect waves-light">
                        <i class="mdi mdi-plus-circle"></i> Add Main Category
                     </button>
                  </a>
                  <a href="{{ route('admin.categories.create') }}?type=sub-category" class="ml-1">
                     <button type="button" class="btn btn-sm btn-blue waves-effect waves-light ">
                        <i class="mdi mdi-plus-circle"></i> Add Subcategory
                     </button>
                  </a>
               </div>
               @endcan
               <h4 class="header-title mb-4">All Categories</h4>

               <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                  <thead>
                    <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Product Counts</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                  </thead>
                  @php
                        $index = 0;
                  @endphp
                  <tbody>
                     @foreach ($main_categories as $main_category)
                        <tr>
                            <td>{{ ++$index }}</td>
                            <td>
                                <b>{{ $main_category->name . ' (' . $main_category->group->name . ')' }}</b>
                            </td>
                            <td>3</td>
                            <td>{!! statusBadge($main_category->status, 'ACTIVEORINACTIVE') !!}</td>
                            <td>
                                @can('category-edit')
                                <a href="{{ route('admin.categories.edit', $main_category->id) }}?type=main-category" class="action-icon">
                                    <i class="mdi mdi-square-edit-outline"></i>
                                </a>
                                @endcan
                                @if (!$main_category->childs->count())
                                    @can('category-delete')
                                    <a
                                        href="javascript:void(0);"
                                        class="action-icon" 
                                        data-toggle="modal" 
                                        data-target="#deleteFormModal" 
                                        data-id="{{ $main_category->id }}"
                                        data-url="{{ route('admin.categories.destroy', $main_category->id) }}"
                                    >
                                        <i class="mdi mdi-delete"></i>
                                    </a>
                                    @endcan
                                @endif
                            </td>
                        </tr>
                        @foreach ($main_category->childs as $sub_category)
                            <tr>
                                <td>{{ ++$index }}</td>
                                <td>--{{ $sub_category->name }}</td>
                                <td>3</td>
                                <td>{!! statusBadge($sub_category->status, 'ACTIVEORINACTIVE') !!}</td>
                                <td>
                                    @can('category-edit')
                                    <a href="{{ route('admin.categories.edit', $sub_category->id) }}?type=sub-category" class="action-icon">
                                        <i class="mdi mdi-square-edit-outline"></i>
                                    </a>
                                    @endcan
                                    @can('category-delete')
                                    <a
                                        href="javascript:void(0);"
                                        class="action-icon"
                                        data-toggle="modal"
                                        data-target="#deleteFormModal"
                                        data-id="{{ $sub_category->id }}"
                                        data-url="{{ route('admin.categories.destroy', $sub_category->id) }}"
                                    >
                                        <i class="mdi mdi-delete"></i>
                                    </a>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
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