@extends('admin.layouts.master', ['title' => 'Edit Slider'])

@section('css')
<!-- Plugins css -->
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
                  <li class="breadcrumb-item"><a href="javascript: void(0);">Slider Management</a></li>
                  <li class="breadcrumb-item"><a href="javascript: void(0);">Sliders</a></li>
                  <li class="breadcrumb-item active">Add Slider</li>
               </ol>
            </div>
            <h4 class="page-title">Add Slider</h4>
         </div>
      </div>
   </div>
   <!-- end page title -->
   <form class="parsley-examples" action="{{ route('admin.ads.update', ['slider', $ads->id]) }}" method="post" enctype="multipart/form-data">
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
                  <input type="text" name="name" id="product-name" class="form-control" value="{{ $ads->name }}" placeholder="e.g : Apple iMac" autofocus
                     required>
               </div>

               <div class="form-group mb-3">
                  <label for="slider-text-1">Text 1 </label>
                  <input type="text" name="slider_text1" id="slider-text-1" value="{{ $ads->slider_text1 }}" class="form-control">
               </div>

               <div class="form-group mb-3">
                  <label for="slider-text-2">Text 2 <span class="text-danger">*</span></label>
                  <input type="text" name="slider_text2" id="slider-text-2" value="{{ $ads->slider_text2 }}" class="form-control" required>
               </div>

               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group mb-3">
                        <label for="go-to-link">Link <span class="text-danger">*</span></label>
                        <input type="text" name="link" class="form-control" id="go-to-link" value="{{ $ads->link }}" placeholder="e.g : https://google.com"
                           required>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group mb-3">
                        <label for="slider-btn-txt">Slider Button Text </label>
                        <input type="text" name="btn_txt" class="form-control" id="slider-btn-txt" value="{{ $ads->btn_txt }}" placeholder="e.g : Shop now">
                     </div>
                  </div>
               </div>

               <div class="form-group mb-3">
                  <label for="sorting">Sorting <span class="text-danger">*</span></label>
                  <input type="number" name="sorting" min="1" class="form-control" id="sorting" value="{{ $ads->sorting }}" placeholder="1" required>
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
                  data-max-file-size="1000K"
                  data-max-width="1408"
                  data-max-height="993"
                  data-allowed-formats="landscape"
                  data-default-file="{{ $ads->image_url }}"
                  data-allowed-file-extensions='["png", "PNG", "jpg", "JPG", "jpeg", "JPEG"]'>
                  <p class="sub-header mt-2">file size is under 1000KB, max Width x Height is 1408 X 993 and Landscape only</p>

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
               <a href="{{ route('admin.ads.index', 'slider') }}">
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
<script src="{{asset('assets/libs/parsleyjs/parsleyjs.min.js')}}"></script>
<script src="{{asset('assets/libs/dropify/dropify.min.js')}}"></script>
<script src="{{asset('assets/libs/bootstrap-fileinput/fileinput.min.js')}}"></script>
<script src="{{asset('assets/libs/mohithg-switchery/mohithg-switchery.min.js')}}"></script>
<script src="{{asset('assets/libs/ladda/ladda.min.js')}}"></script>

<!-- Page js-->
<script src="{{asset('assets/js/pages/loading-btn.init.js')}}"></script>

<script>
   $(document).ready(function() {
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
