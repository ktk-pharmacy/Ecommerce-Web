@extends('admin.layouts.master', ['title' => 'Add Product'])

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
                  <li class="breadcrumb-item active">Import Product</li>
               </ol>
            </div>
            <h4 class="page-title">Import Product</h4>
         </div>
      </div>
   </div>
   <!-- end page title -->

      <div class="row mb-2">
         <div class="col-lg-6">
            <div class="card-box">
               <form class="parsley-examples" id="import-form" action="{{ route('admin.products.import') }}" method="post" enctype="multipart/form-data">
                  @csrf
                  <div class="mb-3">
                     <label for="file-input" class="form-label">Please choose a file</label>
                     <input type="file" name="file" id="file-input" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" class="form-control" required>
                  </div>
                  <div class="text-center mb-3">
                     <a href="{{ route('admin.products.index') }}">
                        <button type="button" class="btn w-sm btn-light waves-effect">Cancel</button>
                     </a>
                     <button class="ladda-button btn btn-primary" id="submit-btn" dir="ltr" data-style="expand-right">
                        Import
                     </button>
                     <button class="btn btn-primary" id="loading-btn" type="button" style="display: none;" disabled="">
                        <span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>
                        Please wait...
                     </button>
                  </div>
               </form>
            </div>
         </div>


      </div>

      <h4 class="mb-4">Import Main Category</h4>
      <div class="row mb-2">
        <div class="col-lg-6">
            <div class="card-box">
               <form class="parsley-examples" id="main-import-form" action="{{ route('main-category-import') }}" method="post" enctype="multipart/form-data">
                  @csrf
                  <div class="mb-3">
                     <label for="file-input" class="form-label">Please choose a file</label>
                     <input type="file" name="file" id="file-input" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" class="form-control" required>
                  </div>
                  <div class="text-center mb-3">
                     <a href="{{ route('admin.categories.index') }}">
                        <button type="button" class="btn w-sm btn-light waves-effect">Cancel</button>
                     </a>
                     <button class="ladda-button btn btn-primary" id="submit-btn" dir="ltr" data-style="expand-right">
                        Import
                     </button>
                     <button class="btn btn-primary" id="loading-btn" type="button" style="display: none;" disabled="">
                        <span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>
                        Please wait...
                     </button>
                  </div>
               </form>
            </div>
         </div>
      </div>

      <h4 class="mb-4">Import Sub Category</h4>
      <div class="row">
        <div class="col-lg-6">
            <div class="card-box">
               <form class="parsley-examples" id="sub-import-form" action="{{ route('sub-category-import') }}" method="post" enctype="multipart/form-data">
                  @csrf
                  <div class="mb-3">
                     <label for="file-input" class="form-label">Please choose a file</label>
                     <input type="file" name="file" id="file-input" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" class="form-control" required>
                  </div>
                  <div class="text-center mb-3">
                     <a href="{{ route('admin.categories.index') }}">
                        <button type="button" class="btn w-sm btn-light waves-effect">Cancel</button>
                     </a>
                     <button class="ladda-button btn btn-primary" id="submit-btn" dir="ltr" data-style="expand-right">
                        Import
                     </button>
                     <button class="btn btn-primary" id="loading-btn" type="button" style="display: none;" disabled="">
                        <span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>
                        Please wait...
                     </button>
                  </div>
               </form>
            </div>
         </div>
      </div>

</div>
@endsection

@section('script')
<!-- Plugins js-->
<script src="{{asset('assets/libs/parsleyjs/parsleyjs.min.js')}}"></script>
<script>
$(function() {
   $("#import-form").submit(function (e) {
      $("#submit-btn").hide();
      $("#loading-btn").show();
   });

   $("#main-import-form").submit(function (e) {
      $("#submit-btn").hide();
      $("#loading-btn").show();
   });

   $("#sub-import-form").submit(function (e) {
      $("#submit-btn").hide();
      $("#loading-btn").show();
   });

})
</script>
@endsection
