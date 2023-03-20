@extends('admin.layouts.master', ['title' => 'Update order'])

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
                            <li class="breadcrumb-item active">Update Order</li>
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
            {{-- <div class="col-lg-4">
         <div class="card">
            <div class="card-body">
               <h4 class="header-title mb-3">Track Order</h4>

               <div class="row">
                  <div class="col-lg-6">
                     <div class="mb-4">
                        <h5 class="mt-0">Order ID:</h5>
                        <p>#VL2537</p>
                     </div>
                  </div>
                  <div class="col-lg-6">
                     <div class="mb-4">
                        <h5 class="mt-0">Tracking ID:</h5>
                        <p>894152012012</p>
                     </div>
                  </div>
               </div>

               <div class="track-order-list">
                  <ul class="list-unstyled">
                     <li class="completed">
                        <h5 class="mt-0 mb-1">Order Placed</h5>
                        <p class="text-muted">April 21 2019 <small class="text-muted">07:22 AM</small> </p>
                     </li>
                     <li class="completed">
                        <h5 class="mt-0 mb-1">Packed</h5>
                        <p class="text-muted">April 22 2019 <small class="text-muted">12:16 AM</small></p>
                     </li>
                     <li>
                        <span class="active-dot dot"></span>
                        <h5 class="mt-0 mb-1">Shipped</h5>
                        <p class="text-muted">April 22 2019 <small class="text-muted">05:16 PM</small></p>
                     </li>
                     <li>
                        <h5 class="mt-0 mb-1"> Delivered</h5>
                        <p class="text-muted">Estimated delivery within 3 days</p>
                     </li>
                  </ul>

                  <div class="text-center mt-4">
                     <a href="#" class="btn btn-primary">Show Details</a>
                  </div>
               </div>

            </div>
         </div>
      </div> --}}
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="header-title mb-3">Items from Order #{{ $order->id }}{!! statusBadge($order->status, 'ORDERSTATUS') !!}
                                </h4>
                            </div>
                            <div class="col-md-6">
                                <div class="float-right">
                                    <strong>Order Date : </strong>
                                    <span class="float-right">
                                        &nbsp;&nbsp;&nbsp;&nbsp; {{ $order->created_at->format('d-M-Y') }}
                                    </span>
                                    <div class="text-right d-print-none mb-1">
                                        <a href="javascript:window.print()"
                                            class="btn btn-primary btn-sm waves-effect waves-light"><i
                                                class="mdi mdi-printer mr-1"></i> Print</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-centered mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Product name</th>
                                        <th style="width: 5%">Quantity</th>
                                        <th>Price</th>
                                        <th style="width: 10%">Sale Price</th>
                                        <th style="width: 8%">Discount/Type</th>
                                        <th style="width: 10%">Discount</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $total_discount = 0;
                                    @endphp
                                    @foreach ($order->products as $order_product)
                                        <tr>
                                            <th scope="row">
                                                <img src="{{ $order_product->product->feature_image }}" alt="product-img"
                                                    width="50" class="img-fluid img-thumbnail">
                                                {{ $order_product->product->name }}
                                            </th>
                                            <td>{{ $order_product->quantity }}</td>

                                            <td>{{ $order_product->price }}</td>
                                            <td>{{ $order_product->sale_price }}</td>
                                            <td>{{ $order_product->discount_amount . '/' . $order_product->discount_type }}
                                            </td>
                                            <td>{{ $order_product->discount_total }}</td>
                                            <td>{{ $order_product->order_product_total }}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <th scope="row" colspan="5" class="text-right">Total :</th>
                                        <td>
                                            <div class="font-weight-bold">
                                                {{ $total_discount += $order_product->discount_total }}</div>
                                        </td>
                                        <td>
                                            <div class="font-weight-bold">{{ $order->order_total }}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row" colspan="6" class="text-right">Sub Total :</th>
                                        <td>
                                            <div class="font-weight-bold">{{ $order->order_total }}</div>
                                        </td>
                                    </tr>
                                    @if ($order->coupon)
                                        <tr>
                                            <th scope="row" colspan="6" class="text-right">
                                                Coupon - {{ $order->coupon->name }}
                                                ({{ $order->coupon->amount . '-' . $order->coupon->type }})
                                            </th>
                                            <td>-{{ $order->coupon_amount }}</td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <th scope="row" colspan="6" class="text-right">Delivery Charge :</th>
                                        <td>{{ $order->delivery_charge }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row" colspan="6" class="text-right">Total :</th>
                                        <td>
                                            <div class="font-weight-bold">
                                                {{ $order->order_total + $order->delivery_charge - $order->coupon_amount }}
                                            </div>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
        @php
            $total_gross_weight = 0;
        @endphp
        @foreach ($order->products as $order_product)
            @php
                $total_gross_weight += $order_product->product->gross_weight * $order_product->quantity;
            @endphp
        @endforeach
        @php
            if ($total_gross_weight >= 3.1) {
                $totalGrossWeightInteger = ceil($total_gross_weight);
                $extraGrossWeight = $totalGrossWeightInteger - 3;
                $extraGrossWeightCharge = $extraGrossWeight * 1000;
            } else {
                $extraGrossWeightCharge = 0;
            }
        @endphp
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    {{-- <div class="card-body">
                        <h4 class="header-title mb-3">Delivery Information</h4>

                        <h5 class="font-family-primary font-weight-semibold">
                            {{ $order->delivery_information->name ?? $order->customer->name }}</h5>
                        <p class="mb-2">
                            <span class="font-weight-semibold mr-2">Email/Phone:</span>
                            {{ $order->customer->username }}
                        </p>
                        <p class="mb-2">
                            <span class="font-weight-semibold mr-2">Contact Phone:</span>
                            {{ $order->delivery_information->contact_phone_no ?? $order->customer->contact_phone_no }}
                        </p>
                        <p class="mb-2">
                            <span class="font-weight-semibold mr-2">Delivery Type:</span>
                            {{ $order->delivery_type }}
                        </p>
                        <p class="mb-2">
                            <span class="font-weight-semibold mr-2">City/Township:</span>
                            {{ $order->delivery_information->cityInfo->name ?? $order->delivery_information->city }}/{{ $order->delivery_information->townshipInfo->name ?? $order->delivery_information->township }}
                        </p>
                        <p class="mb-2">
                            <span class="font-weight-semibold mr-2">Billing Address:</span>
                            {{ $order->delivery_information->billing_address ?? $order->customer->billing_address }}
                        </p>
                        <p class="mb-2">
                            <span class="font-weight-semibold mr-2">Shipping Address:</span>
                            {{ $order->delivery_information->shipping_address ?? $order->customer->shipping_address }}
                        </p>
                        <p class="mb-0">
                            <span class="font-weight-semibold mr-2">Order Notes:</span>
                            {{ $order->delivery_information->order_note ?? $order->customer->order_note }}
                        </p>
                    </div> --}}
                    <div class="card-body">
                        <form action="{{ route('admin.orders.update', $order->id) }}" method="POST" id="Form" class="">
                            @method('patch')
                            @csrf
                            <button style="float: right;" class="btn float-end btn-sm btn-info waves-effect" id="edit-btn"
                                type="button">Edit</button>
                            <div class="form-group">
                                <label for="" class="col-form-label">Email/Phone</label>
                                <input type="text" class="form-control" name='username'
                                    value="{{ $order->delivery_information->username ?? $order->customer->username }}"
                                    readonly>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-form-label">Contact Phone</label>
                                <input type="text" class="form-control" name=''
                                    value="{{ $order->delivery_information->contact_phone_no }}" readonly>
                            </div>
                            <div class="form-group d-flex justify-content-between">
                                <div class="w-50 pe-1">
                                    <label for="" class="col-form-label">City</label>
                                    <select name="city" class="form-control dynamic_select" id="city_select" disabled>
                                        @foreach ($cities as $city)
                                            <option value="{{ $city->id }}" @selected($order->delivery_information->city == $city->id)
                                                data-get-township-url="{{ route('admin.orders.township', $city->id) }}">
                                                {{ $city->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="w-50 pl-1">
                                    <label for="" class="col-form-label">Township</label>
                                    <div id="township_select_container">
                                        <select name="township" class="form-control dynamic_select" id="township_select"
                                            disabled>
                                            @foreach ($logistics as $logistic)
                                                <option value="{{ $logistic->township->id }}"
                                                    data-get-delivery-charge-url="{{ route('admin.orders.delivery.detail', $logistic->id) }}"
                                                    @selected($order->delivery_information->township == $logistic->township->id)>
                                                    {{ $logistic->township->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group {{ in_array($order->delivery_type, ['premium', 'D2D']) ? '' : 'd-none' }}"
                                id="deli_type">
                                <label class="mb-2">Delivery Type <span class="text-danger">*</span></label>
                                <br />
                                <div class="radio form-check-inline">
                                    <input class="dynamic_radio" type="radio" id="inlineRadio1" value="normal"
                                        name="delivery_type" @checked(in_array($order->delivery_type, ['normal', 'Beexprss'])) disabled>
                                    <label for="inlineRadio1"> Normal </label>
                                </div>
                                <div class="radio form-check-inline">
                                    <input class="dynamic_radio" type="radio" id="inlineRadio2" value="premium"
                                        name="delivery_type" @checked(in_array($order->delivery_type, ['premium', 'D2D'])) disabled>
                                    <label for="inlineRadio2"> Premium </label>
                                </div>
                            </div>
                            <input type="hidden" form="" name="extra_gross_weight_charge"
                                value="{{ $extraGrossWeightCharge }}">
                            <div class="form-group d-flex justify-content-between">
                                <div class="w-50 pe-1">
                                    <label for="" class="col-form-label">Billing Address</label>
                                    <input type="text" class="form-control dynamic_input" name='billing_address'
                                        value="{{ $order->delivery_information->billing_address }}" readonly>
                                </div>
                                <div class="w-50 pl-1">
                                    <label for="" class="col-form-label">Shipping Address</label>
                                    <input type="text" class="form-control dynamic_input" name='shipping_address'
                                        value="{{ $order->delivery_information->shipping_address }}" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-form-label">Order Note</label>
                                <textarea name="order_note" class="form-control dynamic_input" id="" rows="7" readonly>{{ $order->delivery_information->order_note }}</textarea>
                            </div>
                            {{-- <button style="float: right; display:none;" type="submit "
                                class="btn btn-primary waves-effect waves-light float-end update-btn">Submit</button> --}}
                        </form>
                    </div>
                </div>
            </div>
                     
            <div class="col-lg-4 d-print-none">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-3">Update Status</h4>

                        <form >
                        @canany(['order-edit', 'order-delete'])     
                            <div class="form-group">
                                <label for="delivery_charge" class="col-form-label">Delivery Charge</label>
                                <input form="Form" type="text" id="delivery_charge" class="form-control" name="delivery_charge"
                                    value="{{ $order->delivery_charge }}"
                                  
                                    {{ $order->status == 'Completed' || $order->status == 'Canceled' ? 'readonly' : '' }}>
                            </div>
                             
                            <div class="form-group">
                                <label for="order_status" class="col-form-label">Status</label>
                                <select form="Form" id="order_status" class="form-control" name="status"
                                    {{ $order->status == 'Deliver' || $order->status == 'Canceled' ? 'disabled' : '' }}
                                    {{auth()->user()->can('order-edit')?'':'disabled' }}>
                                    @foreach ($order_status as $status)
                                        <option value="{{ $status }}" @selected($order->status == $status)>
                                            {{ $status }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @endcanany
                            <div class="form-group mb-3" id="deli_ref_no" style="display:none">
                                <label for="">Delivery Reference Number</label>
                                <input form="Form" type="text" class="form-control" name="delivery_ref_no"
                                    {{ $order->status == 'Deliver' ? 'readonly' : '' }}id="deli_ref_no_input">
                            </div>

                            <div class="form-group mb-3" id="cancel_remark" style="display: none;">
                                <label for="example-textarea">Cancel Remark</label>
                                <textarea form="Form" class="form-control cancel_remark" id="example-textarea" name="cancel_remark"
                                    {{ $order->status == 'Canceled' ? 'readonly' : '' }} rows="3">{{ $order->cancel_remark }}</textarea>
                            </div>
                            @if ($order->status != 'Deliver' && $order->status != 'Canceled')
                                <div class="col-auto">
                                    <a href="{{ route('admin.orders.index') }}">
                                        <button type="button" class="btn w-sm btn-light waves-effect">Cancel</button>
                                    </a>
                                    <button type="submit" form="Form"
                                        class="btn btn-primary waves-effect waves-light">Submit</button>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div> <!-- end col -->
           
        </div>
        <!-- end row -->

    </div> <!-- container -->
@endsection

@section('script')
    <script>
        var status = "{{ $order->status }}";
        var cancel_remark_hide = function() {
            $('#cancel_remark').hide();
            $('.cancel_remark').removeAttr('required');
        }
        var deli_ref_no_hide = function() {
            $('#deli_ref_no').hide();
            $('#deli_ref_no_input').removeAttr('required');
        }

        if (status == "Canceled") {
            $('#cancel_remark').show();
        }
        if (status == "Deliver") {
            $('#deli_ref_no').show();
        }
        $(document).on('change', '#order_status', function() {
            var new_status = $(this).val();

            if (new_status == "Canceled") {
                $('#cancel_remark').show();
                $(".cancel_remark").prop('required', true);
                deli_ref_no_hide();
            } else if (new_status == "Deliver") {
                $('#deli_ref_no').show();
                $('#deli_ref_no_input').prop('required', true);
                cancel_remark_hide();
            } else {
                cancel_remark_hide();
                deli_ref_no_hide();
            }
        });

        $(document).on('click', '#edit-btn', () => {
            $toRemoveDisabled = ['.dynamic_select', '.dynamic_radio'];
            $('.dynamic_input').removeAttr('readonly');
            $toRemoveDisabled.forEach(element => {
                $(element).removeAttr('disabled');
            });
            // $('.update-btn').show();
        })
        $extra_gross_weight_charge = '{{ $extraGrossWeightCharge }}';

        $deliveryCalculateMethod = function(data) {
            if ($("input[type='radio'][name='delivery_type']:checked").val() ==
                'premium') { // when deli type checkbox is premium
                $('#delivery_charge').val(Number($extra_gross_weight_charge ?? 0) + data[1].delivery_charges[1]
                    .amount);
            } else { // when deli type checkbox id normal
                $('#delivery_charge').val(Number($extra_gross_weight_charge ?? 0) + data[1].delivery_charges[0]
                    .amount);
            }
        };

        const townshipOnchangeFunc = function() {
            $("input[type='radio'][name='delivery_type']").on('change', function(e) { //normal premium select box
                e.preventDefault();
                let deliverychargeUrl = $('#township_select').children("option:selected").data(
                    'get-delivery-charge-url');

                $.ajax({
                    type: "GET",
                    url: deliverychargeUrl,
                    success: function(data) {
                        $deliveryCalculateMethod(data);
                    }
                });
            });

            $('#township_select').on('change', function() {
                let deliverychargeUrl = $(this).children("option:selected").data('get-delivery-charge-url');
                $.ajax({
                    type: "Get",
                    url: deliverychargeUrl,
                    dataType: "json",
                    success: function(data) {
                        console.log(data);
                        if (data[0].includes(data[1].township_id)) {
                            $('#deli_type').show(); //when premium is avaliable
                            $('#deli_type').removeClass('d-none');
                        } else {
                            $("input[type='radio'][name='delivery_type']")[0].checked = true;
                            $('#deli_type').hide();
                        }
                        $deliveryCalculateMethod(data);
                    },
                    error: function(data) {
                        console.log('err');
                    }
                })
            })
        }

        $('#city_select').on('change', function(e) {
            e.preventDefault();

            $("input[type='radio'][name='delivery_type']")[0].checked = true;

            let townshipUrl = $(this).children("option:selected").data('get-township-url');
            $('#delivery_charge').val('');
            $('#deli_type').hide()
            $.ajax({
                type: "Get",
                url: townshipUrl,
                success: function(data) {
                    $('#township_select_container').html(data);
                    townshipOnchangeFunc();
                }
            })


        });
        townshipOnchangeFunc();
    </script>
@endsection
