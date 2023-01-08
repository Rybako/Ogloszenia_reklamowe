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
                                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{$item['title']}}" required autocomplete="title" autofocus>

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
                                    <input id="price" type="number" min="0" step="0.1" class="form-control @error('price') is-invalid @enderror" name="price" value="{{$item['price']}}" required autocomplete="price">

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
                                    <input id="height" type="number" min="1" class="form-control @error('height') is-invalid @enderror" name="height" value="{{$item['height']}}" required autocomplete="height" autofocus>

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
                                    <input id="width" type="number" min="1" class="form-control @error('width') is-invalid @enderror" name="width" value="{{$item['width']}}" required autocomplete="width" autofocus>

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
                                    <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{$item['address']}}" required autocomplete="address" autofocus>

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
                                        <option @if($item['category']=="Kategoria1") selected @endif value="Kategoria1">Kategoria1</option>
                                        <option @if($item['category']=="Kategoria2") selected @endif value="Kategoria2">Kategoria2</option>
                                        <option @if($item['category']=="Kategoria3") selected @endif value="Kategoria3">Kategoria3</option>
                                        <option @if($item['category']=="Kategoria4") selected @endif value="Kategoria4">Kategoria4</option>
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
                                                @if(count($images)!=1)
                                                    <a href="{{ route('image.delete',$image['id']) }}" class="btn btn-danger">Usuń zdjęcie</a>
                                                @endif
                                                @if($image['order_position']!=0)
                                                    <a href="{{ route('image.set_main',$image['id']) }}" class="btn btn-success">Ustaw jako zdjęcie główne</a>
                                                @endif
                                                @if($image['order_position']==0)
                                                    <div class="btn btn-success disabled" style="cursor: not-allowed;">Ustawiono jako zdjęcie główne</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
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
                                    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
                                integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM="
                                crossorigin=""></script>
        
                                <script src="https://cdn.jsdelivr.net/npm/leaflet-search@3.0.5/dist/leaflet-search.src.js" integrity="sha256-iMrQwQNA33R07kJCTZcXDL3+RUJe0j9W9mY+RZEbUe4=" crossorigin="anonymous"></script>
                                <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
                                <script src="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol@0.78.0/dist/L.Control.Locate.min.js"></script>
            
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
            
                                </script>

                            </div>
                            <div class="row mb-0 mt-3">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Zatwierdź zmiany') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>




<!--
    @foreach($images as $key=>$image)
        <img src="{{ asset('images/'.$image['src']) }}" >
        @if(count($images)!=1)
        <a href="{{ route('image.delete',$image['id']) }}" class="btn btn-danger">delete image</a>
        @endif
        @if($image['order_position']!=0)
        <a href="{{ route('image.set_main',$image['id']) }}">set image main</a>
        @endif
    @endforeach
-->
<!--
    <form action="{{ route('listing_item.edit_form', $item['id']) }}" method="post" enctype="multipart/form-data">
        @csrf {{ csrf_field() }}
        Tytuł <input class='title' name='title' value="{{$item['title']}}">
        @error('title')<span>{{ $message }}</span>@enderror

        Cena <input class='price' name='price' value="{{$item['price']}}">
        @error('price')<span>{{ $message }}</span>@enderror

        Wysokość <input class='height' name='height' value="{{$item['height']}}">
        @error('height')<span>{{ $message }}</span>@enderror

        Szerokość <input class='width' name='width' value="{{$item['width']}}">
        @error('width')<span>{{ $message }}</span>@enderror

        Adres <input class='address' name='address'  value="{{$item['address']}}">
        @error('address')<span>{{ $message }}</span>@enderror
        <input class='id' name='id' value='{{$item['id']}}' hidden>
        <input type="submit">
    </form>
-->

@endif
@endsection
