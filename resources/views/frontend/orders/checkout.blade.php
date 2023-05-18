@extends('frontend.layouts.master', ['title' => 'Checkout'])

@section('css')
    <style>
        .birthday-input {
            background-color: var(--white);
            border: 2px solid;
            border-color: #e4ecf2;
            height: 65px;
            -webkit-box-shadow: none;
            box-shadow: none;
            padding-left: 20px;
            font-size: 16px;
            color: var(--ltn__paragraph-color);
            width: 100%;
            margin-bottom: 30px;
            border-radius: 0;
            padding-right: 40px;
        }
    </style>
@endsection

@section('main-content')

    <!-- WISHLIST AREA START -->
    <div class="ltn__checkout-area mb-105">
        <div class="container">
            <div class="row">
                @if (count($carts))
                    <div class="col-lg-12">
                        <div class="ltn__checkout-inner">
                            <div class="ltn__checkout-single-content ltn__coupon-code-wrap">
                                <h5>Have a coupon? <a class="ltn__secondary-color" href="#ltn__coupon-code"
                                        data-bs-toggle="collapse">Click here
                                        to enter your code</a></h5>
                                <div id="ltn__coupon-code" class="collapse ltn__checkout-single-content-info">
                                    <div class="ltn__coupon-code-form">
                                        <p>If you have a coupon code, please apply it below.</p>
                                        <form action="#">
                                            <input type="text" class="coupon-name" name="coupon" placeholder="Coupon code">
                                            <button class="btn theme-btn-2 btn-effect-2 text-uppercase apply-coupon" data-url="{{ route('frontend.coupon-data') }}">Apply
                                                Coupon</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="ltn__checkout-single-content mt-50">
                                <h4 class="title-2">Billing Details</h4>
                                <div class="ltn__checkout-single-content-info">
                                    @php
                                        $rdo_class = 'rdo-container';
                                        $card_image = 'card-image';
                                    @endphp
                                    <form action="{{ route('frontend.checkout') }}" method="POST" id="checkout_form">
                                        @csrf
                                        <input type="hidden" class="coupon" name="coupon" value="">
                                        <input type="hidden" class="discount-input" name="discount" value="0">
                                        <h5 title-2>Personal Information</h5>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6>Name</h6>
                                                <div class="input-item input-item-name ltn__custom-icon">
                                                    <input value="{{ customerAuth()->name }}" type="text" name="name"
                                                        placeholder="Name" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <h6>Email</h6>
                                                <div class="input-item input-item-email ltn__custom-icon">
                                                    <input value="{{ customerAuth()->email }}" type="text" name="email"
                                                        placeholder="Email Address" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <h6>Contact Phone No</h6>
                                                <div class="input-item input-item-phone ltn__custom-icon">
                                                    <input value="{{ customerAuth()->contact_phone_no }}" type="text"
                                                        name="contact_phone_no" placeholder="Contact Phone Number" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <h6>Date Of Birth</h6>
                                                <div class="input-item">
                                                    <input value="{{ customerAuth()->birthday }}" type="date"
                                                        class="birthday-input" name="birthday"
                                                        placeholder="Birthday (optional)">
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6">
                                                <h6>Gender</h6>
                                                <div class="input-item">
                                                    <select class="nice-select" name="gender">
                                                        <option>Select Gender</option>
                                                        <option value="Male" @selected(customerAuth()->gender == 'Male')>Male</option>
                                                        <option value="Female" @selected(customerAuth()->gender == 'Female')>Female</option>
                                                        <option value="other" @selected(customerAuth()->gender == 'other')>Perfer not to
                                                            say</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12">
                                                <h6>Billing Address</h6>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="input-item">
                                                            <input value="{{ customerAuth()->billing_address }}"
                                                                type="text" name="billing_address"
                                                                placeholder="House number and street name">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12">
                                                <div class="ltn__checkout-payment-method mt-50">
                                                    <h6>Shipping Address</h6>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="input-item">
                                                            <input value="{{ customerAuth()->shipping_address }}"
                                                                type="text" name="shipping_address"
                                                                placeholder="House number and street name">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">

                                            <h5 title-2>Delivery Information</h5>

                                            <div class="col-lg-4 col-md-6">
                                                <h6>City</h6>
                                                <div class="input-item">
                                                    <select class="nice-select" name="city" id="city_select">
                                                        <option value="">Select City</option>
                                                        @foreach ($cities as $city)
                                                            <option value="{{ $city->id }}"
                                                                data-get-township-url="{{ route('frontend.township', $city->id) }}">
                                                                {{ $city->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6" id="township_select_container">
                                                <h6>Township</h6>
                                                <div style="cursor: no-drop;" class="input-item">
                                                    <select class="nice-select" disabled>
                                                        <option>Select Township</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6">
                                                <h6>Delivery Charge </h6>
                                                <div class="input-item">
                                                    <input style="cursor: no-drop;" id="deli_fee" name="delivery_charge"
                                                        type="text" placeholder="Delivery Charge" readonly required>
                                                </div>
                                            </div>
                                            <div style="display: none" class="col-lg-12 col-md-6" id="deli_type">
                                                <h6><b>Delivery-Type</b></h6>
                                                <div class=" mb-2 d-flex gap-2">
                                                    <label class="{{ $rdo_class }} ">Normal
                                                        <input type="radio" checked="checked" name="delivery_type"
                                                            value="normal">
                                                        <span class="checkmark"></span>
                                                    </label>
                                                    <label class="{{ $rdo_class }} ">Premium
                                                        <input type="radio" name="delivery_type" value="premium">
                                                        <span class="checkmark"></span>
                                                    </label>
                                                </div>
                                            </div>

                                        </div>
                                        <h6>Order Notes (optional)</h6>
                                        <div class="input-item input-item-textarea ltn__custom-icon">
                                            <textarea name="order_note" placeholder="Notes about your order, e.g. special notes for delivery.">{{ customerAuth()->shipping_address }}</textarea>
                                        </div>

                                        <div class="row">
                                            <div class="ltn__checkout-payment-method col-lg-7 mt-50">
                                                <h4 class="title-2">Payment Method</h4>
                                                <div id="checkout_accordion_1">
                                                    <!-- card -->
                                                    <div class="card">
                                                        <h5>Cash</h5>
                                                        <label class="{{ $rdo_class }} other_payment">Cash On Delivery
                                                            <input type="radio" checked="checked" name="payment_method"
                                                                value="cod">
                                                            <span class="checkmark"></span>
                                                        </label>
                                                    </div>
                                                    <div class="card">
                                                        <h5>Pay</h5>
                                                        <div class=" d-flex gap-3">
                                                            <label class="{{ $rdo_class }} other_payment">KBZ Pay
                                                                <img class="{{ $card_image }}"
                                                                    src="{{ asset('assets/theme/img/icons/KBZpay.png') }}"
                                                                    alt="#">
                                                                <input type="radio" name="payment_method"
                                                                    value="k_pay">
                                                                <span class="checkmark"></span>
                                                            </label>

                                                            <label class="{{ $rdo_class }} other_payment">Wave Pay
                                                                <img class="{{ $card_image }}"
                                                                    src="{{ asset('assets/theme/img/icons/WavePay.jfif') }}"
                                                                    alt="#">
                                                                <input type="radio" name="payment_method"
                                                                    value="wave_pay">
                                                                <span class="checkmark"></span>
                                                            </label>

                                                            <label class="{{ $rdo_class }} other_payment">Aya Pay
                                                                <img class="{{ $card_image }}"
                                                                    src="{{ asset('assets/theme/img/icons/AyaPay.jpg') }}"
                                                                    alt="#">
                                                                <input type="radio" name="payment_method"
                                                                    value="aya_pay">
                                                                <span class="checkmark"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="card">
                                                        <h5>Card</h5>
                                                        <div class="d-flex gap-1 mb-2">
                                                            <label class="{{ $rdo_class }} card_payment">Accepted Cards
                                                                <div class="d-flex gap-2">
                                                                    <img class="{{ $card_image }}"
                                                                        src="{{ asset('assets/theme/img/icons/visa_icon.png') }}"
                                                                        alt="#">
                                                                    <img class="{{ $card_image }}"
                                                                        src="{{ asset('assets/theme/img/icons/mastercard_icon.png') }}"
                                                                        alt="#">
                                                                    <img class="{{ $card_image }}"
                                                                        src="{{ asset('assets/theme/img/icons/jcb_icon (1).png') }}"
                                                                        alt="#">
                                                                    <img class="{{ $card_image }}"
                                                                        src="{{ asset('assets/theme/img/icons/mpu.jpg') }}"
                                                                        alt="#">
                                                                </div>
                                                                <input type="radio" name="payment_method"
                                                                    value="card">
                                                                <span class="checkmark"></span>
                                                            </label>
                                                        </div>

                                                        <div action="#" style="display: none" class=""
                                                            id="card_form">
                                                            <div>
                                                                <h6>Name on Card</h6>
                                                                <div class="">
                                                                    <input class="card_input" value=""
                                                                        type="text" name="name_on_card"
                                                                        placeholder="{{ customerAuth()->name }}">
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <h6>Credit card number</h6>
                                                                <div class="">
                                                                    <input class="card_input" value=""
                                                                        type="text" name="card_number"
                                                                        placeholder="1111-2222-3333-4444">
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <h6>Exp Month</h6>
                                                                <div class="">
                                                                    <input class="card_input" value=""
                                                                        type="text" name="exp_month"
                                                                        placeholder="November">
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <h6>Exp Year</h6>
                                                                    <div class="">
                                                                        <input class="card_input" value=""
                                                                            type="text" name="exp_year"
                                                                            placeholder="2022">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <h6>CVV</h6>
                                                                    <div class="">
                                                                        <input class="card_input" value=""
                                                                            type="text" name="cvv"
                                                                            placeholder="354">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="ltn__payment-note mt-30 mb-30">
                                                    <p>Your personal data will be used to process your order, support your
                                                        experience throughout this website, and
                                                        for other purposes described in our privacy policy.</p>
                                                </div>
                                                <button class="btn theme-btn-1 btn-effect-1 text-uppercase"
                                                    type="submit">Place order</button>
                                            </div>
                                            <div class="col-lg-5">
                                                <div style="" class="shoping-cart-total mt-50">
                                                    <h4 class="title-2">Cart Totals</h4>
                                                    <table class="table mb-4">
                                                        <tbody>
                                                            @php
                                                                $order_total = 0;
                                                            @endphp
                                                            @foreach ($carts as $cart)
                                                                @php
                                                                    $price = $cart->product->discount ?? $cart->product->sale_price;
                                                                    $order_total += $price * $cart->quantity;
                                                                @endphp
                                                                <tr>
                                                                    <td>{{ $cart->product->name }} <strong>×
                                                                            {{ $cart->quantity }}</strong></td>
                                                                    <td>MMK {{ $price }}</td>
                                                                </tr>
                                                            @endforeach
                                                            <tr>
                                                                <td><strong>Sub_Total</strong></td>
                                                                <td><strong>MMK <span
                                                                            id='sub_total'>{{ $order_total }}</span></strong>
                                                                </td>
                                                            </tr>
                                                            <tr class="discount-section">

                                                            </tr>
                                                            <tr>
                                                                @php
                                                                    $total_gross_weight = 0;
                                                                @endphp
                                                                @foreach ($carts as $cart)
                                                                    @php
                                                                        $total_gross_weight += $cart->product->gross_weight * $cart->quantity;
                                                                    @endphp
                                                                @endforeach
                                                                <td><strong>Total_Weight</strong></td>
                                                                <td><strong>KG <span
                                                                            id='gross_weight_total'>{{ $total_gross_weight }}</span></strong>
                                                                </td>
                                                            </tr>

                                                            @if ($total_gross_weight >= 3.1)
                                                                @php
                                                                    if ($total_gross_weight >= 3.1) {
                                                                        $totalGrossWeightInteger = ceil($total_gross_weight);
                                                                        $extraGrossWeight = $totalGrossWeightInteger - 3;
                                                                        $extraGrossWeightCharge = $extraGrossWeight * 1000;
                                                                    } else {
                                                                        $extraGrossWeightCharge = 0;
                                                                    }
                                                                    $order_total += $extraGrossWeightCharge;
                                                                @endphp

                                                                <tr>
                                                                    <input type="hidden" form="checkout_form"
                                                                        name="extra_gross_weight_charge"
                                                                        value="{{ $extraGrossWeightCharge }}">
                                                                    <td><strong>Extra_Weight_Charge</strong></td>
                                                                    <td><strong>MMK
                                                                            <span>{{ $extraGrossWeightCharge }}</span></strong>
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                            <tr id="deli_fee_container" style="display: none">
                                                                <td><strong>Total_Delivery_Charge</strong></td>
                                                                <td><strong>MMk <span id="delivery_charge"></span></strong>
                                                                </td>
                                                            </tr>
                                                            <tr id="order_total_container" style="display: none">
                                                                <td><strong>Order_Total</strong></td>
                                                                <td><strong>MMK <span id="order_total"></span></strong>
                                                                </td>
                                                            </tr>

                                                        </tbody>
                                                    </table>
                                                    <b class=""><span class="text-danger">*</span> Delivery Charges
                                                        ကောက်ခံခြင်း - 3 kg အထက်ကို 1kg တိုးလျှင် ၁ထောင်ကျပ်
                                                        ကောက်ခံမည်ဖြစ်ပါသည်။</b>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-lg-12">
                        <div class="ltn__checkout-inner">
                            <div class="ltn__checkout-single-content ltn__coupon-code-wrap">
                                <h5>There is no products in your cart! <a class="ltn__secondary-color"
                                        href="{{ route('frontend.home') }}">Click here to go to shop for more
                                        products.</a></h5>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <!-- WISHLIST AREA START -->
@endsection
@section('script')
    <script src="{{ asset('assets/js/custom/checkout_page.js') }}"></script>
@endsection
