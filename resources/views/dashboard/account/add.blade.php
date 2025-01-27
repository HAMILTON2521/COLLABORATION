@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/libs/quill/dist/quill.snow.css') }}">
<link rel="stylesheet" href="{{ asset('assets/libs/dropzone/dist/min/dropzone.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/libs/select2/dist/css/select2.min.css') }}">
@endsection

@section('title')
Create Account
@endsection

@section('main')
<div class="card card-body py-3">
    <div class="row align-items-center">
        <div class="col-12">
            <div class="d-sm-flex align-items-center justify-space-between">
                <h4 class="mb-4 mb-sm-0 card-title">Create Account</h4>
                <nav aria-label="breadcrumb" class="ms-auto">
                    <ol class="breadcrumb">
                        <x-dashboard-link />
                        <li class="breadcrumb-item" aria-current="page">
                            <span class="badge fw-medium fs-2 bg-primary-subtle text-primary">
                                Create Account
                            </span>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- start Basic Area Chart -->
@livewire('account.create-account')
@endsection

@section('js')
<script src="{{ asset('assets/libs/quill/dist/quill.min.js') }}"></script>
<script src="{{ asset('assets/js/forms/quill-init.js') }}"></script>
<script src="{{ asset('assets/libs/dropzone/dist/min/dropzone.min.js') }}"></script>
<script src="{{ asset('assets/libs/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/libs/select2/dist/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/js/forms/select2.init.js') }}"></script>
<script src="{{ asset('assets/libs/jquery.repeater/jquery.repeater.min.js') }}"></script>
<script src="{{ asset('assets/libs/jquery-validation/dist/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/js/forms/repeater-init.js') }}"></script>
@endsection