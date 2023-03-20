@extends('admin.layouts.master', ['title' => 'Category Groups'])

@section('css')
<!-- Plugins css -->
<link href="{{asset('assets/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/libs/jquery-toast-plugin/jquery-toast-plugin.min.css')}}" rel="stylesheet" type="text/css" />
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
                  <li class="breadcrumb-item"><a href="javascript: void(0);">Category Group Management</a></li>
                  <li class="breadcrumb-item active">Category Groups</li>
               </ol>
            </div>
            <h4 class="page-title">Category Groups</h4>
         </div>
      </div>
   </div>
   <!-- end page title -->

   <div class="row">
      <div class="col-12">
         <div class="card">
            <div class="card-body">
               <div class="row mb-2">
                  <div class="col-lg-8">
                     <div class="btn-group mb-3">
                        <a href="{{ route('admin.category-groups.index') }}">
                           <button type="button"
                              class="btn btn-sm {{ Request('status') == 'trash' ? 'btn-light' : 'btn-primary'}}">All ({{
                              $category_groups->count() }})</button>
                        </a>
                     </div>
                  </div>
                  <div class="col-lg-4">
                     @can('categorygroup-create')
                     <a href="javascript:void(0)" data-url="{{ route('admin.category-groups.store') }}" class="createCategoryGroup">
                        <button type="button" class="btn btn-sm btn-blue waves-effect waves-light float-right">
                           <i class="mdi mdi-plus-circle"></i> Add Category Group
                        </button>
                     </a>
                     @endcan
                  </div><!-- end col-->
               </div>

               <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                  <thead>
                     <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Status</th>
                        <th>Sorting</th>
                        <th>Action</th>
                     </tr>
                  </thead>


                  <tbody>
                     @foreach ($category_groups as $key => $category_group)
                     <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $category_group->name }}</td>
                        <td><img src="{{ asset($category_group->image_url) }}" alt="{{ $category_group->name }}'s image" width="35"></td>
                        <td>{!! statusBadge($category_group->status, 'ACTIVEORINACTIVE') !!}</td>
                        <td>{{ $category_group->sorting }}</td>
                        <td>
                           @can('categorygroup-edit')
                           <a
                              class="action-icon editCategoryGroup"
                              data-category-group-name="{{ $category_group->name }}"
                              data-category-group-image="{{ asset($category_group->image_url) }}"
                              data-category-group-status="{{ $category_group->status }}"
                              data-category-group-sorting="{{ $category_group->sorting }}"
                              data-url="{{ route('admin.category-groups.update', $category_group->id) }}"
                           >
                              <i class="mdi mdi-square-edit-outline"></i>
                           </a>
                           @endcan

                           @can('categorygroup-delete')
                           <a href="javascript:void(0);" class="action-icon" data-toggle="modal" data-target="#deleteFormModal"
                              data-id="{{ $category_group->id }}"
                              data-url="{{ url('admin/category-groups/'.$category_group->id)}}">
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
@include('admin.layouts.shared.modals/category-group-modal')
@endsection

@section('script')
<!-- Plugins js-->
<script src="{{asset('assets/libs/datatables/datatables.min.js')}}"></script>
<script src="{{asset('assets/libs/jszip/jszip.min.js')}}"></script>
<script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.colVis.min.js"></script>
<script src="{{asset('assets/libs/jquery-toast-plugin/jquery-toast-plugin.min.js')}}"></script>
<script src="{{asset('assets/libs/dropify/dropify.min.js')}}"></script>

<!-- Page js-->
<script src="{{asset('assets/js/pages/toastr.init.js')}}"></script>

<script>
   $(document).ready(function() {

            $('#datatable-buttons').DataTable({
                responsive: true,
                autoWidth: false,
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: ':visible'     //[ 0, 1, 2, 5 ]
                        }
                    },
                    'colvis'
                ]
            });

            //Create Category Group
            $('body').on('click', '.createCategoryGroup', function () {
                let url = $(this).data('url');
                $('#category_group_name').val('');
                $('.dropify-wrapper').remove();
                $('.category_group_input').append('<input type="file" class="dropify form-control" data-max-file-size="1M" id="category_group_image" name="category_group_image" data-allowed-file-extensions="jpeg jpg png"  required/>')
                initializeDropifyAndShowModal(url, 'post');    //reinitialize dropify
            })

            //Edit Category Group
            $('body').on('click', '.editCategoryGroup', function () {
                let url = $(this).data('url');
                let category_group_name = $(this).data('category-group-name');
                let category_group_status = $(this).data('category-group-status');
                let category_group_sorting = $(this).data('category-group-sorting');
                let category_group_image = $(this).data('category-group-image');
                $('#category_group_name').val(category_group_name);
                $('#category_group_sorting').val(category_group_sorting);

                if (category_group_status) {
                    $('#category_group_status').attr('checked', true);
                } else {
                    $('#category_group_status').removeAttr('checked');
                }
                //remove old dropify wrapper
                $('.dropify-wrapper').remove();
                $('.category_group_input').append('<input type="file" class="dropify form-control" data-max-file-size="1M" id="category_group_image" name="category_group_image" data-allowed-file-extensions="jpeg jpg png" data-default-file="' + category_group_image + '"/>')

                initializeDropifyAndShowModal(url, 'patch');    //reinitialize dropify
            })
        })

        function initializeDropifyAndShowModal(url, method)
        {
            $('#category_group_method').val(method);
            $('#categoryGroupModalFormAction').attr('action', url);
            $('.dropify').dropify();
            $('#categoryGroupModal').modal('show');
        }
</script>
@endsection
