@extends('layouts.app')

@section('content')
    <div class="container-xl">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <div class="page-pretitle">
                        {{ config('app.name') }}
                    </div>
                    <h2 class="page-title">
                        {{ __('Detail Order') }}
                    </h2>
                </div>
                <div class="col-auto ms-auto">
                    <a href="{{ route('orders.index') }}" class="btn d-sm-inline-block">
                        <i class="fas fa-fw fa-arrow-left"></i>
                        Go Back
                    </a>
                </div>
            </div>
        </div>
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

            <div class="card mb-3">
                <div class="card-body">
                    <table>
                        <tr>
                            <td>{{ __('Laundry') }}</td>
                            <td class="py-2 px-4">:</td>
                            <td><b>{{ $transaction->laundry->name }}</b></td>
                        </tr>
                        <tr>
                            <td>{{ __('Costumer') }}</td>
                            <td class="py-2 px-4">:</td>
                            <td>{{ $transaction->user->name }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('Weight') }}</td>
                            <td class="py-2 px-4">:</td>
                            <td>{{ $transaction->getTotalWeight() }} KG</td>
                        </tr>
                        <tr>
                            <td>{{ __('Price') }}</td>
                            <td class="py-2 px-4">:</td>
                            <td>Rp {{ number_format($transaction->getTotalPrice(), 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('Picked Up') }}</td>
                            <td class="py-2 px-4">:</td>
                            <td>
                                @if ($transaction->is_pickedup)
                                    <span class="badge bg-green"><i class="fas fa-fw fa-check"></i></span>
                                @else
                                    <span class="badge bg-orange"><i class="fas fa-fw fa-times"></i></span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>{{ __('Paid') }}</td>
                            <td class="py-2 px-4">:</td>
                            <td>
                                @if ($transaction->is_paid)
                                    <span class="badge bg-green"><i class="fas fa-fw fa-check"></i></span>
                                @else
                                    <span class="badge bg-orange"><i class="fas fa-fw fa-times"></i></span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>{{ __('Status') }}</td>
                            <td class="py-2 px-4">:</td>
                            <td class="text-uppercase">{{ $transaction->status }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('Date') }}</td>
                            <td class="py-2 px-4">:</td>
                            <td class="text-uppercase">{{ $transaction->created_at }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h4 class="m-0">Detail Items</h4>
                    <hr class="my-3">
                    <div class="table-responsive">
                        <table class="table" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('Service') }}</th>
                                    <th>{{ __('Weight') }}</th>
                                    <th>{{ __('Price') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transaction->details as $detail)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><b>{{ $detail->service->name }}</b></td>
                                        <td>{{ $detail->weight }} KG</td>
                                        <td>Rp {{ number_format($detail->price, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
