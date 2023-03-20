@extends('admin.layouts.master', ['title' => 'Coupons'])

@section('css')
<!-- Plugins css -->
<link href="{{asset('assets/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/libs/jquery-toast-plugin/jquery-toast-plugin.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/libs/flatpickr/flatpickr.min.css')}}" rel="stylesheet" type="text/css" />
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
                  <li class="breadcrumb-item"><a href="javascript: void(0);">Coupon Management</a></li>
                  <li class="breadcrumb-item active">Coupons</li>
               </ol>
            </div>
            <h4 class="page-title">Coupons</h4>
         </div>
      </div>
   </div>
   <!-- end page title -->

   <div class="row">
      <div class="col-12">
         <div class="card">
            <div class="card-body">
               <div class="row mb-2">
                  <div class="col-lg-8 col-sm-8">
                     <form class="form-row" method="GET">
                        <div class="form-group col-4">
                           <input type="text" name="filter" id="range-datepicker" class="form-control"
                              value="{{ Request('filter') ? Request('filter') : '' }}" placeholder="2018-10-03 to 2018-10-10">
                        </div>
                        <div class="form-group ml-2">
                           <button disabled id="filter-btn" type="submit" class="btn btn-info waves-effect waves-light"><i
                                 class="mdi mdi-filter"></i> Filter</button>
                        </div>
                        @if(Request('filter'))
                        <div class="form-group ml-1">
                           <a href="{{ route('admin.coupons.index') }}" id="clear-btn" type="button"
                              class="btn btn-outline-info waves-effect waves-light">
                              <i class="mdi mdi-filter-remove"></i> Clear
                           </a>
                        </div>
                        @endif
                     </form>
                  </div>

                  <div class="col-lg-4 col-sm-4">
                     <div class="btn-group mb-3 float-right">
                        <a href="{{ route('admin.coupons.create') }}">
                           <button type="button" class="btn btn-sm btn-blue waves-effect waves-light float-right">
                              <i class="mdi mdi-plus-circle"></i> Add coupon
                           </button>
                        </a>
                     </div>
                  </div>
                  <!-- end col-->
               </div>

               <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                  <thead>
                     <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Amount/Type</th>
                        <th>Min amount</th>
                        <th>Total(used)</th>
                        <th>Per user</th>
                        <th>Date</th>
                        <th>Action</th>
                     </tr>
                  </thead>

                  <tbody>

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
<script src="{{asset('assets/libs/flatpickr/flatpickr.min.js')}}"></script>

<!-- Page js-->
<script src="{{asset('assets/js/pages/toastr.init.js')}}"></script>

<script>
   $(document).ready(function() {
            $('#range-datepicker').flatpickr({
                mode: "range",
                onChange: function(selectedDates, dateStr, instance){
                    document.getElementById('filter-btn').removeAttribute('disabled');
                }
            });

            $('#datatable-buttons').DataTable({
                responsive: true,
                autoWidth: true,
                processing: true,
                ajax: "{{ route('admin.coupons.ajax') }}?filter=" + getRequest('filter'),
                deferRender: true,
                columns: [
                    {data: function (data, type, row, meta) {
                        return meta.row + 1;
                    }},
                    {data: 'name'},
                    {data: function (data) {
                        return data.amount + '/' + data.type;
                    }},
                    {data: 'min_amount'},
                    {data: function (data) {
                        return data.limit_per_coupon + ' (' + data.orders_count + ')'
                    }},
                    {data: 'limit_per_user'},
                    {data: function (data) {
                        return data.from + ' to ' + data.to
                    }},
                    {data: function (data) {
                        let delete_data_url = "{{ url('admin/coupons') }}/" + data.id;

                        let delete_btn = '@can('coupon-delete')'+
                                            '<a href="javascript:void(0);"'+
                                            'class="action-icon"'+
                                            'data-toggle="modal"'+
                                            'data-target="#deleteFormModal"'+
                                            'data-id="' + data.id +'" data-url="' + delete_data_url +'">'+
                                                '<i class="mdi mdi-delete"></i>'+
                                            '</a>'+
                                         '@endcan'
                        if (data.orders_count > 0) {
                           delete_btn = "";
                        }
                        return delete_btn;
                    }}
                ],
            });

        })

        function getRequest(name){
            if(name=(new RegExp('[?&]'+encodeURIComponent(name)+'=([^&]*)')).exec(location.search))
                return decodeURIComponent(name[1]);
        }
        
</script>
@endsection