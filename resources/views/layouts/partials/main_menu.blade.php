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
                <li class="sidebar-item {{ Route::is('dashboard') || Route::is('portal') ? 'selected' : '' }} ">
                    @if (Auth::user()->user_type === 'Admin')
                        <a class="sidebar-link" href="{{ route('dashboard') }}" aria-expanded="false">
                            <span>
                                <iconify-icon icon="solar:layers-line-duotone" class="ti"></iconify-icon>
                            </span>
                            <span class="hide-menu">Dashboard</span>
                        </a>
                    @else
                        <a class="sidebar-link" href="{{ route('portal') }}" aria-expanded="false">
                            <span>
                                <iconify-icon icon="solar:layers-line-duotone" class="ti"></iconify-icon>
                            </span>
                            <span class="hide-menu">Home</span>
                        </a>
                    @endif
                </li>
                @if (Auth::user()->user_type == 'User')
                    <li
                        class="sidebar-item {{ Route::is('portal.payments*') || Route::is('topup.payment.details') ? 'selected' : '' }}">
                        <a class="sidebar-link" href="{{ route('portal.payments') }}" aria-expanded="false">
                            <span class="rounded-3">
                                <iconify-icon icon="solar:wallet-money-line-duotone" class="ti"></iconify-icon>
                            </span>
                            <span class="hide-menu">Payments</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ Route::is('portal.account*') ? 'selected' : '' }}">
                        <a class="sidebar-link" href="{{ route('portal.account') }}" aria-expanded="false">
                            <span class="rounded-3">
                                <iconify-icon icon="solar:shield-user-line-duotone" class="ti"></iconify-icon>
                            </span>
                            <span class="hide-menu">My Account</span>
                        </a>
                    </li>
                @endif
                @if (Auth::user()->user_type == 'Admin')
                    <!-- ============================= -->
                    <!-- Customers -->
                    <!-- ============================= -->
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">Customers</span>
                    </li>
                    <li class="sidebar-item {{ Route::is('customers*') ? 'selected' : '' }}">
                        <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                            <span>
                                <iconify-icon icon="solar:widget-line-duotone" class="ti"></iconify-icon>
                            </span>
                            <span class="hide-menu">Customers</span>
                        </a>
                        <ul aria-expanded="false" class="collapse first-level">
                            <li class="sidebar-item {{ Route::is('customers.create') ? 'selected' : '' }}">
                                <a class="sidebar-link {{ Route::is('customers.create') ? 'active' : '' }}"
                                    href="{{ route('customers.create') }}">
                                    <i class="ti ti-file-plus"></i>
                                    <span class="hide-menu">Add Customer</span>
                                </a>
                            </li>
                            <li class="sidebar-item {{ Route::is('customers.list') ? 'selected' : '' }}">
                                <a href="{{ route('customers') }}"
                                    class="sidebar-link {{ Route::is('customers') ? 'active' : '' }}">
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
                    <li class="sidebar-item {{ Route::is('files*') ? 'selected' : '' }}">
                        <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                            <span>
                                <iconify-icon icon="solar:notes-line-duotone" class="ti"></iconify-icon>
                            </span>
                            <span class="hide-menu">File</span>
                        </a>
                        <ul aria-expanded="false" class="collapse first-level">
                            <li class="sidebar-item">
                                <a href="{{ route('files.add.meter.file') }}"
                                    class="sidebar-link {{ Route::is('files.add.meter.file') ? 'active' : '' }}">
                                    <i class="ti ti-plus"></i>
                                    <span class="hide-menu">Add Meter Archive File</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{ route('files.archive.list') }}"
                                    class="sidebar-link {{ Route::is('files.archive.list') ? 'active' : '' }}">
                                    <i class="ti ti-file-text"></i>
                                    <span class="hide-menu">Get Archive List</span>
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
                    <li class="sidebar-item {{ Route::is('topup*') ? 'selected' : '' }}">
                        <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                            <span>
                                <iconify-icon icon="solar:widget-add-line-duotone" class="ti"></iconify-icon>
                            </span>
                            <span class="hide-menu">Topup</span>
                        </a>
                        <ul aria-expanded="false" class="collapse first-level">
                            <li class="sidebar-item">
                                <a href="{{ route('topup.remote.topup') }}"
                                    class="sidebar-link {{ Route::is('topup.remote.topup') || Route::is('topup.payment.recharge') ? 'active' : '' }}">
                                    <i class="ti ti-coins"></i>
                                    <span class="hide-menu">Remote Topup</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{ route('topup.order.details') }}"
                                    class="sidebar-link {{ Route::is('topup.order.details') ? 'active' : '' }}">
                                    <i class="ti ti-cloud-dollar"></i>
                                    <span class="hide-menu">Get Recharge Order Details</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{ route('topup.airtel.payments') }}"
                                    class="sidebar-link {{ Route::is('topup.airtel.payments') ? 'active' : '' }}">
                                    <i class="ti ti-cloud-dollar"></i>
                                    <span class="hide-menu">Payments</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- ============================= -->
                    <!-- Account Management -->
                    <!-- ============================= -->
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">Households</span>
                    </li>
                    <li class="sidebar-item {{ Route::is('households*') ? 'selected' : '' }}">
                        <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                            <span>
                                <iconify-icon icon="solar:user-id-line-duotone" class="ti"></iconify-icon>
                            </span>
                            <span class="hide-menu">Households</span>
                        </a>
                        <ul aria-expanded="false" class="collapse first-level">
                            <li class="sidebar-item {{ Route::is('households.create') ? 'selected' : '' }}">
                                <a href="{{ route('households.create') }}"
                                    class="sidebar-link {{ Route::is('households.create') ? 'active' : '' }}">
                                    <i class="ti ti-user-plus"></i>
                                    <span class="hide-menu">Add Household</span>
                                </a>
                            </li>
                            <li class="sidebar-item {{ Route::is('households') ? 'selected' : '' }}">
                                <a href="{{ route('households') }}"
                                    class="sidebar-link {{ Route::is('households') ? 'active' : '' }}">
                                    <i class="ti ti-users"></i>
                                    <span class="hide-menu">Households</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-item d-none {{ Route::is('settlement*') ? 'selected' : '' }}">
                        <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                            <span>
                                <i class="ti ti-mobiledata"></i>
                            </span>
                            <span class="hide-menu">Settlement</span>
                        </a>
                        <ul aria-expanded="false" class="collapse first-level">
                            <li class="sidebar-item">
                                <a href="{{ route('settlement.daily') }}"
                                    class="sidebar-link {{ Route::is('settlement.daily') ? 'active' : '' }}">
                                    <i class="ti ti-calendar"></i>
                                    <span class="hide-menu">Daily Records</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{ route('settlement.monthly') }}"
                                    class="sidebar-link {{ Route::is('settlement.monthly') ? 'active' : '' }}">
                                    <i class="ti ti-calendar-event"></i>
                                    <span class="hide-menu">Monthly Records</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-item {{ Route::is('more*') ? 'selected' : '' }}">
                        <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                            <span>
                                <i class="ti ti-baseline-density-medium"></i>
                            </span>
                            <span class="hide-menu">More</span>
                        </a>
                        <ul aria-expanded="false" class="collapse first-level">
                            <li class="sidebar-item">
                                <a href="{{ route('more.data.query') }}"
                                    class="sidebar-link {{ Route::is('more.data.query') ? 'active' : '' }}">
                                    <i class="ti ti-database"></i>
                                    <span class="hide-menu">Data Query</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{ route('more.equipment') }}"
                                    class="sidebar-link {{ Route::is('more.equipment') ? 'active' : '' }}">
                                    <i class="ti ti-device-desktop"></i>
                                    <span class="hide-menu">Equipment</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{ route('more.users') }}"
                                    class="sidebar-link {{ Route::is('more.users*') ? 'active' : '' }}">
                                    <i class="ti ti-users"></i>
                                    <span class="hide-menu">Users</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-item {{ Route::is('settings*') ? 'selected' : '' }}">
                        <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                            <span class="rounded-3">
                                <iconify-icon icon="solar:settings-line-duotone" class="ti"></iconify-icon>
                            </span>
                            <span class="hide-menu">Settings</span>
                        </a>
                        <ul aria-expanded="false" class="collapse first-level">
                            <li class="sidebar-item">
                                <a href="{{ route('settings.sms') }}"
                                    class="sidebar-link {{ Route::is('settings.sms') ? 'active' : '' }}">
                                    <i class="ti ti-message-cog"></i>
                                    <span class="hide-menu">SMS Settings</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{ route('settings.general') }}"
                                    class="sidebar-link {{ Route::is('settings.general') ? 'active' : '' }}">
                                    <i class="ti ti-settings-cog"></i>
                                    <span class="hide-menu">General Settings</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
