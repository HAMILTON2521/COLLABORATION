<li class="breadcrumb-item d-flex align-items-center">
    <a class="text-muted text-decoration-none d-flex"
        href="{{ Auth::user()->user_type === 'Admin' ? route('dashboard') : route('portal') }}">
        <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
    </a>
</li>
