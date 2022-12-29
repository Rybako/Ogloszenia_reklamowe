
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
    <div style="display:block;"class="modal fade show" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugiat, velit.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Read more</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    @endif
    @if (session()->has('error'))
        <h1>{{ session('error') }}</h1>
    @endif

@endforeach

@endsection

