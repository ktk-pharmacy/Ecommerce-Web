@extends('admin.layouts.master', ['title' => 'Edit Category'])

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
                  <li class="breadcrumb-item"><a href="javascript: void(0);">Category Management</a></li>
                  <li class="breadcrumb-item active">Edit Sub Category</li>
               </ol>
            </div>
            <h4 class="page-title">Edit Sub Category</h4>
         </div>
      </div>
   </div>
   <!-- end page title -->

   <div class="row">

      <div class="col-lg-6">
         <form class="parsley-examples" action="{{ route('admin.categories.update', $category->id) }}" method="POST">
            @method('patch')
            @csrf
            <div class="card-box">
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group mb-3">
                        <label for="main_category">Category <span class="text-danger">*</span></label>
                        <select class="form-control select2" name="parent_id" id="main_category" required>
                           <option value="">--Select Main Category--</option>

                           @foreach ($main_categories as $main_category)
                           <option
                              value="{{ $main_category->id }}"
                              @selected($category->parent_id == $main_category->id)
                           >
                              {{ $main_category->name }}
                              ({{ $main_category->group->name }})
                           </option>
                           @endforeach
                        </select>
                     </div>
                     <div class="form-group mb-3">
                        <label for="title">Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="title" class="form-control" value="{{ $category->name }}"
                           placeholder="e.g : Apple iMac" autofocus required>
                     </div>
                     <div class="checkbox checkbox-success checkbox-circle mb-3">
                        <input id="brand_status" type="checkbox" name="status" @checked($category->status) value="1">
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