@extends('layouts.app')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="d-flex mb-3" style="gap:0.75rem">
                <div class="card p-3 w-100">
                    <small class="text-muted">Users</small>
                    <h4 class="m-0">{{ $data['costumer'] ?? 0 }}</h4>
                </div>
                <div class="card p-3 w-100">
                    <small class="text-muted">Layanan</small>
                    <h4 class="m-0">{{ $data['services'] ?? 0 }}</h4>
                </div>
                <div class="card p-3 w-100">
                    <small class="text-muted">Orders</small>
                    <h4 class="m-0">{{ $data['orders'] ?? 0 }}</h4>
                </div>
                <div class="card p-3 w-100">
                    <small class="text-muted">Amount</small>
                    <h4 class="m-0">Rp {{ number_format($data['amount'] ?? 0) }}</h4>
                </div>
            </div>
            <div class="alert alert-success">
                <div class="alert-title">
                    {{ __('Welcome') }} {{ auth()->user()->name ?? null }}
                </div>
                <div class="text-muted">
                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
@endsection
