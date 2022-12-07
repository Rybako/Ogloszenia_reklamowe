@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dodaj ogłoszenie</div>

                <div class="card-body">
                    <form action="{{ route('listing_item.create_form') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <label for="title" class="col-md-4 col-form-label text-md-end">Tytuł</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="price" class="col-md-4 col-form-label text-md-end">Cena</label>

                            <div class="col-md-6">
                                <input id="price" type="number" min="0" step="0.1" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" required>

                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="height" class="col-md-4 col-form-label text-md-end">Wysokość</label>

                            <div class="col-md-6">
                                <input id="height" type="number" min="1" class="form-control @error('height') is-invalid @enderror" name="height" value="{{ old('height') }}" required>

                                @error('height')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="width" class="col-md-4 col-form-label text-md-end">Szerokość</label>

                            <div class="col-md-6">
                                <input id="width" type="number" min="1" class="form-control @error('width') is-invalid @enderror" name="width" value="{{ old('width') }}" required>

                                @error('width')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="address" class="col-md-4 col-form-label text-md-end">Adres</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required>

                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="address" class="col-md-4 col-form-label text-md-end">Typ</label>

                            <div class="col-md-6">
                                <select id="category" class="form-control @error('content') is-invalid @enderror" name="category" value="{{old('category')}}" required>
                                    <option value="Kategoria1">Kategoria1</option>
                                    <option value="Kategoria2">Kategoria2</option>
                                    <option value="Kategoria3">Kategoria3</option>
                                    <option value="Kategoria4">Kategoria4</option>
                                </select>
                                @error('category')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="address" class="col-md-4 col-form-label text-md-end">Opis</label>

                            <div class="col-md-6">
                                
                                <textarea id="content" name="content" rows="4" cols="50" class="form-control @error('content') is-invalid @enderror"  value="{{ old('content') }}" placeholder="Opis ogłoszenia" required></textarea>

                                @error('content')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="images[]" class="col-md-4 col-form-label text-md-end">Zdjęcia</label>

                            <div class="col-md-6">
                                <input id="images[]" type="file" class="form-control @error('images[]') is-invalid @enderror" name="images[]" value="{{ old('images[]') }}" required multiple>

                                @error('images[]')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- MAPA -->
                        <div class="row">
                            <div class="col">
                                <div id="map"></div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Dodaj ogłoszenie') }}
                                </button>
                            </div>
                        </div>

                        <div class="row mb-0">
                            @if(session()->has('error'))
                            <div class="col-md-6 offset-md-4"><br>
                                    {{ session()->get('error') }}
                            </div>
                            @endif

                            @if(session()->has('success'))
                                <div class="col-md-6 offset-md-4"><br>
                                    <a href="{{ route('listing_item.view',['id'=>session('id')]) }}" class="btn btn-success form-control">Kilknij aby przejść do utworzonego ogłoszenia</a>
                                </div>
                            @endif
                        </div>
                        <input type="hidden"  name="position_X" id="position_X" value="12">
                        <input type="hidden"  name="position_Y" id="position_Y" value="12"> 

                    </form>

                    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
                        integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM="
                        crossorigin=""></script>

                    <script src="https://cdn.jsdelivr.net/npm/leaflet-search@3.0.5/dist/leaflet-search.src.js" integrity="sha256-iMrQwQNA33R07kJCTZcXDL3+RUJe0j9W9mY+RZEbUe4=" crossorigin="anonymous"></script>
                    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol@0.78.0/dist/L.Control.Locate.min.js"></script>

                    <script>

                        const map = L.map('map', {
                        center: [52, 17],
                        zoom: 6
                        });

                        var marker = L.marker();

function onMapClick(e) {
    marker
        .setLatLng(e.latlng)
        .addTo(map);
        console.log(marker.getLatLng())
        const {lat,lng} = marker.getLatLng()
        document.getElementById("position_X").value=lat
        document.getElementById("position_Y").value=lng


                        }

                        map.on('click', onMapClick);

                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors' }).addTo(map);

                        L.Control.geocoder().addTo(map);
                        L.control.locate().addTo(map);

                    </script>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
