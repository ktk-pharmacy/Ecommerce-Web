@extends('admin.layouts.master', ['title' => 'Settings'])

@section('css')
    <!-- Plugins css -->
    <link href="{{ asset('assets/libs/jquery-toast-plugin/jquery-toast-plugin.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/dropify/dropify.min.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .form-control:disabled {
            cursor: not-allowed;
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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Info</a></li>
                            <li class="breadcrumb-item active">Settings</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Settings</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form class="parsley-validation" action="{{ route('admin.settings.update') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-sm-2">
                                    <div class="nav flex-column nav-pills nav-pills-tab" id="v-pills-tab" role="tablist"
                                        aria-orientation="vertical">
                                        <a class="nav-link show mb-1 active" id="general-tab" data-toggle="pill"
                                            href="#setting-general" role="tab" aria-controls="setting-general"
                                            aria-selected="true">
                                            General</a>
                                        <a class="nav-link mb-1" id="setting-contact" data-toggle="pill"
                                            href="#setting-contact-tab" role="tab" aria-controls="setting-contact-tab"
                                            aria-selected="false">
                                            Contact Info</a>
                                        <a class="nav-link mb-1" id="setting-social" data-toggle="pill"
                                            href="#setting-social-tab" role="tab" aria-controls="setting-social-tab"
                                            aria-selected="false">
                                            Social Links</a>
                                        <a class="nav-link mb-1" id="bonous" data-toggle="pill"
                                            href="#bonous-tab" role="tab" aria-controls="bonous-tab"
                                            aria-selected="false">
                                            Bonous</a>
                                        <a class="nav-link mb-1 {{ config('settings.frontend_campaing') == null || config('settings.frontend_banner') == null ? 'd-none' : '' }}"
                                            id="setting-theme" data-toggle="pill" href="#setting-theme-tab" role="tab"
                                            aria-controls="setting-theme-tab" aria-selected="false">
                                            Frontend Themes</a>
                                    </div>
                                </div> <!-- end col-->
                                <div class="col-sm-10">
                                    <div class="tab-content pt-0">
                                        <div class="tab-pane fade active show" id="setting-general" role="tabpanel"
                                            aria-labelledby="general-tab">
                                            <div class="form-group row mb-3">
                                                <div class="col-md-6 col-sm-6">
                                                    <label for="site_name" class="form-label">Site Name</label>
                                                    <input type="text" name="site_name"
                                                        value="{{ config('settings.site_name') }}" id="site_name"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group row mb-3">
                                                <div class="col-md-6 col-sm-6">
                                                    <label for="site_title" class="form-label">Site Title</label>
                                                    <input type="text" name="site_title"
                                                        value="{{ config('settings.site_title') }}" id="site_title"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group row mb-3">
                                                <div class="col-md-6 col-sm-6">
                                                    <label for="header_text" class="form-label">Header Text</label>
                                                    <textarea type="text" name="header_text" id="header_text" class="form-control" rows="6">{{ config('settings.header_text') }}</textarea>
                                                </div>
                                            </div>
                                        </div><!-- end General-->

                                        <div class="tab-pane fade" id="setting-contact-tab" role="tabpanel"
                                            aria-labelledby="setting-contact">
                                            <div class="form-group row mb-3">
                                                <div class="col-md-6 col-sm-6">
                                                    <label for="default_email" class="form-label">Email</label>
                                                    <input type="text" name="default_email"
                                                        value="{{ config('settings.default_email') }}" id="default_email"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group row mb-3">
                                                <div class="col-md-6 col-sm-6">
                                                    <label for="default_phone_number" class="form-label">Phone
                                                        Number</label>
                                                    <input type="text" name="default_phone_number"
                                                        value="{{ config('settings.default_phone_number') }}"
                                                        id="default_phone_number" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group row mb-3">
                                                <div class="col-md-6 col-sm-6">
                                                    <label for="default_address" class="form-label">Address</label>
                                                    <textarea type="text" name="default_address" id="default_address" class="form-control" rows="6">{{ config('settings.default_address') }}</textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-3">
                                                <div class="col-md-6 col-sm-6">
                                                    <label for="default_location" class="form-label">Location
                                                        Map(iframe)</label>
                                                    <textarea type="text" name="default_location" id="default_location" class="form-control" rows="6">{{ config('settings.default_location') }}</textarea>
                                                </div>
                                            </div>
                                        </div><!-- end Contact-->

                                        <div class="tab-pane fade" id="setting-social-tab" role="tabpanel"
                                            aria-labelledby="setting-social">
                                            <div class="form-group row mb-3">
                                                <div class="col-md-6 col-sm-6">
                                                    <label for="social_facebook" class="form-label">Facebook</label>
                                                    <input type="text" name="social_facebook"
                                                        value="{{ config('settings.social_facebook') }}"
                                                        id="social_facebook" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group row mb-3">
                                                <div class="col-md-6 col-sm-6">
                                                    <label for="social_twitter" class="form-label">Twitter</label>
                                                    <input type="text" name="social_twitter"
                                                        value="{{ config('settings.social_twitter') }}"
                                                        id="social_twitter" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group row mb-3">
                                                <div class="col-md-6 col-sm-6">
                                                    <label for="social_instagram" class="form-label">Instagram</label>
                                                    <input type="text" name="social_instagram"
                                                        value="{{ config('settings.social_instagram') }}"
                                                        id="social_instagram" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group row mb-3">
                                                <div class="col-md-6 col-sm-6">
                                                    <label for="social_linkedin" class="form-label">LinkedIn</label>
                                                    <input type="text" name="social_linkedin"
                                                        value="{{ config('settings.social_linkedin') }}"
                                                        id="social_linkedin" class="form-control">
                                                </div>
                                            </div>
                                        </div><!-- end Social-->

                                        <div class="tab-pane fade" id="setting-theme-tab" role="tabpanel"
                                            aria-labelledby="setting-theme">
                                            <div class="form-group row mb-3">
                                                <div class="col-md-6 col-sm-6">
                                                    <label for="frontend_banner" class="form-label">Frontend
                                                        Banner</label>
                                                    <input type="file" name="frontend_banner" id="frontend_banner"
                                                        data-default-file="{{ asset(config('settings.frontend_banner') ?? 'assets/theme/img/bg/bgNew.png') }}"
                                                        data-allowed-file-extensions='["png", "PNG", "jpg", "JPG", "jpeg", "JPEG"]'>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-3">
                                                <div class="col-md-6 col-sm-6">
                                                    <label for="frontend_campaing" class="form-label">Frontend
                                                        Campaing</label>
                                                    <input type="file" name="frontend_campaing" id="frontend_campaing"
                                                        data-default-file="{{ asset(config('settings.frontend_campaing') ?? 'assets/theme/img/bg/campaing.jpg') }}"
                                                        data-allowed-file-extensions='["png", "PNG", "jpg", "JPG", "jpeg", "JPEG"]'>

                                                </div>
                                            </div>
                                        </div><!-- end Frontend Theme -->

                                        <div class="tab-pane fade" id="bonous-tab" role="tabpanel"
                                            aria-labelledby="setting-theme">

                                            <div class="form-group row mb-3">
                                                <div class="col-md-6 col-sm-6">
                                                    <label for="bonous_1_img" class="form-label">Bonous 1</label>
                                                    <input type="file" name="bonous_1_img" id="bonous_1_img"
                                                        data-default-file="{{ asset(config('settings.bonous_1_img'))??'assets/theme/img/sayaid2.png' }}"
                                                        data-allowed-file-extensions='["png", "PNG", "jpg", "JPG", "jpeg", "JPEG"]'>

                                                        <input type="text" name="bonous_1_title"
                                                        value="{{ config('settings.bonous_1_title')??'title 1' }}"
                                                        id="bonous_1_title" class="form-control mt-1">

                                                        <textarea type="text" name="bonous_1_txt" id="bonous_1_txt" class="form-control mt-1" rows="6">{{ config('settings.bonous_1_txt')??'text 1' }}</textarea>
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <label for="bonous_1_img" class="form-label">Bonous 2</label>
                                                    <input type="file" name="bonous_2_img" id="bonous_2_img"
                                                        data-default-file="{{ asset(config('settings.bonous_2_img'))??'assets/theme/img/sayaid2.png' }}"
                                                        data-allowed-file-extensions='["png", "PNG", "jpg", "JPG", "jpeg", "JPEG"]'>

                                                        <input type="text" name="bonous_2_title"
                                                        value="{{ config('settings.bonous_2_title')??'Title 2' }}"
                                                        id="bonous_2_title" class="form-control mt-1">

                                                        <textarea type="text" name="bonous_2_txt" id="bonous_2_txt" class="form-control mt-1" rows="6">{{ config('settings.bonous_2_txt')??'Text 2' }}</textarea>
                                                </div>
                                            </div>

                                            <div class="form-group row mb-3">
                                                <div class="col-md-6 col-sm-6">
                                                    <label for="bonous_1_img" class="form-label">Bonous 3</label>
                                                    <input type="file" name="bonous_3_img" id="bonous_3_img"
                                                        data-default-file="{{ asset(config('settings.bonous_3_img'))??'assets/theme/img/sayaid2.png' }}"
                                                        data-allowed-file-extensions='["png", "PNG", "jpg", "JPG", "jpeg", "JPEG"]'>

                                                        <input type="text" name="bonous_3_title"
                                                        value="{{ config('settings.bonous_3_title')??'title 3' }}"
                                                        id="bonous_3_title" class="form-control mt-1">

                                                        <textarea type="text" name="bonous_3_txt" id="bonous_3_txt" class="form-control mt-1" rows="6">{{ config('settings.bonous_3_txt')??'text 3' }}</textarea>
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <label for="bonous_1_img" class="form-label">Bonous 4</label>
                                                    <input type="file" name="bonous_4_img" id="bonous_4_img"
                                                        data-default-file="{{ asset(config('settings.bonous_4_img'))??'assets/theme/img/sayaid2.png' }}"
                                                        data-allowed-file-extensions='["png", "PNG", "jpg", "JPG", "jpeg", "JPEG"]'>

                                                        <input type="text" name="bonous_4_title"
                                                        value="{{ config('settings.bonous_4_title')??'Title 4' }}"
                                                        id="bonous_4_title" class="form-control mt-1">

                                                        <textarea type="text" name="bonous_4_txt" id="bonous_4_txt" class="form-control mt-1" rows="6">{{ config('settings.bonous_4_txt')??'Text 4' }}</textarea>
                                                </div>
                                            </div>

                                            <div class="form-group row mb-3">
                                                <div class="col-md-6 col-sm-6">
                                                    <label for="bonous_1_img" class="form-label">Bonous 5</label>
                                                    <input type="file" name="bonous_5_img" id="bonous_5_img"
                                                        data-default-file="{{ asset(config('settings.bonous_5_img'))??'assets/theme/img/sayaid2.png' }}"
                                                        data-allowed-file-extensions='["png", "PNG", "jpg", "JPG", "jpeg", "JPEG"]'>

                                                        <input type="text" name="bonous_5_title"
                                                        value="{{ config('settings.bonous_5_title')??'title 5' }}"
                                                        id="bonous_5_title" class="form-control mt-1">

                                                        <textarea type="text" name="bonous_5_txt" id="bonous_5_txt" class="form-control mt-1" rows="6">{{ config('settings.bonous_5_txt')??'text 5' }}</textarea>
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <label for="bonous_1_img" class="form-label">Bonous 6</label>
                                                    <input type="file" name="bonous_6_img" id="bonous_6_img"
                                                        data-default-file="{{ asset(config('settings.bonous_6_img'))??'assets/theme/img/sayaid2.png' }}"
                                                        data-allowed-file-extensions='["png", "PNG", "jpg", "JPG", "jpeg", "JPEG"]'>

                                                        <input type="text" name="bonous_6_title"
                                                        value="{{ config('settings.bonous_6_title')??'Title 6' }}"
                                                        id="bonous_6_title" class="form-control mt-1">

                                                        <textarea type="text" name="bonous_6_txt" id="bonous_6_txt" class="form-control mt-1" rows="6">{{ config('settings.bonous_6_txt')??'Text 6' }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end col-->
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="text-center mt-3 mb-3">
                                        <button type="submit" class="btn w-sm btn-success waves-effect waves-light">
                                            Update
                                        </button>
                                    </div>
                                </div> <!-- end col -->
                            </div>
                        </form>
                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>
        <!-- end row-->

    </div> <!-- container -->
@endsection

@section('script')
    <!-- Plugins js-->
    <script src="{{ asset('assets/libs/jquery-toast-plugin/jquery-toast-plugin.min.js') }}"></script>
    <script src="{{ asset('assets/libs/dropify/dropify.min.js') }}"></script>

    <!-- Page js-->
    <script src="{{ asset('assets/js/pages/toastr.init.js') }}"></script>

    <script>
        $(document).ready(function() {
            $toDropify = ['#frontend_banner', '#frontend_campaing', '#bonous_1_img','#bonous_3_img', '#bonous_2_img', '#bonous_4_img','#bonous_5_img','#bonous_6_img',];
            $toDropify.forEach(element => {
                $(element).dropify();
            });

        });
    </script>
@endsection
