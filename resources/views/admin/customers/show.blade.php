@extends('admin.layouts.master', ['title' => 'Ordered Products by ' . $customer->name])

@section('content')
<!-- Start Content-->
<div class="container-fluid">

   <!-- start page title -->
   <div class="row">
      <div class="col-12">
         <div class="page-title-box">
            <div class="page-title-right">
               <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="javascript: void(0);">Top Sale</a></li>
                  <li class="breadcrumb-item active">Ordered Products</li>
               </ol>
            </div>
            <h4 class="page-title">All Products that have been ordered by {{ $customer->name }}</h4>
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
                           <img src="https://dummyimage.com/159x38/ffffff/000000.png&text=528+Shop+Logo" alt="" height="22">
                        </span>
                     </div>

                     <div class="logo logo-light">
                        <span class="logo-lg">
                           <img src="https://dummyimage.com/159x38/ffffff/000000.png&text=528+Shop+Logo" alt="" height="22">
                        </span>
                     </div>
                  </div>
               </div>
               <div class="float-right">
                  <div class="text-right d-print-none">
                     <a href="{{ url()->previous() }}" class="btn btn-sm btn-primary waves-effect waves-light"><i
                           class="mdi mdi-arrow-left-circle-outline mr-1"></i> Back</a>
                  </div>
               </div>
            </div>
            <!-- end row -->

            <div class="row mt-3">
               <div class="col-sm-6">
                  <h6>Billing Address</h6>
                  <address>
                     {{ $customer->billing_address }}<br>
                  </address>
                  <p><span class="font-weight-semibold mr-2">Email/Phone:</span>
                     {{ $customer->username }}
                  </p>
                  <p><span class="font-weight-semibold mr-2">Contact Phone No:</span>
                     {{ $customer->contact_phone_no }}
                  </p>
               </div> <!-- end col -->

               <div class="col-sm-6">
                  <h6>Shipping Address</h6>
                  <address>
                     {{ $customer->shipping_address }}<br>
                  </address>
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
                              <th style="width: 10%">QTY</th>
                              <th style="width: 10%">Price</th>
                              <th style="width: 10%">Discount</th>
                              <th style="width: 10%" class="text-right">Total</th>
                           </tr>
                        </thead>
                        <tbody>
                           @php
                           $total_quantity = 0;
                           $total_price = 0;
                           $total_discount = 0;
                           $total = 0;
                           @endphp
                           @foreach ($customer->orderProducts as $key => $order_product)
                           <tr>
                              <td>{{ ++$key }}</td>
                              <td>
                                 <img
                                    src="{{ $order_product->product->feature_image }}"
                                    alt="" width="50" class="img-fluid img-thumbnail">
                                 <b>{{ $order_product->product->name }}</b>
                              </td>
                              <td>{{ $order_product->quantity }}</td>
                              @php
                              $product_price = $order_product->order_product_total/$order_product->quantity;
                              $discount = $order_product->discount_total;

                              $total_quantity += $order_product->quantity;
                              $total_price += $order_product->sale_price;
                              $total_discount += $discount;
                              $total += $order_product->order_product_total;
                              @endphp
                              <td>{{ $order_product->sale_price }}</td>
                              <td>{{ $discount }}</td>
                              <td class="text-right">{{ $order_product->order_product_total }}</td>
                           </tr>
                           @endforeach
                        </tbody>
                        <tfoot>
                           <tr>
                              <td></td>
                              <td>Total</td>
                              <td>{{ $total_quantity }}</td>
                              <td>{{ $total_price }}</td>
                              <td>{{ $total_discount }}</td>
                              <td class="text-right">{{ $total }}</td>
                           </tr>
                        </tfoot>
                     </table>
                  </div> <!-- end table-responsive -->
               </div> <!-- end col -->
            </div>
            <!-- end row -->
         </div> <!-- end card-box -->
      </div> <!-- end col -->
   </div>
   <!-- end row -->

</div> <!-- container -->
@endsection