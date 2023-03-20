@extends('admin.layouts.master', ['title' => 'Slider'])

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
                  <li class="breadcrumb-item"><a href="javascript: void(0);">Advertisements</a></li>
                  <li class="breadcrumb-item active">Slider</li>
               </ol>
            </div>
            <h4 class="page-title">Slider</h4>
         </div>
      </div>
      {{-- <div id="result">
         Event result:
      </div> --}}
   </div>
   <!-- end page title -->

   <div class="row">
      <div class="col-12">
         <div class="card">
            <div class="card-body">
               @can('ads-slider-create')
               <a href="{{ route('admin.ads.create', 'slider') }}">
                  <button type="button" class="btn btn-sm btn-blue waves-effect waves-light float-right">
                     <i class="mdi mdi-plus-circle"></i> Add new
                  </button>
               </a>
               @endcan
               <h4 class="header-title mb-4">All</h4>

               <table id="custom-datatable" class="table table-striped dt-responsive nowrap w-100">
                  <thead>
                     <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>URL</th>
                        <th>Sorting</th>
                        <th>Status</th>
                        <th>Action</th>
                     </tr>
                  </thead>


                  <tbody>
                     @foreach ($data as $key => $slider)
                     <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $slider->name }}</td>
                        <td>
                           <img class="default-lazy" src="{{ asset('assets/images/loading.gif') }}" data-src="{{ $slider->image_url }}" width="50">
                        </td>
                        <td>{{ $slider->link }}</td>
                        <td>{{ $slider->sorting }}</td>
                        <td>
                           <div class="custom-control custom-switch">
                              <input type="checkbox" name="status"
                                 data-url="{{ route('admin.ads.update.status', ['slider', $slider->id]) }}"
                                 data-left-sidebar-id="{{ $slider->id }}" class="custom-control-input leftSidebarStatus"
                                 id="leftSidebarStatus_{{ $slider->id }}" @checked($slider->status)>
                              <label class="custom-control-label" for="leftSidebarStatus_{{ $slider->id }}"></label>
                           </div>
                        </td>
                        <td>
                           @can('ads-sidebar-edit')
                           <a class="action-icon editads" href="{{ route('admin.ads.edit', ['slider', $slider->id]) }}">
                              <i class="mdi mdi-square-edit-outline"></i>
                           </a>
                           @endcan
                           @can('ads-sidebar-delete')
                           <a href="javascript:void(0);" class="action-icon" data-toggle="modal" data-target="#deleteFormModal"
                              data-id="{{ $slider->id }}" data-url="{{ route('admin.ads.destroy', ['slider', $slider->id]) }} ">
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
<script src="{{ asset('assets/libs/jquery-lazy/jquery.lazy.min.js') }}"></script>
<script src="{{asset('assets/js/pages/toastr.init.js')}}"></script>

<script>
   $(function () {
      $('.default-lazy').lazy({
         scrollDirection: 'both',
         effect: 'fadeIn',
         effectTime: 600,
         threshold: 0,
         onError: function(element) {
            console.log('error loading ' + element.data('src'));
         }
      });
      
      $('input[type=checkbox][name="status"]').change(function() {
            let ads_id = $(this).data('ads-id');
            let url = $(this).data('url');

            event.preventDefault();

            $.ajaxSetup({
               headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
            });

            $.ajax({
               type: "POST",
               url: url,
               success: function (data) {   
                  if (data.status == 'success') {
                        $.NotificationApp.send("Well Done!", data.msg, 'top-right', '#5ba035', 'success');
                  } else {
                        $.NotificationApp.send("Oh snap!", data.msg, 'top-right', '#bf441d', 'error');
                  }
               },
               error: function (data) {
                  console.log('Error:', data);
               }
            });
      });

      $('#custom-datatable').DataTable({
            responsive: true,
            rowReorder: true,
            "language": {
               "paginate": {
                  "previous": "<i class='mdi mdi-chevron-left'>",
                  "next": "<i class='mdi mdi-chevron-right'>"
               }
            },
            "drawCallback": function () {
               $('.dataTables_paginate > .pagination').addClass('pagination-rounded');
            }
      });

   });
</script>
@endsection