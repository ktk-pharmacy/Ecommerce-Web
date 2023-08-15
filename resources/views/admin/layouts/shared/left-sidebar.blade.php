<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu">

    <div class="h-100" data-simplebar>

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul id="side-menu">

                <li class="menu-title">Shop</li>

                <li>
                    <a href="{{ route('admin.dashboard') }}">
                        <i data-feather="airplay"></i>
                        <span> Dashboards </span>
                    </a>
                </li>

                <li>
                    <a href="#EcommerceMenu" data-toggle="collapse">
                        <i data-feather="shopping-cart"></i>
                        <span> Ecommerce </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="EcommerceMenu">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('admin.brands.index') }}">
                                    Brands
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('admin.category-groups.index') }}">Category Groups</a>
                            </li>

                            <li>
                                <a href="{{ route('admin.categories.index') }}">Categories</a>
                            </li>

                            <li>
                                <a href="{{ route('admin.products.index') }}">Products</a>
                            </li>

                            <li>
                                <a href="{{ route('admin.orders.index') }}">Orders</a>
                            </li>

                            <li>
                                <a href="{{ route('admin.customers.index') }}">Customers</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.coupons.index') }}">Coupons</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#ExtraMenu" data-toggle="collapse">
                        <i data-feather="layers"></i>
                        <span> Others </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="ExtraMenu">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('admin.products.import-form') }}">
                                    Excel Import
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.logistics.index') }}">
                                    Logistics
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="menu-title mt-2">INFO</li>
                @canany(['blog-list', 'blog-category-list'])
                <li>
                    <a href="#sidebarBlogManagement" data-toggle="collapse">
                        <i data-feather="book"></i>
                        <span> Blogs </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarBlogManagement">
                        <ul class="nav-second-level">
                            @can('blog-list')
                            <li>
                                <a href="{{ route('admin.blogs.index') }}">All Blogs</a>
                            </li>
                            @endcan
                            @can('blog-category-list')
                            <li>
                                <a href="{{ route('admin.blog-categories.index') }}">Blog Categories</a>
                            </li>
                            @endcan
                        </ul>
                    </div>
                </li>
                @endcan

                <li>
                    <a href="#sidebarAdsManagement" data-toggle="collapse">
                        <i data-feather="layers"></i>
                        <span> Advertisements </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarAdsManagement">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('admin.ads.index', 'slider') }}">Sliders</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.ads.index', 'slider_sidebar') }}">Slider Sidebar</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.ads.index', 'left_sidebar') }}">
                                    First Slider
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.ads.index', 'second_slider') }}">
                                    Second Slider
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.ads.index', 'banner_1') }}">Banner 1</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.ads.index', 'banner_2') }}">Banner 2</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#mobileAdsManagement" data-toggle="collapse">
                        <i data-feather="layers"></i>
                        <span> Mobile Ads </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="mobileAdsManagement">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('admin.mobile-ads.index', 'slider') }}">Sliders</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.mobile-ads.index', 'video') }}">Videos</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="{{ route('admin.settings.index') }}">
                        <i data-feather="settings"></i>
                        <span> Settings </span>
                    </a>
                </li>
                <li class="menu-title mt-2">Report</li>
                <li>
                    <a href="#reportManagement" data-toggle="collapse">
                        <i data-feather="activity"></i>
                        <span>Sales</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="reportManagement">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('admin.report.monthlysalereport') }}">Top Customer Sales Report</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.report.topcategorysalereport') }}">Top Categories Sales Report</a>
                            </li>
                        </ul>
                    </div>
                </li>

                @canany(['user-list', 'role-list', 'permission-list', 'location-list'])
                <li class="menu-title mt-2">Admin</li>

                @can('location-list')
                <li>
                    <a href="{{ route('admin.locations.index') }}">
                        <i data-feather="map-pin"></i>
                        <span> State and Region </span>
                    </a>
                </li>
                @endcan

                <li>
                    <a href="#sidebarUserManagement" data-toggle="collapse">
                        <i data-feather="users"></i>
                        <span> User Management </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarUserManagement">
                        <ul class="nav-second-level">
                            @can('user-list')
                            <li>
                                <a href="{{ route('admin.users.index') }}">Users</a>
                            </li>
                            @endcan
                            @can('role-list')
                            <li>
                                <a href="{{ route('admin.roles.index') }}">Roles</a>
                            </li>
                            @endcan
                            @can('permission-list')
                            <li>
                                <a href="{{ route('admin.permissions.index') }}">Permissions</a>
                            </li>
                            @endcan
                        </ul>
                    </div>
                </li>
                @endcanany

            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->
