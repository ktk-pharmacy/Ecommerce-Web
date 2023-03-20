@extends('admin.layouts.master', ['title' => 'Blogs'])

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
                            <li class="breadcrumb-item active">All Blogs</li>
                        </ol>
                    </div>
                    <h4 class="page-title">All Blogs</h4>
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
                                    <a href="{{ route('admin.blogs.index') }}">
                                        <button type="button" class="btn btn-sm {{ Request('status') == 'trash' ? 'btn-light' : 'btn-primary'}}">All ({{ $posts_count }})</button>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                @can('blog-create')
                                <a href="{{ route('admin.blogs.create') }}">
                                    <button type="button" class="btn btn-sm btn-blue waves-effect waves-light float-right">
                                        <i class="mdi mdi-plus-circle"></i> Add Blog
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
                                    <th>Categories</th>
                                    <th>Published By</th>
                                    <th>At</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        
                        
                            <tbody>
                                @foreach ($posts as $key => $post)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>
                                            <a href="{{ route('admin.blogs.edit', $post->id) }}">
                                                {{ $post->name }}
                                            </a>
                                        </td>
                                        <td>
                                            @foreach ($post->terms as $term)
                                            <span class="badge badge-info">{{ $term->name }}</span>
                                            @endforeach
                                        </td>
                                        <td>{{ $post->author->name }}</td>
                                        <td>{{ $post->created_at->diffForHumans() }}</td>
                                        <td>{!! statusBadge($post->status, 'ACTIVEORINACTIVE') !!}</td>
                                        <td>
                                            @can('blog-edit')
                                            <a class="action-icon" href="{{ route('admin.blogs.edit', $post->id) }}">
                                                <i class="mdi mdi-square-edit-outline"></i>
                                            </a>
                                            @endcan

                                            @can('blog-delete')
                                                <a
                                                href="javascript:void(0);"
                                                class="action-icon"
                                                data-toggle="modal"
                                                data-target="#deleteFormModal"
                                                data-id="{{ $post->id }}"
                                                data-url="{{ url('admin/blogs/'.$post->id)}}{{ Request('status') == 'trash' ? '?status=trash': '' }}" 
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

        })
    </script>
@endsection