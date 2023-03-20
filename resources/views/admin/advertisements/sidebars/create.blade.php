@extends('admin.layouts.master', ['title' => 'Add Sidebar'])

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
                  <li class="breadcrumb-item"><a href="javascript: void(0);">Sidebar Management</a></li>
                  <li class="breadcrumb-item"><a href="javascript: void(0);">Sidebars</a></li>
                  <li class="breadcrumb-item active">Add Sidebar</li>
               </ol>
            </div>
            <h4 class="page-title">Add Sidebar</h4>
         </div>
      </div>
   </div>
   <!-- end page title -->
   <form class="parsley-examples" action="{{ route('admin.ads.store', request()->type) }}" method="post"
      enctype="multipart/form-data">
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
                  <label for="ads-name">Ads Name <span class="text-danger">*</span></label>
                  <input type="text" name="name" id="ads-name" class="form-control" placeholder="Name" autofocus required>
               </div>

               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group mb-3">
                        <label for="go-to-link">Link <span class="text-danger">*</span></label>
                        <input type="text" name="link" class="form-control" id="go-to-link" placeholder="e.g : https://google.com" required>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group mb-3">
                        <label for="sorting">Sorting <span class="text-danger">*</span></label>
                        <input type="number" name="sorting" min="1" class="form-control" id="sorting" placeholder="1" required>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group mb-3">
                        <label for="image">Image <span class="text-danger">*</span></label>
                        <input
                           type="file"
                           name="image"
                           id="image"
                           data-max-file-size="500K"
                           data-max-width="600"
                           data-max-height="701"
                           data-allowed-formats="portrait"
                           data-allowed-file-extensions='["png", "PNG", "jpg", "JPG", "jpeg", "JPEG"]'>
                           <p class="sub-header mt-2">file size is under 500KB, max Width x Height is 600 X 701 and Portrait only</p>
                     </div>
                  </div>

                  <div class="col-md-6">
                     <div class="form-group mt-3 mb-0">
                        <label for="status">Active</label>
                        <input type="checkbox" name="status" class="switchery" id="status" value="1" checked />
                     </div>
                  </div>

                  <div class="col-12">
                     <div class="text-center mb-3">
                        <a href="{{ route('admin.ads.index', request()->type) }}">
                           <button type="button" class="btn w-sm btn-light waves-effect">Cancel</button>
                        </a>
                        <button class="ladda-button btn btn-primary" dir="ltr" data-style="expand-right">
                           Submit
                        </button>
                     </div>
                  </div> <!-- end col -->
               </div>

            </div> <!-- end card-box -->
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
