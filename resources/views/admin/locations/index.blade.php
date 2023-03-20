@extends('admin.layouts.master', ['title' => 'Locations'])

@section('css')
    <!-- Plugins css -->
    <link href="{{asset('assets/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/jquery-toast-plugin/jquery-toast-plugin.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />

@endsection

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">
        
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title">Locations</h4>
                </div>
            </div>
        </div>     
        <!-- end page title --> 

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        @can('location-create')
                        <div class="row mb-2">
                            <div class="col-sm-4">
                                <a href="javascript:void(0);" data-url="{{ route('admin.locations.store') }}" class="btn btn-blue waves-effect waves-light mb-2 createLocation"><i class="mdi mdi-plus-circle mr-2"></i> Add new location</a>
                            </div>
                        </div>
                        @endcan

                        <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Region</th>
                                    <th>Township</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        
                        
                            <tbody>
                                @php
                                    $index = 0;
                                @endphp

                                @foreach ($regions as $key => $region)
                                    <tr>
                                        <td>{{ ++$index }}</td>
                                        <td>{{ $region->name }}</td>
                                        <td></td>
                                        <td>
                                            @can('location-edit')
                                            <a
                                                class="action-icon editLocation"
                                                data-location-name="{{ $region->name }}"
                                                data-id="{{$region->id}}"
                                                data-parent-id="{{ $region->parent_id }}"
                                                data-url="{{ route('admin.locations.update', $region->id) }}"
                                            >
                                                <i class="mdi mdi-square-edit-outline"></i>
                                            </a>
                                            @endcan
                                        </td>
                                    </tr>
                                    @foreach ($region->townships as $township)
                                        <tr>
                                            <td>{{ ++$index }}</td>
                                            <td>{{ $region->name }}</td>
                                            <td>{{ $township->name }}</td>
                                            <td>
                                                @can('location-edit')
                                                <a
                                                    class="action-icon editLocation"
                                                    data-location-name="{{ $township->name }}"
                                                    data-id="{{$township->id}}"
                                                    data-parent-id="{{ $township->parent_id }}"
                                                    data-url="{{ route('admin.locations.update', $township->id) }}"
                                                >
                                                    <i class="mdi mdi-square-edit-outline"></i>
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

@section('modal')
    @include('admin.layouts.shared.modals/location-modal')
@endsection

@section('script')
    <!-- Plugins js-->
    <script src="{{asset('assets/libs/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('assets/libs/jquery-toast-plugin/jquery-toast-plugin.min.js')}}"></script>
    <script src="{{asset('assets/libs/select2/select2.min.js')}}"></script>

    <!-- Page js-->
    <script src="{{asset('assets/js/pages/datatables.init.js')}}"></script>
    <script src="{{asset('assets/js/pages/toastr.init.js')}}"></script>

    <script>
        $(document).ready(function() {
            $('#all_locations').select2();

            //Create Location
            $('body').on('click', '.createLocation', function () {
                let url = $(this).data('url');
                let regions = {!! json_encode($regions) !!}
                let options = '<option value="">--Select Parent Location--</option>';
                regions.forEach(region => {
                    options += '<option value="' + region.id + '">' + region.name + '</option>'
                });
                $('#all_locations').html(options);
                $('#method').val('post');
                $('#location_name').val('');
                $('#locationModalFormAction').attr('action', url);
                $('#locationModal').modal('show');
            })

            //Edit Location
            $('body').on('click', '.editLocation', function () {
                let parent_id = $(this).data('parent-id');
                let url = $(this).data('url');
                let location_name = $(this).data('location-name');
                let regions = {!! json_encode($regions) !!}
                let options = '<option value="">--Select Parent Location--</option>';
                regions.forEach(region => {
                    let selected = '';
                    if(region.id === parent_id){
                        selected = 'selected'
                    }
                    options += '<option value="' + region.id + '"' + selected + ' >' + region.name + '</option>'
                });
                $('#all_locations').html(options);
                $('#method').val('patch');
                $('#location_name').val(location_name);
                $('#locationModalFormAction').attr('action', url);
                $('#locationModal').modal('show');
            })
        });
    </script>
@endsection