@extends('admin.layouts.master', ['title' => 'Add Product'])

@section('css')
<!-- Plugins css -->
<link href="{{asset('assets/libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/libs/summernote/summernote.min.css')}}" rel="stylesheet" type="text/css" />

<link href="{{asset('assets/libs/flatpickr/flatpickr.min.css')}}" rel="stylesheet" type="text/css" />

<link href="{{asset('assets/libs/bootstrap-fileinput/fileinput.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/libs/dropify/dropify.min.css')}}" rel="stylesheet" type="text/css" />

<link href="{{asset('assets/libs/mohithg-switchery/mohithg-switchery.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/libs/ladda/ladda.min.css')}}" rel="stylesheet" type="text/css" />

<style>
   .krajee-default .file-footer-caption {
      margin-bottom: 0px;
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
                  <li class="breadcrumb-item"><a href="javascript: void(0);">Product Management</a></li>
                  <li class="breadcrumb-item"><a href="javascript: void(0);">Products</a></li>
                  <li class="breadcrumb-item active">Add Product</li>
               </ol>
            </div>
            <h4 class="page-title">Add Product</h4>
         </div>
      </div>
   </div>
   <!-- end page title -->
   <form class="parsley-examples" action="{{ route('admin.products.store') }}" method="post" enctype="multipart/form-data">
      @csrf
      @if ($errors->any())
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
         </button>
         <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
         </ul>
      </div>
      @endif
      <div class="row">
         <div class="col-lg-6">
            <div class="card-box">
               <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">General</h5>

               <div class="form-group mb-3">
                  <label for="product-name">Product Name <span class="text-danger">*</span></label>
                  <input type="text" name="name" id="product-name" class="form-control" placeholder="Name" autofocus
                     required>
               </div>

               <div class="form-group mb-3">
                <label for="product-code">Product Code <span class="text-danger">*</span></label>
                <input type="text" name="product_code" id="product-code" class="form-control" placeholder="Enter Product Code" autofocus
                   required>
                </div>

               <div class="form-group mb-3">
                  <label for="product-category">Categories <span class="text-danger">*</span></label>
                  <select class="form-control select2" name="category_id" id="product-category" required>
                     <option value="">--Select Category--</option>
                     @foreach ($main_categories as $main_category)
                     <optgroup label="{{ $main_category->name }}">
                        @foreach ($main_category->childs as $sub_category)
                        <option value="{{ $sub_category->id }}">
                           {{ $sub_category->name }}
                           ({{ $sub_category->parent->name }})
                        </option>
                        @endforeach
                     </optgroup>
                     @endforeach
                  </select>
               </div>

               <div class="form-group mb-3">
                  <label for="product-brand">Brands <span class="text-danger">*</span></label>
                  <select class="form-control select2" name="brand_id" id="product-brand" required>
                     <option value="">--Select Brand--</option>
                     @foreach ($brands as $brand)
                     <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                     @endforeach
                  </select>
               </div>

               <div class="form-group mb-3">
                  <label for="product-description">Product Description <span class="text-danger">*</span></label>
                  <textarea class="form-control summernote" name="description" id="product-description" rows="5"
                     placeholder="Please enter description" required></textarea>
               </div>

               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group mb-3">
                        <label for="product-price">Price <span class="text-danger">*</span></label>
                        <input type="number" name="price" min="1" class="form-control" id="product-price"
                           placeholder="Enter amount" step=".01" required>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group mb-3">
                        <label for="product-sale-price">Sale Price <span class="text-danger">*</span></label>
                        <input data-parsley-gte="#product-price" data-parsley-gte-message="Sale price is greater than or equal to Price" type="number" name="sale_price" min="1" class="form-control" id="product-sale-price" step=".01" placeholder="Enter amount" required>
                     </div>
                  </div>
               </div>

               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group mb-3">
                        <label for="discount-amount">Discount Amount</label>
                        <input type="number" name="discount_amount" class="form-control" id="discount-amount"
                           placeholder="Enter amount">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group mb-3">
                        <label for="discount-type">Discount Type</label>
                        <select class="form-control" name="discount_type" id="discount-type">
                           <option value=>--Select Type--</option>
                           <option value="PERCENT">Percent(%)</option>
                           <option value="FIX">Fix</option>
                        </select>
                     </div>
                  </div>
                  <div class="col-md-12">
                     <div class="form-group mb-3">
                        <label>Discount Period</label>
                        <input type="text" name="discount_period" id="range-datepicker" class="form-control"
                           placeholder="2018-10-03 to 2018-10-10">
                     </div>
                  </div>
               </div>

               <div class="form-group mb-3">
                <label for="product-detail">Product Details</label>
                <textarea class="form-control summernote" name="detail" id="product-detail" rows="5"
                   placeholder="Please enter detail" ></textarea>
             </div>
            </div> <!-- end card-box -->
         </div> <!-- end col -->

         <div class="col-lg-6">

            <div class="card-box">
               <div class="row">
                  <div class="col-md-8">
                     <div class="form-row">
                        <div class="col-md-6 form-group mb-3">
                           <label for="product-stock">Stock <span class="text-danger">*</span></label>
                           <input type="number" name="stock" min="1" class="form-control" id="product-stock" placeholder="Enter amount" required>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                           <label for="product-uom">UOM <span class="text-danger">*</span></label>
                           <input type="text" name="uom" class="form-control" id="product-uom" placeholder="Enter UOM" required>
                        </div>
                     </div>
                  </div>

                  <div class="col-md-4">
                     <div class="form-group mb-3">
                        <label for="product-meta-new">New</label> <br>
                        <input type="checkbox" name="is_new" class="switchery" id="product-meta-new" value="1" />
                     </div>
                  </div>
               </div>

               <div class="row">
                  <div class="col-md-8">
                     <div class="form-row">
                        <div class="col-md-6 form-group mb-3">
                           <label for="product-net-weight">
                              Net Weight(KG) <span class="text-danger">*</span>
                           </label>
                           <input type="text" name="net_weight" class="form-control" id="product-net-weight" placeholder="Enter Net Weight(KG)" required>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                           <label for="product-gross-weight">
                              Gross Weight(KG) <span class="text-danger">*</span>
                           </label>
                           <input type="text" name="gross_weight" class="form-control" id="product-gross-weight" placeholder="Enter Gross Weight(KG)" required>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group mb-3">
                        <label for="product-sell-limit">
                            Sell Limit <span class="text-danger">*</span>
                         </label>
                         <input type="number" name="sell_limit" class="form-control" id="product-sell-limit" placeholder="Enter Sell Limit" >
                    </div>
                  </div>
               </div>

               <h5 class="text-uppercase mt-0 bg-light p-2">Feature Image</h5>
               <input type="file" name="feature_image" id="feature_image" data-max-file-size="500K"
                  data-allowed-file-extensions='["png", "PNG", "jpg", "JPG", "jpeg", "JPEG"]' required>

               <br>

               <h5 class="text-uppercase mt-0 bg-light p-2">Product Gallery</h5>
               <input type="file" name="product_galleries[]" id="product_galleries"
                  data-allowed-file-extensions='["png", "PNG", "jpg", "JPG", "jpeg", "JPEG"]' multiple>

               <div class="form-group mt-3">
                  <label class="mb-2">Status <span class="text-danger">*</span></label>
                  <br />
                  <div class="radio form-check-inline">
                     <input type="radio" id="inlineRadio1" value="1" name="status" checked="">
                     <label for="inlineRadio1"> Public </label>
                  </div>
                  <div class="radio form-check-inline">
                     <input type="radio" id="inlineRadio2" value="0" name="status">
                     <label for="inlineRadio2"> Draft </label>
                  </div>
               </div>

               <div class="form-group mb-3">
                <label for="other-information">Other Information</label>
                <textarea class="form-control summernote" name="other_information" id="orther-information" rows="5"
                   placeholder="Please enter other information" ></textarea>
             </div>
            </div> <!-- end col-->

         </div> <!-- end col-->
      </div>
      <!-- end row -->

      <div class="row">
         <div class="col-12">
            <div class="text-center mb-3">
               <a href="{{ route('admin.products.index') }}">
                  <button type="button" class="btn w-sm btn-light waves-effect">Cancel</button>
               </a>
               <button class="ladda-button btn btn-primary" dir="ltr" data-style="expand-right">
                  Submit
               </button>
            </div>
         </div> <!-- end col -->
      </div>
      <!-- end row -->
   </form>


   <!-- file preview template -->
   <div class="d-none" id="uploadPreviewTemplate">
      <div class="card mt-1 mb-0 shadow-none border">
         <div class="p-2">
            <div class="row align-items-center">
               <div class="col-auto">
                  <img data-dz-thumbnail src="#" class="avatar-sm rounded bg-light" alt="">
               </div>
               <div class="col pl-0">
                  <a href="javascript:void(0);" class="text-muted font-weight-bold" data-dz-name></a>
                  <p class="mb-0" data-dz-size></p>
               </div>
               <div class="col-auto">
                  <!-- Button -->
                  <a href="" class="btn btn-link btn-lg text-muted" data-dz-remove>
                     <i class="dripicons-cross"></i>
                  </a>
               </div>
            </div>
         </div>
      </div>
   </div>


</div> <!-- container -->
@endsection

@section('script')
<!-- Plugins js-->
<script src="{{asset('assets/libs/parsleyjs/parsleyjs.min.js')}}"></script>
<script src="{{asset('assets/libs/select2/select2.min.js')}}"></script>
<script src="{{asset('assets/libs/summernote/summernote.min.js')}}"></script>
<script src="{{asset('assets/libs/dropify/dropify.min.js')}}"></script>
<script src="{{asset('assets/libs/flatpickr/flatpickr.min.js')}}"></script>
<script src="{{asset('assets/libs/clockpicker/clockpicker.min.js')}}"></script>
<script src="{{asset('assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
<script src="{{asset('assets/libs/bootstrap-fileinput/fileinput.min.js')}}"></script>
<script src="{{asset('assets/libs/mohithg-switchery/mohithg-switchery.min.js')}}"></script>
<script src="{{asset('assets/libs/ladda/ladda.min.js')}}"></script>

<!-- Page js-->
<script src="{{asset('assets/js/pages/form-pickers.init.js')}}"></script>
<script src="{{asset('assets/js/pages/loading-btn.init.js')}}"></script>

<script>

   $(document).ready(function() {

            $('.summernote').summernote({
                height: 180,
                // set editor height
                minHeight: null,
                // set minimum height of editor
                maxHeight: null,
                // set maximum height of editor
                focus: false, // set focus to editable area after initializing summernote

                toolbar: [
                  ['style', ['style']],
                  ['font', ['bold', 'underline', 'clear']],
                  ['color', ['color']],
                  ['para', ['ul', 'ol', 'paragraph']],
                  ['table', ['table']],
                  ['insert', ['link']],
                  ['view', ['help']]
               ]
            });
            $('.select2').select2();
            $('#feature_image').dropify();
            $('.parsley-examples').parsley();

            // gt, gte, lt, lte, notequalto extra validators
            var parseRequirement = function (requirement) {
               if (isNaN(+requirement))
                  return parseFloat(jQuery(requirement).val());
               else
               return +requirement;
            };

            // Greater than or equal to validator
            window.Parsley.addValidator('gte', {
               validateString: function (value, requirement) {
                  return parseFloat(value) >= parseRequirement(requirement);
               },
               priority: 32
            });

            $("#product_galleries").fileinput({
                maxFileSize: 500,
            }).on('fileselect', function(event, numFiles, label) {
                $('button[type="button"].kv-file-zoom').remove();
                $('.fileinput-upload-button').remove();
            });

            var elems = Array.prototype.slice.call(document.querySelectorAll('.switchery'));
            elems.forEach(function(html) {
                var switchery = new Switchery(html, {
                    size: 'small'
                });
            });
        })
</script>
@endsection
