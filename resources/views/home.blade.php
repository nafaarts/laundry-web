@extends('layouts.app')

@section('custom_styles')
@endsection

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="d-flex mb-3" style="gap:0.75rem">
                <div class="card p-3 w-100">
                    <small class="text-muted">Users</small>
                    <h2 class="m-0">{{ $data['users'] }}</h2>
                </div>
                <div class="card p-3 w-100">
                    <small class="text-muted">Laundry</small>
                    <h2 class="m-0">{{ $data['laundry'] }}</h2>
                </div>
                <div class="card p-3 w-100">
                    <small class="text-muted">Layanan</small>
                    <h2 class="m-0">{{ $data['services'] }}</h2>
                </div>
                <div class="card p-3 w-100">
                    <small class="text-muted">Orders</small>
                    <h2 class="m-0">{{ $data['orders'] }}</h2>
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
