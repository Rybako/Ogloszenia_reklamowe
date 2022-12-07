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

                            <select id="category" name="category">
                                <option @if($item['category']=="Kategoria1") selected @endif value="Kategoria1">Kategoria1</option>
                                <option @if($item['category']=="Kategoria2") selected @endif value="Kategoria2">Kategoria2</option>
                                <option @if($item['category']=="Kategoria3") selected @endif value="Kategoria3">Kategoria3</option>
                                <option @if($item['category']=="Kategoria4") selected @endif value="Kategoria4">Kategoria4</option>
                            </select>
                            
                            <textarea id="content" name="content" rows="4" cols="50" class="form-control @error('content') is-invalid @enderror"  value="{{ old('content') }}" required>
                                Text Ogłoszenia
                                </textarea>

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
                            
                            <div class="">
                                <div class="">
                                    <div class="">
                                        <div class="card-group">
                                            @foreach($images as $key=>$image)
                                                <div class="card" style="">
                                                    <div class="thumb-post">
                                                        <img src="{{ asset('images/'.$image['src']) }}" class="card-img-top">
                                                    </div>
                                                    <div class="card-body" style="height:3px"></div>
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
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-0">
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