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
                                <input id="title" type="text" maxlength="50" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>

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
                                <input id="price" type="number" min="0" max="99999999.99" step="0.01" placeholder="podaj miesięczną cenę wynajmu w PLN" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" required>

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
                                <input id="height" type="number" min="0.01" max="999.99" step="0.01" placeholder="podaj wysokość w metrach" class="form-control @error('height') is-invalid @enderror" name="height" value="{{ old('height') }}" required>

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
                                <input id="width" type="number" min="0.01" max="999.99" step="0.01" placeholder="podaj szerokość w metrach" class="form-control @error('width') is-invalid @enderror" name="width" value="{{ old('width') }}" required>

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
                                <input id="address_bar" type="text" maxlength="70" placeholder="np. ul. Głogowska 260, 60-104 Poznań" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required>

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
                                    <option value="Bilbord">Bilbord</option>
                                    <option value="Witryna">Witryna</option>
                                    <option value="Baner">Baner</option>
                                    <option value="Telebim">Telebim</option>
                                    <option value="Inne">Inne</option>
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

                                <textarea id="content" name="content" maxlength="1000" rows="4" cols="50" class="form-control @error('content') is-invalid @enderror"  value="{{ old('content') }}" placeholder="Opis ogłoszenia" required></textarea>

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
                        <div class="row mb-3">
                            <div class="col ">
                                <div class="card">
                                    <div class="card-header">
                                        Kliknij, aby wybrać dokładną lokalizację reklamy:
                                    </div>
                                    <div class="">
                                        <div id="map" class="form-control" style="width: auto; height: 50vh;"></div>
                                    </div>
                                <div>
                            </div>
                        </div>

                        <div class="row mb-0 mt-3">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" id="submit-button" class="btn btn-primary">
                                    Dodaj ogłoszenie
                                </button>
                                <a class="btn btn-secondary" href="{{ url('/ogloszenia') }}">
                                    Anuluj
                                </a>
                            </div>
                        </div>

                        <div class="row mb-0">
                            @if(session()->has('error'))
                            <div class="col-md-6 offset-md-4"><br>
                                    {{ session()->get('error') }}
                            </div>
                            @endif

                            @if(session()->has('success'))

                                <script>
                                    function closeModal() {
                                        document.getElementById('exampleModal').style.display = "none";
                                    }
                                </script>


                                <!-- Modal -->
                                <div class="modal fade show" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" style="display: block;">
                                    <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Ogłoszenie zostało dodane poprawnie</h1>
                                        <button type="button" id="close" onclick="closeModal()" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <a href="{{ route('listing_item.view',['id'=>session('id')]) }}" class="btn btn-success form-control">
                                                Przejdź do ogłoszenia
                                            </a>
                                        </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <input type="hidden"  name="position_X" id="position_X" value="{{ old('position_X') }}">
                        <input type="hidden"  name="position_Y" id="position_Y" value="{{ old('position_Y') }}">

                    </form>

                    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
                        integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM="
                        crossorigin=""></script>

                    <script src="https://cdn.jsdelivr.net/npm/leaflet-search@3.0.5/dist/leaflet-search.src.js" integrity="sha256-iMrQwQNA33R07kJCTZcXDL3+RUJe0j9W9mY+RZEbUe4=" crossorigin="anonymous"></script>
                    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol@0.78.0/dist/L.Control.Locate.min.js"></script>
                    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&region=pl"></script>

                    <script>
                    var searchInput = document.getElementById('address_bar');

                    var autocomplete = new google.maps.places.Autocomplete(address_bar, {
                    types: ['address'],
                    componentRestrictions: { country: 'pl' }
                    });

                    document.getElementById('submit-button').addEventListener('click', function(e) {
                    var place = autocomplete.getPlace();
                    if (!place || !place.geometry) {

                    window.alert("Podany adres '" + searchInput.value + "' nie widnieje w naszej bazie.");
                    e.preventDefault();
                    return;
                    }


                    address_bar.value = place.formatted_address;
                    });




                    </script>

                    <script>

                        const map = L.map('map', {
                        center: [52, 19],
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

                        const submitButton = document.getElementById("submit-button");

                        submitButton.addEventListener("click", function(e) {
                        if (!marker._latlng) {
                            e.preventDefault();
                                alert("Proszę o dodanie znacznika na mapie.");
                            }
                        });



                    </script>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
