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
                  <li class="breadcrumb-item active">Edit Main Category</li>
               </ol>
            </div>
            <h4 class="page-title">Edit Main Category</h4>
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
                        <label for="category_group">Category <span class="text-danger">*</span></label>
                        <select class="form-control select2" name="category_group_id" id="category_group" required>
                           <option value="">--Select Category Group--</option>

                           @foreach ($category_groups as $category_group)
                           <option
                              value="{{ $category_group->id }}"
                              @selected($category->category_group_id == $category_group->id)
                           >
                              {{ $category_group->name }}
                           </option>
                           @endforeach
                        </select>
                     </div>
                     <div class="form-group mb-3">
                        <label for="title">Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="title" class="form-control" value="{{ $category->name }}" placeholder="e.g : Apple iMac" autofocus
                           required>
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