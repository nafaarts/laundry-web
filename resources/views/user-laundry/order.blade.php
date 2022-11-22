@extends('layouts.app')

@section('content')
    <div class="container-xl">
        <div class="page-header d-print-none">
            <div class="row align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        {{ __('Orders') }}
                    </h2>
                </div>
            </div>
        </div>
        <hr>
    </div>
    <div class="page-body">

        <div class="container-xl">
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible">
                    <div class="d-flex">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon alert-icon" width="24"
                                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M5 12l5 5l10 -10"></path>
                            </svg>
                        </div>
                        <div>
                            {{ $message }}
                        </div>
                    </div>
                    <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                </div>
            @endif
        </div>
        <div class="container-xl">

            <div class="card p-4">
                <table class="display" id="myTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>{{ __('Laundry') }}</th>
                            <th>{{ __('Costumer') }}</th>
                            <th>{{ __('Weight') }}</th>
                            <th>{{ __('Price') }}</th>
                            <th>{{ __('Picked Up') }}</th>
                            <th>{{ __('Paid') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>
                                    <p class="mb-1 fw-bold">{{ $order->laundry->name }}</p>
                                    <small>{{ $order->created_at->format('d-m-Y H:i') }}</small>
                                </td>
                                <td>{{ $order->user->name }}</td>
                                <td>{{ $order->getTotalWeight() }} KG</td>
                                <td>Rp {{ number_format($order->getTotalPrice(), 0, ',', '.') }}</td>
                                <td>
                                    @if ($order->is_pickedup)
                                        <span class="badge bg-success"><i class="fas fa-fw fa-check"></i></span>
                                    @else
                                        <span class="badge bg-warning"><i class="fas fa-fw fa-times"></i></span>
                                    @endif
                                </td>
                                <td>
                                    @if ($order->is_paid)
                                        <span class="badge bg-success"><i class="fas fa-fw fa-check"></i></span>
                                    @else
                                        <span class="badge bg-warning"><i class="fas fa-fw fa-times"></i></span>
                                    @endif
                                </td>
                                <td class="text-uppercase">{{ $order->status }}</td>
                                <td>
                                    <a href="{{ route('laundry-orders.detail', $order) }}"
                                        class="btn btn-sm btn-info text-white">
                                        <i class="fas fa-fw fa-info-circle"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('custom_scripts')
    <script defer>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
@endsection
