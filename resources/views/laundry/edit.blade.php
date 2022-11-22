@extends('layouts.app')

@section('custom_styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.1/dist/leaflet.css"
        integrity="sha256-sA+zWATbFveLLNqWO2gtiw3HL/lh1giY/Inf1BJ0z14=" crossorigin="" />

    <style>
        #map {
            height: 280px;
        }
    </style>
@endsection

@section('content')
    <div class="container-xl">
        <!-- Page title -->
        <div class="page-header d-print-none">
            <div class="row align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        {{ __('Edit Laundry') }}
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

            <form action="{{ route('laundry.update', $laundry) }}" method="POST" class="card" autocomplete="off"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label required">{{ __('Name') }}</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                            placeholder="{{ __('Name') }}" value="{{ old('name', $laundry->name) }}" required>
                    </div>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label class="form-label required">{{ __('Owner') }}</label>
                        <select name="owner" class="form-control @error('owner') is-invalid @enderror">
                            @foreach ($users as $user)
                                <option @selected(old('owner', $laundry->user_id) == $user->id) value="{{ $user->id }}">{{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @error('owner')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label class="form-label required">{{ __('Permission Number') }}</label>
                        <input type="text" name="no_izin" class="form-control @error('no_izin') is-invalid @enderror"
                            placeholder="{{ __('Permission Number') }}" value="{{ old('no_izin', $laundry->no_izin) }}"
                            required>
                    </div>
                    @error('no_izin')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label class="form-label required">{{ __('Address') }}</label>
                        <input type="text" name="address" class="form-control @error('address') is-invalid @enderror"
                            placeholder="{{ __('Address') }}" value="{{ old('address', $laundry->address) }}" required>
                    </div>
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    <div class="d-flex" style="gap: 0.75rem">
                        <div class="mb-3 w-100">
                            <label class="form-label required">{{ __('Latitude') }}</label>
                            <input type="text" name="lat" class="form-control @error('lat') is-invalid @enderror"
                                placeholder="{{ __('Latitude') }}" id="lat" value="{{ old('lat', $laundry->lat) }}"
                                required>
                        </div>
                        @error('lat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <div class="mb-3 w-100">
                            <label class="form-label required">{{ __('Longitude') }}</label>
                            <input type="text" name="long" class="form-control @error('long') is-invalid @enderror"
                                placeholder="{{ __('Longitude') }}" id="long"
                                value="{{ old('long', $laundry->long) }}" required>
                        </div>
                        @error('long')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" @checked($laundry->has_pickup) value="1"
                            name="has_pickup" id="has_pickup">
                        <label class="form-check-label" for="has_pickup">
                            Has Pickup
                        </label>
                    </div>

                    <div id="map"></div>
                    <small class="text-muted my-2 d-block" id="demo">-</small>

                    <div class="mb-3">
                        <label class="form-label">{{ __('Image') }}</label>
                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror"
                            onchange="preview()">
                    </div>
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <img id="frame" src="{{ asset('img/laundry/' . $laundry->image) }}" style="max-height: 150px" />
                </div>

                <div class="card-footer">
                    <a href="{{ route('laundry.index') }}" class="btn btn-secondary">{{ __('Back') }}</a>
                    <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                </div>
            </form>

        </div>
    </div>
@endsection

@section('custom_scripts')
    <script src="https://unpkg.com/leaflet@1.9.1/dist/leaflet.js"
        integrity="sha256-NDI0K41gVbWqfkkaHj15IzU7PtMoelkzyKp8TOaFQ3s=" crossorigin=""></script>

    <script>
        var x = document.getElementById("demo");
        const latInput = document.getElementById('lat')
        const longInput = document.getElementById('long')

        let coords = {
            lat: @json(old('lat', $laundry->lat)),
            long: @json(old('long', $laundry->long))
        }

        var map = L.map('map').setView([coords.lat, coords.long], 18);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        var marker = L.marker(new L.LatLng(coords.lat, coords.long), {
                draggable: true
            }).addTo(map)
            .bindPopup('You are here!');

        latInput.value = marker.getLatLng().lat;
        longInput.value = marker.getLatLng().lng;

        marker.on('dragend', function(e) {
            x.innerHTML = "Latitude: " + marker.getLatLng().lat +
                "<br>Longitude: " + marker.getLatLng().lng;
            latInput.value = marker.getLatLng().lat;
            longInput.value = marker.getLatLng().lng;

            x.innerHTML = "Latitude: <i>" + marker.getLatLng().lat +
                "</i><br>Longitude: <i>" + marker.getLatLng().long + "</i>";
        });

        x.innerHTML = "Latitude: <i>" + marker.getLatLng().lat +
            "</i><br>Longitude: <i>" + marker.getLatLng().long + "</i>";

        // setTimeout(function() {
        //     map.invalidateSize()
        //     console.log('map loaded');
        // }, 500);

        function preview() {
            frame.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
@endsection
