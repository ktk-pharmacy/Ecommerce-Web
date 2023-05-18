@extends('frontend.layouts.master', ['title' => 'My Account'])

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

        @media print {

            #main_header,
            #cart,
            #pageTitle,
            #nav,
            #pageFoot,
            #main_footer,
            #main_breadcrumb,
            #original_table * {
                display: none;
            }
        }
    </style>
@endsection

@section('main-content')
    <!-- WISHLIST AREA START -->
    <div class="liton__wishlist-area pb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- PRODUCT TAB AREA START -->
                    <div class="ltn__product-tab-area">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="ltn__tab-menu-list mb-50">
                                        <div class="nav " id="nav">
                                            <a class="active show" data-bs-toggle="tab" href="#liton_tab_1_1">Dashboard <i
                                                    class="fas fa-home"></i></a>
                                            <a data-bs-toggle="tab" href="#liton_tab_1_2" id="orders">Orders <i
                                                    class="fas fa-file-alt"></i></a>
                                            <a class="d-none" data-bs-toggle="tab" href="#liton_tab_1_3">Downloads <i
                                                    class="fas fa-arrow-down"></i></a>
                                            <a class="d-none" data-bs-toggle="tab" href="#liton_tab_1_4">address <i
                                                    class="fas fa-map-marker-alt"></i></a>
                                            <a data-bs-toggle="tab" href="#liton_tab_1_5">Account Details <i
                                                    class="fas fa-user"></i></a>
                                            <a href="{{ route('frontend.logout') }}">Logout <i
                                                    class="fas fa-sign-out-alt"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="tab-content">
                                        <div class="tab-pane fade active show " id="liton_tab_1_1">
                                            <div class="ltn__myaccount-tab-content-inner">
                                                <p>Hello <strong>{{ $customer->username }}</strong> (not
                                                    <strong>{{ $customer->username }}</strong>? <small><a
                                                            href="{{ route('frontend.logout') }}">Log out</a></small> )
                                                </p>
                                                <p>From your account dashboard you can view your <span>recent orders</span>,
                                                    manage your <span>shipping and billing addresses</span>, and <span>edit
                                                        your password and account details</span>.</p>
                                            </div>
                                            <button class="btn btn-secondary danger-btn" id="deactivate_btn"
                                                data-action-url="{{ route('frontend.deactivate-myaccount', $customer->id) }}">DeAcivate
                                                Acc</button>
                                            <button class="btn btn-dark danger-btn" id="delete_btn"
                                                data-action-url="{{ route('frontend.delete-myaccount', $customer->id) }}">Delete
                                                Acc</button>
                                        </div>
                                        <div class="tab-pane fade" id="liton_tab_1_2">
                                            <div class="ltn__myaccount-tab-content-inner">
                                                <div class="table-responsive">
                                                    <table class="table" id="original_table">
                                                        <thead>
                                                            <tr>
                                                                <th>Order ID</th>
                                                                <th>Date</th>
                                                                <th>Status</th>
                                                                <th>Total</th>
                                                                <th>Deli-Ref-No</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($orders as $order)
                                                                <tr class="parent">
                                                                    <td>{{ $order->id }}</td>
                                                                    <td>{{ $order->created_at->format('d-M-Y') }}</td>
                                                                    <td>{{ $order->status }}</td>
                                                                    <td>{{ $order->delivery_charge==Null?$order->order_total-$order->coupon_amount:$order->delivery_charge+$order->order_total-$order->coupon_amount }}
                                                                        Ks</td>
                                                                    <td>{{ $order->delivery_ref_no ?? 'Null' }}</td>
                                                                    <td>
                                                                        <a href="javascript:void(0);" title="Order View"
                                                                            class="order-detail-view-btn"
                                                                            data-order-detail-view-url="{{ route('frontend.order.detail-view', $order->id) }}">View</a>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                    <div id="container">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="p-2" id="delivery_detail">
                                                <small class="mb-2 d-block"><strong>Delivery Information</strong></small>
                                                <small class='mb-1 d-block'><b>Name :</b> {{ $customer->name }}</small>
                                                <small class='mb-1 d-block'><b>Email :</b> {{ $customer->email }}</small>
                                                <small class='mb-1 d-block'><b>Contact Phone :</b>
                                                    {{ $customer->contact_phone_no }}</small>
                                                <small class='mb-1 d-block'><b>Billing Address :</b>
                                                    {{ $customer->billing_address }}</small>
                                                <small class='mb-1 d-block'><b>Shipping Address :</b>
                                                    {{ $customer->shipping_address }}</small>
                                            </div>
                                        </div>
                                        {{-- <div class="tab-pane fade " id="liton_tab_1_3 d-none">
                                        <div class="ltn__myaccount-tab-content-inner">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Product</th>
                                                            <th>Date</th>
                                                            <th>Expire</th>
                                                            <th>Download</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>Carsafe - Car Service HTML Template</td>
                                                            <td>Nov 10, 2020</td>
                                                            <td>Yes</td>
                                                            <td><a href="#"><i class="far fa-arrow-to-bottom mr-1"></i> Download File</a></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Carsafe - Car Service WordPress Theme</td>
                                                            <td>Nov 12, 2020</td>
                                                            <td>Yes</td>
                                                            <td><a href="#"><i class="far fa-arrow-to-bottom mr-1"></i> Download File</a></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div> --}}
                                        <div class="tab-pane fade " id="liton_tab_1_4">
                                            <div class="ltn__myaccount-tab-content-inner">
                                                <p>The following addresses will be used on the checkout page by default.</p>
                                                <div class="row">
                                                    <div class="col-md-6 col-12 learts-mb-30">
                                                        <h4>Billing Address <small><a href="#">edit</a></small></h4>
                                                        <address>
                                                            <p><strong>{{ $customer->name }}</strong></p>
                                                            <p>{{ $customer->billing_address }} <br></p>
                                                            <p>Mobile: {{ $customer->contact_phone_no }}</p>
                                                        </address>
                                                    </div>
                                                    <div class="col-md-6 col-12 learts-mb-30">
                                                        <h4>Shipping Address <small><a href="#">edit</a></small></h4>
                                                        <address>
                                                            <p><strong>{{ $customer->name }}</strong></p>
                                                            <p>{{ $customer->shipping_address }} <br></p>
                                                            <p>Mobile: {{ $customer->contact_phone_no }}</p>
                                                        </address>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade " id="liton_tab_1_5">
                                            <div class="ltn__myaccount-tab-content-inner">
                                                <p>
                                                    The following addresses will be used on the checkout page by default for
                                                    {{ $customer->username }}
                                                </p>
                                                <div class="ltn__form-box">
                                                    <form method="POST">
                                                        @csrf
                                                        <h6>Personal Information</h6>
                                                        <div class="row mb-50">
                                                            <div class="col-md-6">
                                                                <div class="input-item input-item-name ltn__custom-icon">
                                                                    <input value="{{ $customer->name }}" type="text"
                                                                        name="name" placeholder="Name" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="input-item input-item-email ltn__custom-icon">
                                                                    <input value="{{ $customer->email }}" type="text"
                                                                        name="email" placeholder="Email Address" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="input-item input-item-phone ltn__custom-icon">
                                                                    <input value="{{ $customer->contact_phone_no }}"
                                                                        type="text" name="contact_phone_no"
                                                                        placeholder="Contact Phone Number" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="input-item">
                                                                    <input value="{{ $customer->birthday }}" type="date"
                                                                        class="birthday-input" name="birthday"
                                                                        placeholder="Birthday (optional)">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6">
                                                                <h6>Gender</h6>
                                                                <div class="input-item">
                                                                    <select class="nice-select" name="gender">
                                                                        <option>Select Gender</option>
                                                                        <option value="Male"
                                                                            @selected($customer->gender == 'Male')>Male</option>
                                                                        <option value="Female"
                                                                            @selected($customer->gender == 'Female')>Female</option>
                                                                        <option value="other"
                                                                            @selected($customer->gender == 'other')>Perfer not to say
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 col-md-12">
                                                                <h6>Billing Address</h6>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="input-item">
                                                                            <input
                                                                                value="{{ $customer->billing_address }}"
                                                                                type="text" name="billing_address"
                                                                                placeholder="House number and street name">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 col-md-12">
                                                                <h6>Shipping Address</h6>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="input-item">
                                                                            <input
                                                                                value="{{ $customer->shipping_address }}"
                                                                                type="text" name="shipping_address"
                                                                                placeholder="House number and street name">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <fieldset>
                                                            <legend>Password change</legend>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <label>Current password (leave blank to leave
                                                                        unchanged):</label>
                                                                    <input type="password" name="current_password">
                                                                    <label>New password (leave blank to leave
                                                                        unchanged):</label>
                                                                    <input type="password" name="password">
                                                                    <label>Confirm new password:</label>
                                                                    <input type="password" name="confirm_password">
                                                                </div>
                                                            </div>
                                                        </fieldset>
                                                        <div class="btn-wrapper">
                                                            <button type="submit"
                                                                class="btn theme-btn-1 btn-effect-1 text-uppercase">Save
                                                                Changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- PRODUCT TAB AREA END -->
                </div>
            </div>
        </div>
    </div>
    <!-- WISHLIST AREA START -->

    <!-- CALL TO ACTION START (call-to-action-6) -->
    <div class="ltn__call-to-action-area call-to-action-6 before-bg-bottom" data-bs-bg="img/1.jpg--" id="pageFoot">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div
                        class="call-to-action-inner call-to-action-inner-6 ltn__secondary-bg position-relative text-center---">
                        <div class="coll-to-info text-color-white">
                            <h1>Buy medical disposable face mask <br> to protect your loved ones</h1>
                        </div>
                        <div class="btn-wrapper">
                            <a class="btn btn-effect-3 btn-white" href="{{ route('frontend.products.index') }}">Explore
                                Products <i class="icon-next"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- CALL TO ACTION END -->
@endsection
@section('script')
    <script>
        $('.danger-btn').click(function() {
            $url = $(this).data('action-url');
            $condition = $(this).attr('id') == "deactivate_btn" ? 'Deactivate' : 'Delete';
            Swal.fire({
                title: 'Are you sure?',
                text: `You want to ${$condition} your Account!`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: `Yes, ${$condition} now!`
            }).then((result) => {
                if (result.isConfirmed) {
                    if ($condition == 'Deactivate') {
                        $.ajax({
                            type: "get",
                            url: $url,
                            success: function(response) {
                                if (response.status == 'success') {
                                    window.location.href = '/home';
                                }
                            }
                        });
                    } else {
                        $.ajax({
                            type: "get",
                            url: $url,
                            success: function(response) {
                                if (response.status == 'success') {
                                    window.location.href = '/home';
                                }
                            }
                        });
                    }
                }
            })
        });
    </script>
@endsection
