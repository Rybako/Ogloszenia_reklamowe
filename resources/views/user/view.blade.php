@extends('layouts.app')

@section('content')

<form action="" method="post" class="row g-3">
    @csrf <!-- {{ csrf_field() }} -->
    <div class="col-md">
        <label for="name">Użytkownik</label>
        <input type="text" name='name' value='{{$user['name']}}' class="form-control" disabled readonly>
    </div>
    <div class="col-md">
        <label for="price_max">Adres email</label>
        <input type="email" name='email' value='{{$user['email']}}' class="form-control" disabled readonly>
    </div>
    <div class="col-md">
        <label for="phone">Numer telefonu</label>
        <input type="tel" name='phone' value='{{$user['phone_number']}}' class="form-control" disabled readonly>
    </div>
    <div class="col-md">
        <label for="date">Data utworzenia konta</label>
        <input type="text" name='date' value='{{$user['created_at']}}' class="form-control" disabled readonly>
    </div>
    <div class="d-flex justify-content-center">{{$listing_items->links()}}</div>
</form>

<hr>
@include('components.foreach_listing_items')
@endsection
