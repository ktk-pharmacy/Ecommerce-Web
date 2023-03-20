@extends('admin.layouts.master', ['title' => 'Blog Category'])

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
                  <li class="breadcrumb-item"><a href="javascript: void(0);">Blog Management</a></li>
                  <li class="breadcrumb-item active">Blog Categories</li>
               </ol>
            </div>
            <h4 class="page-title">Blog Categories</h4>
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
                        <a href="{{ route('admin.blog-categories.index') }}">
                           <button type="button"
                              class="btn btn-sm {{ Request('status') == 'trash' ? 'btn-light' : 'btn-primary'}}">All ({{
                              $terms->count() }})</button>
                        </a>
                     </div>
                  </div>
                  <div class="col-lg-4">
                     @can('blog-category-create')
                     <a href="javascript:void(0)" data-url="{{ route('admin.blog-categories.store') }}" class="createBlogCategory">
                        <button type="button" class="btn btn-sm btn-blue waves-effect waves-light float-right">
                           <i class="mdi mdi-plus-circle"></i> Add Category
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
                        <th>Blog count</th>
                        <th>Action</th>
                     </tr>
                  </thead>


                  <tbody>
                     @foreach ($terms as $key => $term)
                     <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $term->name }}</td>
                        <td>{{ $term->publish_posts_count }}</td>
                        <td>
                           @can('blog-category-edit')
                           <a 
                              class="action-icon editBlogCategory"
                              data-term-name="{{ $term->name }}"
                              data-url="{{ route('admin.blog-categories.update', $term->id) }}"
                           >
                              <i class="mdi mdi-square-edit-outline"></i>
                           </a>
                           @endcan

                           @can('blog-category-delete')
                           @if($term->id != 1)
                           <a href="javascript:void(0);" class="action-icon" data-toggle="modal" data-target="#deleteFormModal"
                              data-id="{{ $term->id }}"
                              data-url="{{ url('admin/blog-categories/'.$term->id)}}{{ Request('status') == 'trash' ? '?status=trash': '' }}">
                              <i class="mdi mdi-delete"></i>
                           </a>
                           @endif
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
@include('admin.layouts.shared.modals/term')
@endsection

@section('script')
<!-- Plugins js-->
<script src="{{asset('assets/libs/datatables/datatables.min.js')}}"></script>
{{-- <script src="{{asset('assets/libs/pdfmake/pdfmake.min.js')}}"></script> --}}
<script src="{{asset('assets/libs/jszip/jszip.min.js')}}"></script>
<script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.colVis.min.js"></script>
<script src="{{asset('assets/libs/jquery-toast-plugin/jquery-toast-plugin.min.js')}}"></script>

<!-- Page js-->
{{-- <script src="{{asset('assets/js/pages/datatables.init.js')}}"></script> --}}
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

            //Create Terms
            $('body').on('click', '.createBlogCategory', function () {
                let url = $(this).data('url');
                $('#term_name').val('');
                showModal(url, 'post');
            })

            //Edit Terms
            $('body').on('click', '.editBlogCategory', function () {
                let url = $(this).data('url');
                let term_name = $(this).data('term-name');
                $('#term_name').val(term_name);
                showModal(url, 'patch');
            })

        })

        function showModal(url, method)
        {
            $('#term_method').val(method);
            $('#termModalFormAction').attr('action', url);
            $('#termModal').modal('show');
        }
</script>
@endsection