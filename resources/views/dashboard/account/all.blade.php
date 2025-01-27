@extends('layouts.app')

@section('title')
Accounts
@endsection

@section('main')
<div class="card card-body py-3">
    <div class="row align-items-center">
        <div class="col-12">
            <div class="d-sm-flex align-items-center justify-space-between">
                <h4 class="mb-4 mb-sm-0 card-title">Accounts</h4>
                <nav aria-label="breadcrumb" class="ms-auto">
                    <ol class="breadcrumb">
                        <x-dashboard-link />
                        <li class="breadcrumb-item" aria-current="page">
                            <span class="badge fw-medium fs-2 bg-primary-subtle text-primary">
                                Accounts
                            </span>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

@livewire('account.accounts')
@endsection

@section('js')
<script src="{{ asset('assets/libs/fullcalendar/index.global.min.js') }}"></script>
<script src="{{ asset('assets/js/apps/contact.js') }}"></script>
@endsection