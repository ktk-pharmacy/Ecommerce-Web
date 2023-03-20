@extends('admin.layouts.master', ['title' => 'Logistics'])

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
                  <li class="breadcrumb-item"><a href="javascript: void(0);">Logistics Management</a></li>
                  <li class="breadcrumb-item active">Logistics</li>
               </ol>
            </div>
            <h4 class="page-title">Logistics</h4>
         </div>
      </div>
   </div>
   <!-- end page title -->

   <div class="row">
      <div class="col-12">
         <div class="card">
            <div class="card-body">
               @can('logistics-create')
               <a href="{{ route('admin.logistics.create') }}" class="createLogistic">
                  <button type="button" class="btn btn-sm btn-blue waves-effect waves-light float-right">
                     <i class="mdi mdi-plus-circle"></i> Add Logistics
                  </button>
               </a>
               @endcan
               <h4 class="header-title mb-4">All Logistics</h4>

               <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                  <thead>
                     <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>City/Township</th>
                        <th>Min Order Total</th>
                        <th>Fee</th>
                        <th>Action</th>
                     </tr>
                  </thead>

                  <tbody>
                     @foreach ($logistics as $index => $logistic)
                     <tr>
                        <td>{{ ++$index }}</td>
                        <td>
                           <a href="{{ route('admin.logistics.edit', $logistic->id) }}">
                              {{ $logistic->type }}
                           </a>
                        </td>
                        <td>{{ $logistic->city->name .'/'. $logistic->township->name }}</td>
                        <td>{{ $logistic->min_order_total }}</td>
                        <td>{{ $logistic->delivery_fee }}</td>
                        <td>
                           @can('logistics-edit')
                           <a href="{{ route('admin.logistics.edit', $logistic->id) }}" class="action-icon" data-url="">
                              <i class="mdi mdi-square-edit-outline"></i>
                           </a>
                           @endcan

                           @can('logistics-delete')
                           <a href="javascript:void(0);" class="action-icon" data-toggle="modal" data-target="#deleteFormModal"
                              data-id="{{ $logistic->id }}" data-url="{{ route('admin.logistics.destroy', $logistic->id) }}">
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