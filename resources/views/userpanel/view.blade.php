@extends('layouts.app')

@section('content')
@foreach($listing_items as $item)
{{$user['email']}}
{{$user['name']}}
{{$user['phone_number']}}
{{$user['created_at']}}
@endforeach

<hr>
@include('components.foreach_listing_items')
@endsection
