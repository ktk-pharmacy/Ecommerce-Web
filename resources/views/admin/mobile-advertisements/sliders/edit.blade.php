@extends('admin.layouts.master', ['title' => 'Edit Slider'])

@section('css')
<!-- Plugins css -->
<link href="{{asset('assets/libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
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
                  <li class="breadcrumb-item"><a href="javascript: void(0);">Mobile Advertisements</a></li>
                  <li class="breadcrumb-item"><a href="javascript: void(0);">Sliders</a></li>
                  <li class="breadcrumb-item active">Edit Slider</li>
               </ol>
            </div>
            <h4 class="page-title">Edit Slider</h4>
         </div>
      </div>
   </div>
   <!-- end page title -->
   <form class="parsley-examples" action="{{ route('admin.mobile-ads.update', ['slider', $ads->id]) }}" method="post"
      enctype="multipart/form-data">
      @method('patch')
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
               <div class="form-group mb-3">
                  <label for="product-name">Ads Name <span class="text-danger">*</span></label>
                  <input type="text" name="name" id="product-name" value="{{ $ads->name }}" class="form-control" placeholder="Name" autofocus
                     required>
               </div>

               <div class="form-group row">
                  <div class="col-md-6 col-sm-6">
                     <label for="slider_type">Type <span class="text-danger">*</span></label>
                     <select name="type" id="slider_type" class="form-control">
                        <option value="product" @selected($ads->type == 'product')>Product</option>
                        {{-- <option value="category">Category</option> --}}
                     </select>
                  </div>

                  <div class="col-md-6 col-sm-6">
                     <label for="sorting">Sorting <span class="text-danger">*</span></label>
                     <input type="number" name="sorting" min="1" value="{{ $ads->sorting }}" class="form-control" id="sorting" placeholder="1" required>
                  </div>
               </div>

               <div class="form-group mb-3">
                  <label for="product-list">Reference item <span class="text-danger">*</span></label>
                  <select class="form-control select2" name="reference_id" id="product-list" required>
                     <option value="">--Please choose--</option>
                     @foreach ($products as $product)
                     <option value="{{ $product->id }}" @selected($ads->reference_id == $product->id)>{{ $product->name }}</option>
                     @endforeach
                  </select>
               </div>

            </div> <!-- end card-box -->
         </div> <!-- end col -->

         <div class="col-lg-6">

            <div class="card-box">
               <label for="image">Slider Image <span class="text-danger">*</span></label>
               <input
                  type="file"
                  name="image"
                  id="image"
                  data-max-file-size="500K"
                  data-max-width="1500"
                  data-max-height="1000"
                  data-allowed-formats="landscape"
                  data-allowed-file-extensions='["png", "PNG", "jpg", "JPG", "jpeg", "JPEG"]'
                  data-default-file="{{ $ads->image_url }}">
               <p class="sub-header mt-2">file size is under 500KB, max Width x Height is 1500 X 1000 and Landscape only</p>

               <div class="form-group mt-3 mb-0">
                  <label for="status">Active</label>
                  <input type="checkbox" name="status" class="switchery" id="status" value="1" @checked($ads->status) />
               </div>
            </div> <!-- end col-->

         </div> <!-- end col-->
      </div>
      <!-- end row -->

      <div class="row">
         <div class="col-12">
            <div class="text-center mb-3">
               <a href="{{ route('admin.mobile-ads.index', 'slider') }}">
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

</div> <!-- container -->
@endsection

@section('script')
<!-- Plugins js-->
<script src="{{asset('assets/libs/select2/select2.min.js')}}"></script>
<script src="{{asset('assets/libs/parsleyjs/parsleyjs.min.js')}}"></script>
<script src="{{asset('assets/libs/dropify/dropify.min.js')}}"></script>
<script src="{{asset('assets/libs/bootstrap-fileinput/fileinput.min.js')}}"></script>
<script src="{{asset('assets/libs/mohithg-switchery/mohithg-switchery.min.js')}}"></script>
<script src="{{asset('assets/libs/ladda/ladda.min.js')}}"></script>

<!-- Page js-->
<script src="{{asset('assets/js/pages/loading-btn.init.js')}}"></script>

<script>
   $(document).ready(function() {
      $('.select2').select2();
      $('#image').dropify();
      $('.parsley-examples').parsley();

      var elems = Array.prototype.slice.call(document.querySelectorAll('.switchery'));
      elems.forEach(function(html) {
            var switchery = new Switchery(html, {
               size: 'small'
            });
      });
   })
</script>
@endsection
