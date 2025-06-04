<ul class="list-unstyled mb-0 d-flex align-items-center">
    @if ($viewUrl)
        <li class="position-relative" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="View">
            <a class="text-dark px-2 fs-5 bg-hover-primary nav-icon-hover position-relative z-index-5"
                href="{{ $viewUrl }}">
                <i class="ti ti-info-circle"></i>
            </a>
        </li>
    @endif

    @if ($editUrl)
        <li class="position-relative" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit">
            <a class="d-block text-dark px-2 fs-5 bg-hover-primary nav-icon-hover position-relative z-index-5"
                href="{{ $editUrl }}">
                <i class="ti ti-pencil"></i>
            </a>
        </li>
    @endif

    @if ($removeUrl)
        <li class="position-relative" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Remove">
            <a class="d-block text-dark px-2 fs-5 bg-hover-primary nav-icon-hover position-relative z-index-5"
                href="{{ $removeUrl }}">
                <i class="ti ti-user-minus"></i>
            </a>
        </li>
    @endif

    @if ($deleteItem)
        <li class="position-relative" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete">
            <button type="button" wire:confirm="{{ $confirmationMessage }}" wire:click=delete('{{ $deleteItem }}')
                class="text-dark px-2 fs-5 bg-hover-primary nav-icon-hover position-relative z-index-5 btn btn-sm border-0">
                <i class="ti ti-trash"></i>
            </button>
        </li>
    @endif

</ul>
