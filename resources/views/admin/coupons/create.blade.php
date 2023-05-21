@extends('admin.layouts.master', ['title' => 'Create Coupon'])

@section('css')
<!-- Plugins css -->
<link href="{{asset('assets/libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/libs/flatpickr/flatpickr.min.css')}}" rel="stylesheet" type="text/css" />
<style>
   .form-control:disabled {
      cursor: not-allowed;
   }
</style>
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
                  <li class="breadcrumb-item active">Add Coupon</li>
               </ol>
            </div>
            <h4 class="page-title">Add Coupon</h4>
         </div>
      </div>
   </div>
   <!-- end page title -->

   <div class="row">
      <div class="col-12">
         <div class="card">
            <div class="card-body">
               <form class="parsley-validation" action="{{ route('admin.coupons.store') }}" method="post">
                  @csrf
                  <div class="row">
                     <div class="col-sm-2">
                        <div class="nav flex-column nav-pills nav-pills-tab" id="v-pills-tab" role="tablist"
                           aria-orientation="vertical">
                           <a class="nav-link show mb-1 active" id="coupon-general-tab" data-toggle="pill" href="#coupon-general"
                              role="tab" aria-controls="coupon-general" aria-selected="true">
                              General</a>
                           <a class="nav-link mb-1" id="usage-limits" data-toggle="pill" href="#usage-limit-tab" role="tab"
                              aria-controls="usage-limit-tab" aria-selected="false">
                              Usage limits</a>
                        </div>
                     </div> <!-- end col-->
                     <div class="col-sm-10">
                        <div class="tab-content pt-0">
                           <div class="tab-pane fade active show" id="coupon-general" role="tabpanel"
                              aria-labelledby="coupon-general-tab">
                              <div class="form-horizontal">

                                 <div class="form-group row">
                                    <label for="coupon_name" class="col-md-3 col-sm-3 col-form-label">Coupon name<span
                                          class="text-danger">*</span></label>
                                    <div class="col-md-3 col-sm-3">
                                       <input type="text" name="name" value="{{ old('name') }}" placeholder="Enter Coupon Name"
                                          id="coupon_name" class="form-control" required autofocus>
                                       @if ($errors->has('name'))
                                       <ul class="parsley-errors-list filled" id="parsley-id-5" aria-hidden="false">
                                          <li class="parsley-required">{{ $errors->first('name') }}</li>
                                       </ul>
                                       @endif
                                    </div>
                                 </div>

                                 <div class="form-group row">
                                    <label for="discount" class="col-md-3 col-sm-3 col-form-label">Discount amount<span
                                          class="text-danger">*</span></label>
                                    <div class="col-md-3 col-sm-3">
                                       <input type="number" name="amount" value="{{ old('amount') }}"
                                          placeholder="Enter Discount Amount" id="discount" class="form-control" required>
                                    </div>
                                 </div>

                                 <div class="form-group row">
                                    <label for="type" class="col-md-3 col-sm-3 col-form-label">Discount type<span
                                          class="text-danger">*</span></label>
                                    <div class="col-md-3 col-sm-3">
                                       <select name="type" id="type" class="form-control" required>
                                          <option value>--Select Discount Type--</option>
                                          <option value="percent" {{ old('type')=='percent' ? 'selected' : '' }}>Percent(%)
                                          </option>
                                          <option value="fix" {{ old('type')=='fix' ? 'selected' : '' }}>Fix amount</option>
                                       </select>
                                    </div>
                                 </div>

                                 <div class="form-group row">
                                    <label for="valid_date" class="col-md-3 col-sm-3 col-form-label">From Date<span
                                          class="text-danger">*</span></label>
                                    <div class="col-md-3 col-sm-3">
                                       {{-- <input type="text" name="valid_date" value="{{ old('valid_date') }}" id="range-datepicker"
                                          class="form-control" placeholder="2018-10-03 to 2018-10-10" required> --}}
                                          <input type="date" placeholder="Enter Date From" class="form-control" name="from" id="from_date" required>
                                    </div>
                                 </div>

                                 <div class="form-group row">
                                    <label for="valid_date" class="col-md-3 col-sm-3 col-form-label">To Date<span
                                          class="text-danger">*</span></label>
                                    <div class="col-md-3 col-sm-3">
                                       {{-- <input type="text" name="valid_date" value="{{ old('valid_date') }}" id="range-datepicker"
                                          class="form-control" placeholder="2018-10-03 to 2018-10-10" required> --}}
                                          <input type="date" placeholder="Enter Date To" class="form-control" name="to" required id="to_date">
                                    </div>
                                 </div>

                                 <div class="form-group row">
                                    <label for="min_amount" class="col-md-3 col-sm-3 col-form-label">Mininum checkout
                                       amount</label>
                                    <div class="col-md-3 col-sm-3">
                                       <input type="number" name="min_amount" placeholder="Enter Mininum checkout amount"
                                          id="min_amount" class="form-control" value="{{ old('min_amount') ?: 0 }}">
                                    </div>
                                 </div>

                                 <div class="form-group row coupon_quantity" style="display: none;">
                                    <label for="coupon_quantity" class="col-md-3 col-sm-3 col-form-label">Quantity</label>
                                    <div class="col-md-3 col-sm-3">
                                       <input type="number" name="coupon_quantity" id="coupon_quantity" class="form-control">
                                    </div>
                                    <div>
                                       @include('admin.layouts.shared/tooltip', ['title' => "How many times want to generate this
                                       coupon."])
                                    </div>
                                 </div>

                                 <div class="form-group row">
                                    <div class="custom-control custom-checkbox mt-4 ml-2">
                                       <input type="checkbox" value="1" class="custom-control-input" id="generate_coupon_name"
                                          name="generate_coupon_name" value="1">
                                       <label class="custom-control-label" for="generate_coupon_name">
                                          Generate Coupon
                                       </label>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="tab-pane fade" id="usage-limit-tab" role="tabpanel" aria-labelledby="usage-limits">
                              <div class="form-horizontal">

                                 <div class="form-group row">
                                    <label for="limit_per_coupon" class="col-md-3 col-sm-3 col-form-label">Usage limit per
                                       coupon</label>
                                    <div class="col-md-3 col-sm-3">
                                       <input type="number" name="limit_per_coupon" value="{{ old('limit_per_coupon') }}"
                                          id="min_amount" class="form-control">
                                    </div>
                                    <div>
                                       @include('admin.layouts.shared/tooltip', ['title' => "How many times this coupon can be
                                       used before it is void."])
                                    </div>

                                 </div>

                                 <div class="form-group row">
                                    <label for="limit_per_user" class="col-md-3 col-sm-3 col-form-label">Usage limit per
                                       user</label>
                                    <div class="col-md-3 col-sm-3">
                                       <input type="number" name="limit_per_user" value="{{ old('limit_per_user') }}"
                                          id="min_amount" class="form-control">
                                    </div>
                                    <div>
                                       @include('admin.layouts.shared/tooltip', ['title' => "How many times this coupon can be
                                       used by an individual user."])
                                    </div>
                                 </div>

                              </div>
                           </div>
                        </div>
                     </div> <!-- end col-->
                  </div>

                  <div class="row">
                     <div class="col-12">
                        <div class="text-center mt-3 mb-3">
                           <a href="{{ route('admin.coupons.index') }}"><button type="button"
                                 class="btn w-sm btn-light waves-effect">Cancel</button></a>
                           <button type="submit" class="btn w-sm btn-success waves-effect waves-light">Save</button>
                        </div>
                     </div> <!-- end col -->
                  </div>
               </form>
            </div> <!-- end card body-->
         </div> <!-- end card -->
      </div><!-- end col-->
   </div>
   <!-- end row-->

</div> <!-- container -->
@endsection

@section('script')
<!-- Plugins js-->
<script src="{{asset('assets/libs/parsleyjs/parsleyjs.min.js')}}"></script>
<script src="{{asset('assets/libs/select2/select2.min.js')}}"></script>
<script src="{{asset('assets/libs/flatpickr/flatpickr.min.js')}}"></script>
<script src="{{asset('assets/libs/tippy.js/tippy.js.min.js')}}"></script>


<script>
   $(document).ready(function() {
            $('.parsley-validation').parsley();
            // $('#range-datepicker').flatpickr({
            //    mode: "range"
            // });

            $('#from_date').flatpickr({
                minDate: "today"
            });
            $('#to_date').flatpickr({
                minDate: "today"
            });

            $("#generate_coupon_name").change(function() {
                var ischecked= $(this).is(':checked');
                if(ischecked){
                    $("#coupon_name")
                        .attr('readonly', true)
                        .attr('disabled', true)
                        .removeAttr('required', true)
                        .val('');
                    //display quantity input and add required attr if check generate coupon
                    $(".coupon_quantity").show();
                    $("#coupon_quantity").attr('required', true);
                } else {
                    $("#coupon_name")
                        .removeAttr('readonly', true)
                        .removeAttr('disabled', true)
                        .attr('required', true);
                    //hide quantity input and remove required attr if uncheck generate coupon
                    $(".coupon_quantity").hide();
                    $("#coupon_quantity").removeAttr('required', true);
                }

            });
        })
</script>
@endsection
