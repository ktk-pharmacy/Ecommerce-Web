@extends('admin.layouts.master', ['title' => 'Brands'])

@section('css')
<!-- Plugins css -->
<link href="{{ asset('assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/libs/jquery-toast-plugin/jquery-toast-plugin.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/libs/dropify/dropify.min.css')}}" rel="stylesheet" type="text/css" />
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
                  <li class="breadcrumb-item"><a href="javascript: void(0);">Brands Management</a></li>
                  <li class="breadcrumb-item active">Brands</li>
               </ol>
            </div>
            <h4 class="page-title">Brands</h4>
         </div>
      </div>
   </div>
   <!-- end page title -->

   <div class="row">
      <div class="col-12">
         <div class="card">
            <div class="card-body">
               @can('brand-create')
               <a href="javascript:void(0)" data-url="{{ route('admin.brands.store') }}" class="createBrand">
                  <button type="button" class="btn btn-sm btn-blue waves-effect waves-light float-right">
                     <i class="mdi mdi-plus-circle"></i> Add Brand
                  </button>
               </a>
               @endcan
               <h4 class="header-title mb-4">All Brands</h4>

               <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                  <thead>
                     <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Status</th>
                        <th>Action</th>
                     </tr>
                  </thead>

                  <tbody>
                     @foreach ($brands as $index => $brand)
                         <tr>
                           <td>{{ ++$index }}</td>
                           <td>{{ $brand->name }}</td>
                           <td>
                              <img src="{{ asset($brand->image_url) }}" alt="{{ $brand->name }}'s image" width="35">
                           </td>
                           <td>{!! statusBadge($brand->status, 'ACTIVEORINACTIVE') !!}</td>
                           <td>
                              @can('brand-edit')
                              <a 
                                 href="javascript:void(0);"
                                 class="action-icon editBrand"
                                 data-brand-name="{{ $brand->name }}"
                                 data-brand-image="{{ asset($brand->image_url) }}"
                                 data-brand-status="{{ $brand->status }}"
                                 data-url="{{ route('admin.brands.update', $brand->id) }}"
                              >
                                 <i class="mdi mdi-square-edit-outline"></i>
                              </a>
                              @endcan
                        
                              @can('brand-delete')
                              <a 
                                 href="javascript:void(0);"
                                 class="action-icon" 
                                 data-toggle="modal" 
                                 data-target="#deleteFormModal" 
                                 data-id="{{ $brand->id }}"
                                 data-url="{{ route('admin.brands.destroy', $brand->id) }}"
                                 >
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

@section('modal')
   @include('admin.layouts.shared.modals.brand')
@endsection

@section('script')
<!-- Plugins js-->
<script src="{{asset('assets/libs/datatables/datatables.min.js')}}"></script>
<script src="{{asset('assets/libs/jquery-toast-plugin/jquery-toast-plugin.min.js')}}"></script>
<script src="{{asset('assets/libs/dropify/dropify.min.js')}}"></script>

<!-- Page js-->
<script src="{{asset('assets/js/pages/datatables.init.js')}}"></script>
<script src="{{asset('assets/js/pages/toastr.init.js')}}"></script>

<script>
   $(document).ready(function() {
      //Create Brand
      $('body').on('click', '.createBrand', function () {
            let url = $(this).data('url');
            $('#brand_name').val('');
            //remove old dropify wrapper
            $('.dropify-wrapper').remove();
            $('.brand_input').append('<input type="file" class="dropify form-control" data-max-file-size="1M" id="brand_image" name="brand_image" data-allowed-file-extensions="jpeg jpg png"  required/>')

            initializeDropifyAndShowModal(url, 'post');    //reinitialize dropify
      })

      //Edit Brand
      $('body').on('click', '.editBrand', function () {
            let url = $(this).data('url');
            let brand_name = $(this).data('brand-name');
            let brand_image = $(this).data('brand-image');
            let brand_status = $(this).data('brand-status');

            $('#brand_name').val(brand_name);
            if (brand_status) {
               $('#brand_status').attr('checked', true);
            } else {
               $('#brand_status').removeAttr('checked');
            }
            //remove old dropify wrapper
            $('.dropify-wrapper').remove();
            $('.brand_input').append('<input type="file" class="dropify form-control" data-max-file-size="1M" id="brand_image" name="brand_image" data-allowed-file-extensions="jpeg jpg png" data-default-file="' + brand_image + '"/>')
            
            initializeDropifyAndShowModal(url, 'patch');    //reinitialize dropify
      })
   })

   function initializeDropifyAndShowModal(url, method)
   {
      $('#brand_method').val(method);
      $('#brandModalFormAction').attr('action', url);
      $('.dropify').dropify();
      $('#brandModal').modal('show');
   }
</script>
@endsection
