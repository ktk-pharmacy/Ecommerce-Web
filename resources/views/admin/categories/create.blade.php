@extends('admin.layouts.master', ['title' => 'Add New Category'])

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
            @php
                if (Request::get('type') == 'main-category') {
                    $breadcrumb_text = 'Add Main Category';
                } else {
                    $breadcrumb_text = 'Add Sub Category';
                }
            @endphp
            <div class="page-title-right">
               <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="javascript: void(0);">Category Management</a></li>
                  <li class="breadcrumb-item active">{{ $breadcrumb_text }}</li>
               </ol>
            </div>
            <h4 class="page-title">{{ $breadcrumb_text }}</h4>
         </div>
      </div>
   </div>
   <!-- end page title -->

   <div class="row">

      <div class="col-lg-6">
         <form class="parsley-examples" action="{{ route('admin.categories.store').'?type='.Request::get('type') }}" method="POST">
            @csrf
            <div class="card-box">
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group mb-3">
                        <label for="category">Category <span class="text-danger">*</span></label>
                        <select class="form-control select2" name="category" id="category" required>
                           @if (Request::get('type') == 'main-category')
                               <option value="">--Select Category Group--</option>
                           @else
                              <option value="">--Select Main Category--</option>
                           @endif

                           @foreach ($categories as $category)
                           <option value="{{ $category->id }}">
                              {{ $category->name }}
                              @if(Request::get('type') == 'sub-category')
                              ({{ $category->group->name }})
                              @endif
                           </option>
                           @endforeach
                        </select>
                     </div>
                     <div class="form-group mb-3">
                        <label for="title">Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="title" class="form-control" placeholder="Name" autofocus
                           required>
                     </div>
                     <div class="checkbox checkbox-success checkbox-circle mb-3">
                        <input id="brand_status" type="checkbox" name="status" checked="" value="1">
                        <label for="brand_status">
                           Active
                        </label>
                     </div>
                     <div class="text-center mb-3">
                        <a href="{{ route('admin.categories.index') }}">
                           <button type="button" class="btn w-sm btn-light waves-effect">Cancel</button>
                        </a>
                        <button class="ladda-button btn btn-primary" dir="ltr" data-style="expand-right">
                           Save
                        </button>
                     </div>
                  </div>
               </div>

            </div> <!-- end card-box -->
         </form>
      </div> <!-- end col -->
   </div>

   <!-- end row -->


</div> <!-- container -->
@endsection

@section('script')
<!-- Plugins js-->
<script src="{{asset('assets/libs/parsleyjs/parsleyjs.min.js')}}"></script>
<script src="{{asset('assets/libs/select2/select2.min.js')}}"></script>

<script>
   $(document).ready(function() {
            $('.select2').select2();
            $('.parsley-examples').parsley();
        })
</script>
@endsection
