@extends('admin.layouts.master', ['title' => 'Create Logistic'])

@section('css')
<!-- Plugins css -->
<link href="{{asset('assets/libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
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
                  <li class="breadcrumb-item"><a href="javascript: void(0);">Logistics Management</a></li>
                  <li class="breadcrumb-item"><a href="javascript: void(0);">Logistics</a></li>
                  <li class="breadcrumb-item active">Create Logistic</li>
               </ol>
            </div>
            <h4 class="page-title">Create Logistic</h4>
         </div>
      </div>
   </div>
   <!-- end page title -->

   <div class="row">
      <div class="col-6">
         <div class="card">
            <div class="card-body">
               <form class="parsley-examples" action="{{ route('admin.logistics.store') }}" method="post">
                  @csrf
                  <div class="row">
                     <div class="col-md-12">
                        <div class="form-group mb-3">
                           <label for="loation">Location <span class="text-danger">*</span></label>
                           <select class="form-control select2" name="location" id="loation" required>
                              <option value="">--Select City/Region--</option>
                              @foreach ($locations as $township)
                              <option value="{{ $township->id }},{{ $township->region->id }}">
                                 {{ $township->name }} ({{ $township->region->name }})
                              </option>
                              @endforeach
                           </select>
                        </div>
                        <div class="form-group">
                            <label for="type">Type<span class="text-danger">*</span></label>
                            <input type="text"  name="type" parsley-trigger="change" required placeholder="Enter delivery type"
                               class="form-control" id="type">
                        </div>
                        <div class="form-group">
                           <label for="min_order_total">Minimum Order Total<span class="text-danger">*</span></label>
                           <input type="number" name="min_order_total" parsley-trigger="change" min="0" required placeholder="Enter amount"
                              class="form-control" id="min_order_total">
                        </div>
                        @foreach (config('custom_value.delivery_types') as $key => $value)
                            <div class="form-group">
                              <label for="delivery_fee_{{ $key }}">Delivery Charges ({{ $value }})<span class="text-danger">*</span></label>
                              <input type="number" name="delivery_charges[{{ $value }}]" parsley-trigger="change" min="0" placeholder="Enter amount"
                                 class="form-control" id="delivery_fee_{{ $key }}">
                           </div>
                        @endforeach
                        <div class="form-group">
                           <label for="area_description">Area Description<span class="text-danger">*</span></label>
                           <textarea name="area_description" rows="5" parsley-trigger="change" required
                              class="form-control" id="area_description" placeholder="Enter area description"></textarea>
                        </div>
                     </div> <!-- end col -->
                  </div> <!-- end row -->
                  <div class="row">
                     <div class="col-12">
                        <div class="text-center mt-3 mb-3">
                           <a href="{{ route('admin.logistics.index') }}"><button type="button"
                                 class="btn w-sm btn-light waves-effect">Cancel</button></a>
                           <button type="submit" class="btn w-sm btn-success waves-effect waves-light">Save</button>
                        </div>
                     </div> <!-- end col -->
                  </div>
               </form>

            </div> <!-- end card-body-->
         </div> <!-- end card -->
      </div> <!-- end col -->
   </div>
   <!-- end row -->

</div> <!-- container -->
@endsection

@section('script')
<!-- Plugins js-->
<script src="{{asset('assets/libs/parsleyjs/parsleyjs.min.js')}}"></script>
<script src="{{asset('assets/libs/select2/select2.min.js')}}"></script>

<!-- Page js-->
<script src="{{asset('assets/js/pages/form-validation.init.js')}}"></script>
<script>
   $(document).ready(function() {

      $('.select2').select2();

   });
</script>
@endsection
