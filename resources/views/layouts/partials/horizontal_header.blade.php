<div class="app-header with-horizontal">
    <nav class="navbar navbar-expand-xl container-fluid p-0">
        <ul class="navbar-nav align-items-center">
            <li class="nav-item d-flex d-xl-none">
                <a class="nav-link sidebartoggler nav-icon-hover-bg rounded-circle" id="sidebarCollapse"
                   href="javascript:void(0)">
                    <iconify-icon icon="solar:hamburger-menu-line-duotone" class="fs-7"></iconify-icon>
                </a>
            </li>
            <li class="nav-item d-none d-xl-flex align-items-center">
                <a href="{{ Auth::user()->user_type === 'Admin' ? route('dashboard') : route('portal') }}"
                   class="text-nowrap nav-link">
                    <img style="width: 70%" src="{{ asset('assets/images/logos/logo.png') }}" alt="matdash-img"/>
                </a>
            </li>
            <li class="nav-item d-none d-xl-flex align-items-center nav-icon-hover-bg rounded-circle">
                <a class="nav-link" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <iconify-icon icon="solar:magnifer-linear" class="fs-6"></iconify-icon>
                </a>
            </li>
        </ul>
        <div class="d-block d-xl-none">
            <a href="{{ route('dashboard') }}" class="text-nowrap nav-link">
                <img style="width: 70%" src="{{ asset('assets/images/logos/logo.png') }}" alt="matdash-img"/>
            </a>
        </div>
        <a class="navbar-toggler nav-icon-hover p-0 border-0 nav-icon-hover-bg rounded-circle" href="javascript:void(0)"
           data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
           aria-label="Toggle navigation">
            <span class="p-2">
                <i class="ti ti-dots fs-7"></i>
            </span>
        </a>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <div class="d-flex align-items-center justify-content-between px-0 px-xl-8">
                <ul class="navbar-nav flex-row mx-auto ms-lg-auto align-items-center justify-content-center">
                    <li class="nav-item dropdown">
                        <a href="javascript:void(0)"
                           class="nav-link nav-icon-hover-bg rounded-circle d-flex d-lg-none align-items-center justify-content-center"
                           type="button" data-bs-toggle="offcanvas" data-bs-target="#mobilenavbar"
                           aria-controls="offcanvasWithBothOptions">
                            <iconify-icon icon="solar:sort-line-duotone" class="fs-6"></iconify-icon>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-icon-hover-bg rounded-circle moon dark-layout" href="javascript:void(0)">
                            <iconify-icon icon="solar:moon-line-duotone" class="moon fs-6"></iconify-icon>
                        </a>
                        <a class="nav-link nav-icon-hover-bg rounded-circle sun light-layout" href="javascript:void(0)"
                           style="display: none">
                            <iconify-icon icon="solar:sun-2-line-duotone" class="sun fs-6"></iconify-icon>
                        </a>
                    </li>
                    <li class="nav-item d-block d-xl-none">
                        <a class="nav-link nav-icon-hover-bg rounded-circle" href="javascript:void(0)"
                           data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <iconify-icon icon="solar:magnifer-line-duotone" class="fs-6"></iconify-icon>
                        </a>
                    </li>

                    <!-- ------------------------------- -->
                    <!-- start notification Dropdown -->
                    <!-- ------------------------------- -->
                    <li class="nav-item dropdown nav-icon-hover-bg rounded-circle">
                        <a class="nav-link position-relative" href="javascript:void(0)" id="drop2"
                           aria-expanded="false">
                            <iconify-icon icon="solar:bell-bing-line-duotone" class="fs-6"></iconify-icon>
                        </a>
                        <div class="dropdown-menu content-dd dropdown-menu-end dropdown-menu-animate-up"
                             aria-labelledby="drop2">
                            <div class="d-flex align-items-center justify-content-between py-3 px-7">
                                <h5 class="mb-0 fs-5 fw-semibold">Notifications</h5>
                                <span class="badge text-bg-primary rounded-4 px-3 py-1 lh-sm">5 new</span>
                            </div>
                            <div class="message-body" data-simplebar>
                                <a href="javascript:void(0)"
                                   class="py-6 px-7 d-flex align-items-center dropdown-item gap-3">
                                    <span
                                        class="flex-shrink-0 bg-danger-subtle rounded-circle round d-flex align-items-center justify-content-center fs-6 text-danger">
                                        <iconify-icon icon="solar:widget-3-line-duotone"></iconify-icon>
                                    </span>
                                    <div class="w-75">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <h6 class="mb-1 fw-semibold">Launch Admin</h6>
                                            <span class="d-block fs-2">9:30 AM</span>
                                        </div>
                                        <span class="d-block text-truncate text-truncate fs-11">Just see the my new
                                            admin!</span>
                                    </div>
                                </a>
                                <a href="javascript:void(0)"
                                   class="py-6 px-7 d-flex align-items-center dropdown-item gap-3">
                                    <span
                                        class="flex-shrink-0 bg-primary-subtle rounded-circle round d-flex align-items-center justify-content-center fs-6 text-primary">
                                        <iconify-icon icon="solar:calendar-line-duotone"></iconify-icon>
                                    </span>
                                    <div class="w-75">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <h6 class="mb-1 fw-semibold">Event today</h6>
                                            <span class="d-block fs-2">9:15 AM</span>
                                        </div>
                                        <span class="d-block text-truncate text-truncate fs-11">Just a reminder that
                                            you have event</span>
                                    </div>
                                </a>
                                <a href="javascript:void(0)"
                                   class="py-6 px-7 d-flex align-items-center dropdown-item gap-3">
                                    <span
                                        class="flex-shrink-0 bg-secondary-subtle rounded-circle round d-flex align-items-center justify-content-center fs-6 text-secondary">
                                        <iconify-icon icon="solar:settings-line-duotone"></iconify-icon>
                                    </span>
                                    <div class="w-75">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <h6 class="mb-1 fw-semibold">Settings</h6>
                                            <span class="d-block fs-2">4:36 PM</span>
                                        </div>
                                        <span class="d-block text-truncate text-truncate fs-11">You can customize this
                                            template as you want</span>
                                    </div>
                                </a>
                            </div>
                            <div class="py-6 px-7 mb-1">
                                <button class="btn btn-primary w-100">See All Notifications</button>
                            </div>

                        </div>
                    </li>
                    <!-- ------------------------------- -->
                    <!-- end notification Dropdown -->
                    <!-- ------------------------------- -->

                    <!-- ------------------------------- -->
                    <!-- start language Dropdown -->
                    <!-- ------------------------------- -->
                    <li class="nav-item dropdown nav-icon-hover-bg rounded-circle">
                        <a class="nav-link" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                           aria-expanded="false">
                            <img src="{{ asset('assets/images/flag/icon-flag-en.svg') }}" alt="matdash-img"
                                 width="20px" height="20px" class="rounded-circle object-fit-cover round-20"/>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                            <div class="message-body">
                                <a href="javascript:void(0)"
                                   class="d-flex align-items-center gap-2 py-3 px-4 dropdown-item">
                                    <div class="position-relative">
                                        <img src="{{ asset('assets/images/flag/icon-flag-en.svg') }}"
                                             alt="matdash-img" width="20px" height="20px"
                                             class="rounded-circle object-fit-cover round-20"/>
                                    </div>
                                    <p class="mb-0 fs-3">English</p>
                                </a>
                                <a href="javascript:void(0)"
                                   class="d-flex align-items-center gap-2 py-3 px-4 dropdown-item">
                                    <div class="position-relative">
                                        <img src="{{ asset('./assets/images/flag/icon-flag-sw.svg') }}"
                                             alt="matdash-img" width="20px" height="20px"
                                             class="rounded-circle object-fit-cover round-20"/>
                                    </div>
                                    <p class="mb-0 fs-3">Swahili</p>
                                </a>
                            </div>
                        </div>
                    </li>
                    <!-- ------------------------------- -->
                    <!-- end language Dropdown -->
                    <!-- ------------------------------- -->

                    <!-- ------------------------------- -->
                    <!-- start profile Dropdown -->
                    <!-- ------------------------------- -->
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="javascript:void(0)" id="drop1" aria-expanded="false">
                            <div class="d-flex align-items-center gap-2 lh-base">
                                <img src="{{ Auth::user()->profile_photo }}" class="rounded-circle"
                                     width="35" height="35" alt="matdash-img"/>
                                <iconify-icon icon="solar:alt-arrow-down-bold" class="fs-2"></iconify-icon>
                            </div>
                        </a>
                        <div class="dropdown-menu profile-dropdown dropdown-menu-end dropdown-menu-animate-up"
                             aria-labelledby="drop1">
                            <div class="position-relative px-4 pt-3 pb-2">
                                <div class="d-flex align-items-center mb-3 pb-3 border-bottom gap-6">
                                    <img src="{{ asset('assets/images/profile/user-1.jpg') }}" class="rounded-circle"
                                         width="56" height="56" alt="matdash-img"/>
                                    <div>
                                        <h5 class="mb-0 fs-12">{{ Auth::user()->full_name }} <span
                                                class="text-success fs-11">{{ Auth::user()->user_type }}</span>
                                        </h5>
                                        <p class="mb-0 text-dark">
                                            {{ Auth::user()->email }}
                                        </p>
                                    </div>
                                </div>
                                <div class="message-body">
                                    <a href="{{ route('profile.my.profile') }}"
                                       class="p-2 dropdown-item h6 rounded-1">
                                        My Profile
                                    </a>
                                    <a href="{{ route('profile.my.invoices') }}"
                                       class="p-2 dropdown-item h6 rounded-1">
                                        My Invoice <span
                                            class="badge bg-danger-subtle text-danger rounded ms-8">4</span>
                                    </a>
                                    <a href="{{ route('profile.account.settings') }}"
                                       class="p-2 dropdown-item h6 rounded-1">
                                        Account Settings
                                    </a>
                                    <x-logout class="p-2 dropdown-item h6 rounded-1"> Sign Out</x-logout>
                                </div>
                            </div>
                        </div>
                    </li>
                    <!-- ------------------------------- -->
                    <!-- end profile Dropdown -->
                    <!-- ------------------------------- -->
                </ul>
            </div>
        </div>
    </nav>
</div>
