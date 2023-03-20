@extends('admin.layouts.master', ['title' => 'Add Blog'])

@section('css')
    <!-- Plugins css -->
    <link href="{{asset('assets/libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/summernote/summernote.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/dropify/dropify.min.css')}}" rel="stylesheet" type="text/css" />
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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Blog Management</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Blogs</a></li>
                            <li class="breadcrumb-item active">Add Blog</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Add Blog</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">

            <div class="col-lg-12">
                <form class="parsley-examples" action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                    <div class="card-box">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="title">Title <span class="text-danger">*</span></label>
                                    <input type="text" name="name" id="title" class="form-control" placeholder="Name" autofocus required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="blog-category">Category <span class="text-danger">*</span></label>
                                    <select class="form-control select2" name="terms[]" id="blog-category" multiple required>
                                        <option value="" disabled>--Select Category--</option>
                                        @foreach ($terms as $term)
                                            <option value="{{ $term->id }}">{{ $term->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group mb-3">
                                    <label for="description">Description <span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="description" id="description" rows="5" placeholder="Please enter description" required></textarea>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="feature_image">Feature image <span class="text-danger">*</span></label>
                                    <input
                                        type="file"
                                        name="feature_image"
                                        id="feature_image"
                                        data-height="225"
                                        data-max-file-size="500K"
                                        data-allowed-file-extensions='["png", "PNG", "jpg", "JPG", "jpeg", "JPEG"]'
                                        required
                                    >
                                    <p class="sub-header">Select file &lt; 500 KB ( Your feature image's size must be 450 X 277. )</p>
                                </div>
                                <div class="checkbox checkbox-success checkbox-circle mb-2">
                                    <input id="blog-status" type="checkbox" name="status" checked="" value="1">
                                    <label for="blog-status">
                                        Active
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="text-center mb-3">
                                    <a href="{{ route('admin.blogs.index') }}">
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
    <script src="{{asset('assets/libs/summernote/summernote.min.js')}}"></script>
    <script src="{{asset('assets/libs/dropify/dropify.min.js')}}"></script>

    <script>
        $(document).ready(function() {

            $('#description').summernote({
                height: 300,
                // set editor height
                minHeight: null,
                // set minimum height of editor
                maxHeight: null,
                // set maximum height of editor
                focus: false // set focus to editable area after initializing summernote
            });
            $('.select2').select2();
            $('#feature_image').dropify();
            $('.parsley-examples').parsley();
        })
    </script>
@endsection

