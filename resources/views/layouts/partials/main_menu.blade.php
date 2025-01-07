<aside class="left-sidebar with-horizontal">
    <!-- Sidebar scroll-->
    <div>
        <!-- Sidebar navigation-->
        <nav id="sidebarnavh" class="sidebar-nav scroll-sidebar container-fluid">
            <ul id="sidebarnav">
                <!-- ============================= -->
                <!-- Home -->
                <!-- ============================= -->
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Home</span>
                </li>
                <!-- =================== -->
                <!-- Dashboard -->
                <!-- =================== -->
                <li class="sidebar-item {{ Route::is('dashboard*')?'selected':'' }} ">
                    <a class="sidebar-link" href="{{ route('dashboard.home') }}" aria-expanded="false">
                        <span>
                            <iconify-icon icon="solar:layers-line-duotone" class="ti"></iconify-icon>
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <!-- ============================= -->
                <!-- Customers -->
                <!-- ============================= -->
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Customers</span>
                </li>
                <li class="sidebar-item {{ Route::is('dashboard.customers*') }}">
                    <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                        <span>
                            <iconify-icon icon="solar:widget-line-duotone" class="ti"></iconify-icon>
                        </span>
                        <span class="hide-menu">Customers</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item {{ Route::is('dashboard.customers.create')?'selected':'' }}">
                            <a class="sidebar-link {{ Route::is('dashboard.customers.create')?'active':'' }}" href="{{ route('dashboard.customers.create') }}">
                                <i class="ti ti-file-plus"></i>
                                <span class="hide-menu">Add Customer</span>
                            </a>
                        </li>
                        <li class="sidebar-item {{ Route::is('dashboard.customers.list')?'selected':'' }}">
                            <a href="{{ route('dashboard.customers') }}" class="sidebar-link {{ Route::is('dashboard.customers')?'active':'' }}">
                                <i class="ti ti-list-check"></i>
                                <span class="hide-menu">List Customers</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- ============================= -->
                <!-- FILES -->
                <!-- ============================= -->
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">FILE</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow {{ Route::is('dashboard.file*')?'selected':'' }}" href="javascript:void(0)" aria-expanded="false">
                        <span>
                            <iconify-icon icon="solar:notes-line-duotone" class="ti"></iconify-icon>
                        </span>
                        <span class="hide-menu">File</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a href="javascript:void(0)" class="sidebar-link">
                                <i class="ti ti-plus"></i>
                                <span class="hide-menu">Add Meter Archive File</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="javascript:void(0)" class="sidebar-link">
                                <i class="ti ti-file-pencil"></i>
                                <span class="hide-menu">Edit Meter File</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="javascript:void(0)" class="sidebar-link">
                                <i class="ti ti-file-text"></i>
                                <span class="hide-menu">Get Archive List</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="javascript:void(0)" class="sidebar-link">
                                <i class="ti ti-file-info"></i>
                                <span class="hide-menu">Get Meter File Details</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- ============================= -->
                <!-- RECHARGE -->
                <!-- ============================= -->
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">RECHARGE</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow {{ Route::is('dashboard.recharge*')?'selected':'' }}" href="javascript:void(0)" aria-expanded="false">
                        <span>
                            <iconify-icon icon="solar:widget-add-line-duotone" class="ti"></iconify-icon>
                        </span>
                        <span class="hide-menu">Topup</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a href="javascript:void(0)" class="sidebar-link">
                                <i class="ti ti-coins"></i>
                                <span class="hide-menu">Remote Topup</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="javascript:void(0)" class="sidebar-link">
                                <i class="ti ti-cloud-dollar"></i>
                                <span class="hide-menu">Get Recharge Order Details</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- ============================= -->
                <!-- Account Management -->
                <!-- ============================= -->
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Account</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow {{ Route::is('dashboard.accounts*')?'selected':'' }}" href="javascript:void(0)" aria-expanded="false">
                        <span>
                            <iconify-icon icon="solar:user-id-line-duotone" class="ti"></iconify-icon>
                        </span>
                        <span class="hide-menu">Accounts</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a href="javascript:void(0)" class="sidebar-link">
                                <i class="ti ti-user-plus"></i>
                                <span class="hide-menu">Create Account</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="javascript:void(0)" class="sidebar-link">
                                <i class="ti ti-users"></i>
                                <span class="hide-menu">Get Account List</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow {{ Route::is('dashboard.settlement*')?'selected':'' }}" href="javascript:void(0)" aria-expanded="false">
                        <span>
                            <i class="ti ti-mobiledata"></i>
                        </span>
                        <span class="hide-menu">Settlement</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a href="javascript:void(0)" class="sidebar-link">
                                <i class="ti ti-calendar"></i>
                                <span class="hide-menu">Daily Records</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="javascript:void(0)" class="sidebar-link">
                                <i class="ti ti-calendar-event"></i>
                                <span class="hide-menu">Monthly Records</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow {{ Route::is('dashboard.extra*')?'selected':'' }}" href="javascript:void(0)" aria-expanded="false">
                        <span>
                            <i class="ti ti-baseline-density-medium"></i>
                        </span>
                        <span class="hide-menu">More</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a href="javascript:void(0)" class="sidebar-link">
                                <iconify-icon icon="solar:database-line-duotone" class="ti"></iconify-icon>
                                <span class="hide-menu">Data Query</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="javascript:void(0)" class="sidebar-link">
                                <iconify-icon icon="solar:remote-controller-line-duotone" class="ti"></iconify-icon>
                                <span class="hide-menu">Equipment</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ Route::is('dashboard.settings*')?'selected':'' }}" href="javascript:void(0)" aria-expanded="false">
                        <span class="rounded-3">
                            <iconify-icon icon="solar:settings-line-duotone" class="ti"></iconify-icon>
                        </span>
                        <span class="hide-menu">Settings</span>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>