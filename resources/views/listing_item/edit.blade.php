@extends('layouts.app')
@section('content')
@if($item['user_id']==Auth::id())

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edytuj ogłoszenie</div>

                    <div class="card-body">
                        <form action="{{ route('listing_item.edit_form', $item['id']) }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="row mb-3">
                                <label for="title" class="col-md-4 col-form-label text-md-end">Tytuł</label>

                                <div class="col-md-6">
                                    <input id="title" type="text" maxlength="50" class="form-control @error('title') is-invalid @enderror" name="title" value="{{$item['title']}}" required autocomplete="title" autofocus>

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
                                    <input id="price" type="number" min="0" max="99999999.99" step="0.01" placeholder="podaj miesięczną cenę wynajmu w PLN" class="form-control @error('price') is-invalid @enderror" name="price" value="{{$item['price']}}" required autocomplete="price">

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
                                    <input id="height" type="number" min="0" max="999.99" step="0.01" placeholder="podaj wysokość w metrach" class="form-control @error('height') is-invalid @enderror" name="height" value="{{$item['height']}}" required autocomplete="height" autofocus>

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
                                    <input id="width" type="number" min="0" max="999.99" step="0.01" placeholder="podaj szerokość w metrach" class="form-control @error('width') is-invalid @enderror" name="width" value="{{$item['width']}}" required autocomplete="width" autofocus>

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
                                    <input id="address_bar" type="text" maxlength="70" placeholder="np. ul. Głogowska 260, 60-104 Poznań" class="form-control @error('address') is-invalid @enderror" name="address" value="{{$item['address']}}" required autocomplete="address" autofocus>

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
                                        <option @if($item['category']=="Bilbord") selected @endif value="Bilbord">Bilbord</option>
                                        <option @if($item['category']=="Witryna") selected @endif value="Witryna">Witryna</option>
                                        <option @if($item['category']=="Baner") selected @endif value="Baner">Baner</option>
                                        <option @if($item['category']=="Telebim") selected @endif value="Telebim">Telebim</option>
                                        <option @if($item['category']=="Inne") selected @endif value="Inne">Inne</option>
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

                                <textarea id="content" name="content" rows="4" cols="50" class="form-control @error('content') is-invalid @enderror"  value="{{ old('content') }}" placeholder="Opis ogłoszenia" required>{{$item['content']}}</textarea>

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
                                    <input id="images[]" type="file" class="form-control @error('images[]') is-invalid @enderror" name="images[]" autofocus multiple>

                                    @error('images[]')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <input class='id' name='id' value='{{$item['id']}}' hidden>

                            <div class="d-flex justify-content-center flex-wrap">
                                @foreach($images as $key=>$image)
                                    <div class="card edit-gallery" style="">
                                            <img src="{{ asset('images/'.$image['src']) }}" class="">
                                        <div class="card-body"></div>
                                        <div class="card-footer">
                                            <div class="vstack gap-2">
                                                @if($image['order_position']!=0)
                                                    <a href="{{ route('image.set_main',$image['id']) }}" class="btn btn-success">Ustaw jako zdjęcie główne</a>
                                                @endif
                                                @if($image['order_position']==0)
                                                    <div class="btn btn-success disabled" style="cursor: not-allowed;">Ustawiono jako zdjęcie główne</div>
                                                @endif
                                                @if(count($images)!=1)
                                                    <a href="" data-bs-toggle="modal" onclick="document.getElementById('deleteModalHref').href='{{route('image.delete',$image['id'])}}';" data-bs-target="#deleteModal" class="btn btn-danger">Usuń zdjęcie</a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Modal delete-->
                            <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="deleteModalLabel">Uwaga</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Czy na pewno chcesz usunąć zdjęcie?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Anuluj</button>
                                        <a id="deleteModalHref" href="JO" class="btn btn-danger">Usuń zdjęcie</a>
                                    </div>
                                </div>
                                </div>
                            </div>

                            <div class="row mb-3 my-3">
                                <div class="col ">
                                    <div class="card">
                                        <div class="card-header">
                                            Kliknij, aby zmienić lokalizację reklamy:
                                        </div>
                                        <div class="">
                                            <div id="map" class="form-control" style="width: auto; height: 50vh;"></div>
                                        </div>
                                    <div>
                                </div>
                                <input type="hidden"  name="position_X" id="position_X" value="{{$item['position_X']}}">
                                <input type="hidden"  name="position_Y" id="position_Y" value="{{$item['position_Y']}}">


                            </div>
                            <div class="row mb-0 mt-3">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" id="submit-button" class="btn btn-primary">
                                        Zatwierdź zmiany
                                    </button>
                                    <a class="btn btn-secondary" href="{{ route('userpanel.view') }}">
                                        Powrót
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
                                            document.getElementById('successModal').style.display = "none";
                                        }
                                    </script>


                                    <!-- Modal success-->
                                    <div class="modal fade show" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" style="display: block;">
                                        <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="successModalLabel">Edycja zakończona pomyślnie</h1>
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
                        </form>

                        <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
                        integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM="
                        crossorigin=""></script>

                        <script src="https://cdn.jsdelivr.net/npm/leaflet-search@3.0.5/dist/leaflet-search.src.js" integrity="sha256-iMrQwQNA33R07kJCTZcXDL3+RUJe0j9W9mY+RZEbUe4=" crossorigin="anonymous"></script>
                        <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
                        <script src="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol@0.78.0/dist/L.Control.Locate.min.js"></script>
                        <div id="listing_coords" x="{{$item['position_X']}}" y="{{$item['position_Y']}}" > </div>
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

                            var marker = L.marker()

                                .setLatLng([document.getElementById("listing_coords").getAttribute("x"), document.getElementById("listing_coords").getAttribute("y")],)
                                .addTo(map);

                            console.log(marker)
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
@endif
@endsection
