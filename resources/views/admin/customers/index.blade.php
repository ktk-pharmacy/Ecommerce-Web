@extends('admin.layouts.master', ['title' => 'Customers'])

@section('css')
<!-- Plugins css -->
<link href="{{asset('assets/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />

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
                  <li class="breadcrumb-item active">Customers</li>
               </ol>
            </div>
            <h4 class="page-title">Customers</h4>
         </div>
      </div>
   </div>
   <!-- end page title -->

   <div class="row">
      <div class="col-12">
         <div class="card">
            <div class="card-body">

               {{-- <a href="javascript:void(0)" data-url="#" class="createCustomer">
                  <button type="button" class="btn btn-sm btn-blue waves-effect waves-light float-right">
                     <i class="mdi mdi-plus-circle"></i> Add Customer
                  </button>
               </a> --}}

               <h4 class="header-title mb-4">All Customers</h4>

               <div class="table-responsive">
                  <table class="table table-centered table-striped dt-responsive nowrap w-100" id="customers-datatable">
                     <thead>
                        <tr>
                           <th style="width: 20px;">No.</th>
                           <th>Customer</th>
                           <th>Username</th>
                           <th>Phone</th>
                           <th>Orders</th>
                           <th>Last Order</th>
                           <th>Status</th>
                           <th>Registered At</th>
                           <th style="width: 75px;">Action</th>
                        </tr>
                     </thead>
                     <tbody>
                     @foreach ($customers as $index => $customer)
                        <tr>
                           <td>
                              {{ ++$index }}
                           </td>
                           <td class="table-user">
                              <img src="{{ $customer->profile_image }}" alt="table-user" class="mr-2 rounded-circle">
                              <a href="{{ route('admin.customers.show', $customer->id) }}" class="text-body font-weight-semibold">
                                 {{ $customer->name }}
                              </a>
                           </td>
                           <td>
                              {{ $customer->username }}
                           </td>
                           <td>{{ $customer->contact_phone_no }}</td>
                           <td>
                              {{ count($customer->completedOrders) }}
                           </td>
                           <td>
                              @if (count($customer->completedOrders))
                                 {{ $customer->completedOrders[0]->created_at->format('d-M-Y') }}
                                 <small class="text-muted">{{ $customer->completedOrders[0]->created_at->format('h:i A') }}</small>
                              @endif
                           </td>
                           <td>
                              {!! statusBadge($customer->status, 'ACTIVEORINACTIVE') !!}
                           </td>
                           <td>
                              {{ $customer->created_at->format('d-M-Y') }}
                           </td>
                           <td>
                              <a href="{{ route('admin.customers.show', $customer->id) }}" class="action-icon"> <i class="mdi mdi-eye"></i></a>
                           </td>
                        </tr>
                     @endforeach
                     </tbody>
                  </table>
               </div>
            </div> <!-- end card-body-->
         </div> <!-- end card-->
      </div> <!-- end col -->
   </div>
   <!-- end row -->

</div> <!-- container -->
@endsection

@section('script')
<!-- Plugins js-->
<script src="{{asset('assets/libs/datatables/datatables.min.js')}}"></script>
<script src="{{asset('assets/libs/jquery-datatables-checkboxes/jquery-datatables-checkboxes.min.js')}}"></script>

<!-- Page js-->
<script>
   $("#customers-datatable").DataTable()
</script>
@endsection
