@extends('layouts.app')

@section('title')
Equipment
@endsection

@section('main')
<div class="card card-body py-3">
    <div class="row align-items-center">
        <div class="col-12">
            <div class="d-sm-flex align-items-center justify-space-between">
                <h4 class="mb-4 mb-sm-0 card-title">Equipment</h4>
                <nav aria-label="breadcrumb" class="ms-auto">
                    <ol class="breadcrumb">
                        <x-dashboard-link />
                        <li class="breadcrumb-item" aria-current="page">
                            <span class="badge fw-medium fs-2 bg-primary-subtle text-primary">
                                Equipment
                            </span>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body text-center">
                <img src="../assets/images/backgrounds/gold.png" alt="matdash-img" class="img-fluid mb-4" width="150">
                <h5 class="fw-semibold fs-5 mb-2">Valve Control</h5>
                <p class="mb-3 px-xl-5">Switch equipment valve remotely on or off.</p>
                <button type="button" class="btn btn-primary">Send Command</button>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body text-center">
                <img src="../assets/images/backgrounds/gold.png" alt="matdash-img" class="img-fluid mb-4" width="150">
                <h5 class="fw-semibold fs-5 mb-2">Status Command</h5>
                <p class="mb-3 px-xl-5">Send commands to the device to query traffic and status.</p>
                <button type="button" class="btn btn-primary">Send Command</button>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body text-center">
                <img src="../assets/images/backgrounds/gold.png" alt="matdash-img" class="img-fluid mb-4" width="150">
                <h5 class="fw-semibold fs-5 mb-2">Battery Command</h5>
                <p class="mb-3 px-xl-5">Send a command to the device to check the battery.</p>
                <button type="button" class="btn btn-primary">Send Command</button>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card bg-info-subtle overflow-hidden shadow-none">
            <div class="card-body py-3">
                <div class="row justify-content-between align-items-center">
                    <div class="col-sm-6">
                        <h5 class="fw-semibold mb-9 fs-5">Query Command Execution Result</h5>
                        <button class="btn btn-info">Click to Query</button>
                    </div>
                    <div class="col-sm-5">
                        <div class="position-relative mb-n5 text-center">
                            <img src="../assets/images/backgrounds/track-bg.png" alt="matdash-img" class="img-fluid" width="180" height="230">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection