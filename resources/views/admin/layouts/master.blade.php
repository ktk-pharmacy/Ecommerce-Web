<!DOCTYPE html>
    <html lang="en">

    <head>
        @include('admin.layouts.shared/title-meta', ['title' => $title])
        @include('admin.layouts.shared/head-css')
        {{-- @include('admin.layouts.shared/head-css', ["demo" => "modern"]) --}}
    </head>

    <body @yield('body-extra')>
        <!-- Begin page -->
        <div id="wrapper">
            @include('admin.layouts.shared/topbar')

            @include('admin.layouts.shared/left-sidebar')

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">                    
                    @yield('content')
                </div>
                <!-- content -->

                {{-- @include('admin.layouts.shared/footer') --}}

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->

        </div>
        <!-- END wrapper -->

        {{-- @include('admin.layouts.shared/right-sidebar') --}}

        @include('admin.layouts.shared.modals/general-modal')

        @include('admin.layouts.shared/footer-script')

        @include('admin.layouts.shared/toastr-message')
        
    </body>
</html>