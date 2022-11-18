@extends('layouts.app')

@section('content')
{{$user['email']}}
{{$user['name']}}
{{$user['phone_number']}}
{{$user['created_at']}}

<hr>
@include('components.foreach_listing_items')
@endsection
