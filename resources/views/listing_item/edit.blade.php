@extends('layouts.app')
@section('content')
@if($item['user_id']==Auth::id())
    @foreach($images as $key=>$image)
        <img src="{{ asset('images/'.$image['src']) }}" >
        @if(count($images)!=1)
        <a href="{{ route('image.delete',$image['id']) }}">delete image</a>
        @endif
        @if($image['order_position']!=0)
        <a href="{{ route('image.set_main',$image['id']) }}">set image main</a>
        @endif
    @endforeach

    <form action="{{ route('listing_item.edit_form', $item['id']) }}" method="post" enctype="multipart/form-data">
        @csrf <!-- {{ csrf_field() }} -->
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
@endif
@endsection