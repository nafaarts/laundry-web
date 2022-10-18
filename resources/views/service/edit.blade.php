@extends('layouts.app')

@section('content')
    <div class="container-xl">
        <!-- Page title -->
        <div class="page-header d-print-none">
            <div class="row align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        {{ config('app.name') }}
                    </div>
                    <h2 class="page-title">
                        {{ __('Edit Service') }}
                    </h2>
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

            <form action="{{ route('service.update', [$service, 'laundry' => request('laundry')]) }}" method="POST"
                class="card" autocomplete="off" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label required">{{ __('Laundry') }}</label>
                        <input type="text" readonly class="form-control" value="{{ $laundry->name }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label required">{{ __('Name') }}</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                            placeholder="{{ __('Name') }}" value="{{ old('name', $service->name) }}" required>
                    </div>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label class="form-label required">{{ __('Price') }}</label>
                        <input type="number" name="price" class="form-control @error('price') is-invalid @enderror"
                            placeholder="{{ __('price') }}" value="{{ old('price', $service->price) }}" required>
                        <small>*Price per/KG</small>
                    </div>
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label class="form-label required">{{ __('Description') }}</label>
                        <input type="text" name="description"
                            class="form-control @error('description') is-invalid @enderror"
                            placeholder="{{ __('description') }}" value="{{ old('description', $service->description) }}"
                            required>
                    </div>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label class="form-label">{{ __('Icon') }}</label>
                        <input type="file" name="icon" class="form-control @error('icon') is-invalid @enderror"
                            onchange="preview()">
                        <small>*Icon should be 100*100</small>
                    </div>
                    @error('icon')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <img id="frame" src="{{ asset('img/icon/' . $service->icon) }}" style="max-height: 150px" />
                </div>

                <div class="card-footer">
                    <a href="{{ route('laundry.show', $laundry) }}" class="btn btn-secondary">{{ __('Back') }}</a>
                    <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('custom_scripts')
    <script>
        function preview() {
            frame.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
@endsection
