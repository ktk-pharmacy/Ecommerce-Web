@extends('admin.layouts.master', ['title' => 'Orders'])

@section('css')
<!-- Plugins css -->
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
                  <li class="breadcrumb-item"><a href="javascript: void(0);">Ecommerce</a></li>
                  <li class="breadcrumb-item active"><a href="javascript: void(0);">Orders</a></li>
               </ol>
            </div>
            <h4 class="page-title">Orders</h4>
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
                     <form class="form-inline" method="GET">
                        <div class="form-group col-3 mb-2">
                           <input style="width: 100%;" type="text" name="filter" id="range-datepicker" class="form-control"
                              value="{{ Request('filter') ? Request('filter') : '' }}" placeholder="2018-10-03 to 2018-10-10">
                        </div>
                        <div class="form-group mb-2">
                           <label for="order-search" class="sr-only">Search</label>
                           <input
                              type="search"
                              class="form-control"
                              name="search"
                              id="order-search"
                              onkeyup="changeOrderStatus()"
                              value="{{ Request('search') }}"
                              placeholder="Search...id, name">
                        </div>
                        <div class="form-group mx-sm-3 mb-2">
                           <label for="order-status" class="mr-2">Status</label>
                           <select class="custom-select" id="order-status" onchange="changeOrderStatus()" name="status">
                              <option value="" selected>Choose...</option>
                              <option value="Confirm" @selected(Request('status') == 'Confirm')>Confirm</option>
                              <option value="Processing" @selected(Request('status') == 'Processing')>Processing</option>
                              <option value="Pending" @selected(Request('status') == 'Pending')>Pending</option>

                              <option value="Canceled" @selected(Request('status') == 'Canceled')>Canceled</option>

                           </select>
                        </div>
                        <div class="form-group ml-2 mb-2">
                           <button disabled id="filter-btn" type="submit" class="btn btn-info waves-effect waves-light"><i class="mdi mdi-filter"></i>
                              Filter</button>
                        </div>
                        @if(request()->hasAny(['search', 'status', 'filter']))
                        <div class="form-group ml-1 mb-2">
                           <a href="{{ route('admin.orders.index') }}" id="clear-btn" type="button" class="btn btn-outline-info waves-effect waves-light">
                              <i class="mdi mdi-filter-remove"></i> Clear
                           </a>
                        </div>
                        @endif
                     </form>
                  </div>
                  <div class="col-lg-4">
                     <div class="text-lg-right">
                        <button type="button" class="btn btn-light waves-effect mb-2">Export</button>
                     </div>
                  </div><!-- end col-->
               </div>

               <div class="table-responsive">
                  <table class="table table-centered table-nowrap mb-0">
                     <thead class="thead-light">
                        <tr>
                           <th style="width: 20px;">No.</th>
                           <th>Order ID</th>
                           <th>Customer Name</th>
                           <th>Date</th>
                           <th>Payment Method</th>
                           <th>Total</th>
                           <th>Order Status</th>
                           <th style="width: 125px;">Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach ($orders as $order)
                        <tr>
                           <td>
                              {{ ++$index }}
                           </td>

                           <td>
                              <a
                                 href="{{ route('admin.orders.edit', $order->id) }}"
                                 class="text-body font-weight-bold">
                                 #{{ $order->id }}
                              </a>
                           </td>
                           <td>{{ $order->customer->name }}</td>
                           <td>
                              {{ $order->created_at->format('d-M-Y') }}
                              <small class="text-muted">{{ $order->created_at->format('h:i A') }}</small>
                           </td>
                           <td>
                              {{ $order->payment_method }}
                           </td>
                           <td>
                              {{ $order->delivery_charge==Null?$order->order_total-$order->coupon_amount:$order->delivery_charge+$order->order_total-$order->coupon_amount }}
                           </td>

                           <td>
                              {!! statusBadge($order->status, 'ORDERSTATUS') !!}
                           </td>
                           <td>
                              <a href="{{ route('admin.orders.detail', $order->id) }}" class="action-icon"> <i class="mdi mdi-eye"></i></a>
                              <a href="{{ route('admin.orders.edit', $order->id) }}" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                           </td>
                        </tr>
                        @endforeach
                     </tbody>
                  </table>
               </div>

               @include('admin.layouts.shared.pagination', ['paginator' => $orders, $orders->appends($_GET)->links(), 'link_limit' => 10])
            </div> <!-- end card-body-->
         </div> <!-- end card-->
      </div> <!-- end col -->
   </div>
   <!-- end row -->

</div> <!-- container -->
@endsection

@section('script')
<!-- Plugins js-->
<script src="{{asset('assets/libs/jquery-toast-plugin/jquery-toast-plugin.min.js')}}"></script>
<script src="{{asset('assets/libs/flatpickr/flatpickr.min.js')}}"></script>
<!-- Page js-->
<script src="{{asset('assets/js/pages/toastr.init.js')}}"></script>

<script>
   $(function () {
      $('#range-datepicker').flatpickr({
         mode: "range",
         onChange: function(selectedDates, dateStr, instance){
            document.getElementById('filter-btn').removeAttribute('disabled');
         }
      });
   });

   function changeOrderStatus() {
      let x = document.getElementById("order-status").value;
      document.getElementById('filter-btn').removeAttribute('disabled');
   }
</script>
@endsection
