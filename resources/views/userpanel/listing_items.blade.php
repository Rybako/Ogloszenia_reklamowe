
@extends('layouts.app')

@section('content')
{{$user['email']}}
{{$user['name']}}
{{$user['phone_number']}}
{{$user['created_at']}}

<hr>

@foreach($listing_items as $item)

<a href="{{route('listing_item.view', $item['id'])}}">
    <div>
            <img src=" {{ asset('images/'.$item['src']) }}">
            <div>
                <h3>{{$item['title']}}</h3>
                <span>{{$item['width']}}x{{$item['height']}}</span>
                <span>{{$item['address']}}</span>
                <span>{{$item['add_date']}}</span>
                <span>{{$item['price']}}</span>
                <span>{{$item['category']}}</span>
                <span>{{$item['content']}}</span>
            </div>
            <a href="{{route('listing_item.edit', $item['id'])}}" href="">Edytuj</a>
            <a href="{{route('listing_item.delete', $item['id'])}}" href="">Kasuj</a>
            <a href="{{route('listing_item.add_time', $item['id'])}}" href="">Przedłuż</a>
    </div>
    </a>

    @if (session()->has('success'))
        <h1>{{ session('success') }}</h1>
    @endif
    @if (session()->has('error'))
        <h1>{{ session('error') }}</h1>
    @endif

@endforeach

@endsection

