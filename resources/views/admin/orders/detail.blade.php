@extends('admin.layouts.master', ['title' => 'Order Details'])

@section('content')
<!-- Start Content-->
<div class="container-fluid">

   <!-- start page title -->
   <div class="row">
      <div class="col-12">
         <div class="page-title-box">
            <div class="page-title-right">
               <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="javascript: void(0);">Order</a></li>
                  <li class="breadcrumb-item active">Invoice</li>
               </ol>
            </div>
            <a class="page-title" href="{{ route('admin.orders.index') }}">
               <button type="button" class="btn w-sm btn-secondary waves-effect">
                  <i class="mdi mdi-arrow-left"></i> Back to orders
               </button>
            </a>
         </div>
      </div>
   </div>
   <!-- end page title -->

   <div class="row">
      <div class="col-12">
         <div class="card-box">
            <!-- Logo & title -->
            <div class="clearfix">
               <div class="float-left">
                  <div class="auth-logo">
                     <div class="logo logo-dark">
                        <span class="logo-lg">
                           <img src="{{ asset('assets/theme/img/sayaid1.png') }}" alt="" height="44">
                        </span>
                     </div>

                     <div class="logo logo-light">
                        <span class="logo-lg">
                           <img src="{{ asset('assets/theme/img/sayaid1.png') }}" alt="" height="44">
                        </span>
                     </div>
                  </div>
               </div>
               <div class="float-right">
                  <div class="text-right d-print-none">
                     <a href="javascript:window.print()" class="btn btn-sm btn-primary waves-effect waves-light"><i
                           class="mdi mdi-printer mr-1"></i> Print</a>
                  </div>
               </div>
            </div>

            <div class="row">
               <div class="col-md-6">
                  <div class="mt-3">
                     <p><b>Hello, {{ $order->customer->name }}</b></p>
                     <p class="text-muted">Thanks a lot because you keep purchasing our products. Our company
                        promises to provide high quality products for you as well as outstanding
                        customer service for every transaction. </p>
                  </div>

               </div><!-- end col -->
               <div class="col-md-4 offset-md-2">
                  <div class="mt-3 float-right">
                     <p class="m-b-10"><strong>Order Date : </strong> <span class="float-right"> &nbsp;&nbsp;&nbsp;&nbsp; {{
                           $order->created_at->format('d-M-Y') }}</span></p>
                     <p class="m-b-10"><strong>Order Status : </strong> <span class="float-right">{!! statusBadge($order->status,
                           'ORDERSTATUS') !!}</span></p>
                     <p class="m-b-10"><strong>Order No. : </strong> <span class="float-right">{{ $order->id }} </span></p>
                  </div>
               </div><!-- end col -->
            </div>
            <!-- end row -->

            <div class="row mt-3">
               <div class="col-sm-6">
                  <h5>Delivery Information</h5>
                  <p><b><span class="font-weight-semibold mr-2">Delivery Type:</span>
                    {{ $order->delivery_type }}</b>
                 </p>
                  <p><span class="font-weight-semibold mr-2">Email/Phone:</span>
                     {{ $order->delivery_information->email ?? $order->customer->email }}
                  </p>
                  <p><span class="font-weight-semibold mr-2">Contact Phone No:</span>
                     {{ $order->delivery_information->contact_phone_no ?? $order->customer->contact_phone_no }}
                  </p>
                  <p class="mb-2">
                     <span class="font-weight-semibold mr-2">Billing Address:</span>
                     {{ $order->delivery_information->billing_address ?? $order->customer->billing_address }}
                  </p>
                  <p class="mb-2">
                     <span class="font-weight-semibold mr-2">Shipping Address:</span>
                     {{ $order->delivery_information->shipping_address ?? $order->customer->shipping_address }}
                  </p>

               </div> <!-- end col -->

               <div class="col-sm-6">
                  <h5>Logistics Information</h5>
                  <p class="mb-2">
                     <span class="font-weight-semibold mr-2">Name:</span>
                     {{ $order->customer->name }}
                  </p>
                  <p class="mb-2">
                     <span class="font-weight-semibold mr-2">City/Township:</span>
                     {{ $order->delivery_information->cityInfo->name ?? $order->delivery_information->city}}/{{ $order->delivery_information->townshipInfo->name ?? $order->delivery_information->township }}
                  </p>
               </div> <!-- end col -->
            </div>
            <!-- end row -->

            <div class="row">
               <div class="col-12">
                  <div class="table-responsive">
                     <table class="table mt-4 table-centered">
                        <thead>
                           <tr>
                              <th>#</th>
                              <th>Item</th>
                              <th style="width: 10%">Price</th>
                              <th style="width: 10%">QTY</th>
                              <th style="width: 10%">Subtotal</th>
                              <th style="width: 10%">Discount</th>
                              <th style="width: 10%" class="text-right">Total</th>
                           </tr>
                        </thead>
                        <tbody>
                           @foreach ($order->products as $key => $order_product)
                           <tr>
                              <td>{{ ++$key }}</td>
                              <td>
                                 <img
                                    src="{{ $order_product->product->feature_image }}"
                                    alt="" width="50" class="img-fluid img-thumbnail">
                                 <b>{{ $order_product->product->name }}</b>
                              </td>
                              <td>{{ $order_product->sale_price }}</td>
                              <td>{{ $order_product->quantity }}</td>
                              <td>{{ $order_product->sale_price * $order_product->quantity }}</td>
                              <td>{{ $order_product->discount_total }}</td>
                              <td class="text-right">{{ $order_product->order_product_total }}</td>
                           </tr>
                           @endforeach
                        </tbody>
                     </table>
                  </div> <!-- end table-responsive -->
               </div> <!-- end col -->
            </div>
            <!-- end row -->

            <div class="row">
               <div class="col-sm-6">
                  <div class="clearfix pt-5">
                     <h6 class="text-muted">Order Notes:</h6>

                     <small class="text-muted">
                        {{ $order->delivery_information->order_note ?? $order->customer->order_note }}
                     </small>
                  </div>
               </div> <!-- end col -->
               <div class="col-sm-6">
                  <div class="float-right">
                     <p><b>Sub-total: </b> <span class="float-right">{{ $order->order_total }}</span></p>
                     @if ($order->coupon)
                     <p><b>Coupon ({{ $order->coupon->name }}):</b> <span class="float-right"> &nbsp;&nbsp;&nbsp; -{{
                           $order->coupon_amount }}</span></p>
                     @endif
                     <p><b>Delivery Charge: </b> <span class="float-right"> &nbsp;&nbsp;&nbsp; {{ $order->delivery_charge }}</span></p>
                     <h3>{{ $order->order_total + $order->delivery_charge - $order->coupon_amount }} MMK</h3>
                  </div>
                  <div class="clearfix"></div>
               </div> <!-- end col -->
            </div>
            <!-- end row -->
         </div> <!-- end card-box -->
      </div> <!-- end col -->
   </div>
   <!-- end row -->

</div> <!-- container -->
@endsection
