@extends('admin.layouts.master', ['title' => 'Products'])

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
                  <li class="breadcrumb-item"><a href="javascript: void(0);">Products Management</a></li>
                  <li class="breadcrumb-item active">Products</li>
               </ol>
            </div>
            <h4 class="page-title">Products</h4>
         </div>
      </div>
   </div>
   <!-- end page title -->

   <div class="row">
      <div class="col-12">
         <div class="card">
            <div class="card-body">
               @can('product-create')
               <a href="{{ route('admin.products.create') }}" class="createBrand">
                  <button type="button" class="btn btn-sm btn-blue waves-effect waves-light float-right">
                     <i class="mdi mdi-plus-circle"></i> Add Product
                  </button>
               </a>
               @endcan
               <h4 class="header-title mb-2">All Products</h4>

               <a href="{{ route('admin.products.export') }}" class="btn btn-secondary mb-2">Export Excel</a>
               <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                  <thead>
                     <tr>
                        <th>Product Code</th>
                        <th>Name</th>
                        <th>Brand</th>
                        <th>Main/Sub Category</th>
                        <th>Price</th>
                        <th>Sale Price</th>
                        <th>Stock</th>
                        <th>New</th>
                        <th>Status</th>
                        <th>Action</th>
                     </tr>
                  </thead>

                  <tbody>
                     @foreach ($products as $index => $product)
                     <tr>
                        <td>{{ $product->product_code }}</td>
                        <td>
                           <a href="{{ route('admin.products.edit', $product->id) }}">{{ $product->name }}</a>
                        </td>
                        <td>{{ $product->brand->name }}</td>
                        <td>
                           {{ $product->sub_category->parent->name }}/{{ $product->sub_category->name??'null' }}
                        </td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->sale_price }}</td>
                        <td>{{ $product->stock }}</td>
                        <td>
                           @if ($product->is_new)
                              <h5><span class="badge badge-success">New</span></h5>
                           @endif
                        </td>
                        <td>{!! statusBadge($product->status, 'ACTIVEORINACTIVE') !!}</td>
                        <td>
                           @can('product-edit')
                           <a href="{{ route('admin.products.edit', $product->id) }}" class="action-icon"
                              data-url="">
                              <i class="mdi mdi-square-edit-outline"></i>
                           </a>
                           @endcan

                           @can('product-delete')
                           <a href="javascript:void(0);" class="action-icon" data-toggle="modal" data-target="#deleteFormModal"
                              data-id="{{ $product->id }}" data-url="{{ route('admin.products.destroy', $product->id) }}">
                              <i class="mdi mdi-delete"></i>
                           </a>
                           @endcan
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
