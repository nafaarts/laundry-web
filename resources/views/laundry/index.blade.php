@extends('layouts.app')

@section('content')
    <div class="container-xl">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        {{ __('Laundries') }}
                    </h2>
                </div>
                <div class="col-auto ms-auto">
                    <div class="btn-list">
                        <a href="{{ route('laundry.create') }}" class="btn btn-sm btn-primary d-none d-sm-inline-block">
                            <i class="fas fa-fw fa-plus"></i>
                            Create new Laundry
                        </a>
                    </div>
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

            <div class="card p-4">
                <table class="display" id="myTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Owner') }}</th>
                            <th>{{ __('Permission') }}</th>
                            <th>{{ __('Address') }}</th>
                            <th>{{ __('Services') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($laundries as $laundry)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><a href="{{ route('laundry.show', $laundry) }}">{{ $laundry->name }}</a></td>
                                <td>{{ $laundry->user->name }}</td>
                                <td>{{ $laundry->no_izin }}</td>
                                <td>{{ $laundry->district . ', ' . $laundry->city }}</td>
                                <td>{{ $laundry->services->count() }}
                                    {{ Str::plural('service', $laundry->services->count()) }}</td>
                                <td>
                                    <div class="d-flex" style="gap:5px">
                                        <a href="{{ route('laundry.show', $laundry) }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-fw fa-eye"></i>
                                        </a>
                                        <a href="{{ route('laundry.edit', $laundry) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-fw fa-edit"></i>
                                        </a>
                                        <form action="{{ route('laundry.destroy', $laundry) }}" method="POST"
                                            onsubmit="return confirm('are you sure?')" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-fw fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
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
