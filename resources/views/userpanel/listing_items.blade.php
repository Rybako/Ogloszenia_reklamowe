
@extends('layouts.app')

@section('content')

<form action="{{ route('listing_item.search') }}" method="post" class="row g-3">
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

@foreach($listing_items as $item)

<div class="my-1 mt-3" style="overflow: hidden;">
	<a href="{{route('listing_item.view', $item['id'])}}" style="text-decoration:none; color:inherit; ">	
		<div class="card mb-1">
			<div class="row g-0">
				<div class="col-md-3 thumb-post" style="height: 250px;">
					<img src=" {{ asset('images/'.$item['src']) }}" class="img-fluid rounded-start">
				</div>
                <div class="col row" style="height: 250px;">
                    <div class="card-body cardList">
                        <h3 class="card-title">{{$item['title']}}</h3>
                        <h5>
                            <span>{{$item['price']}} zł/ms</span>
                            <span class="float-end"> {{$item['address']}}</span>
                        </h5>

                        <h5>
                            <span>{{$item['width']}}x{{$item['height']}}m</span>
                            <span class="float-end">Typ: {{$item['category']}}</span>
                        </h5>
                        <p class="listText">{{$item['content']}}</p>
                        <span class="text-muted date">Dodano: {{$item['add_date']}}, ważne do: {{$item['expiration_date']}}</span>
                    </div>
                </div>
		    </div>
	    </div>
	</a>
    <div class="mb-3 mt-0">
        <a href="{{route('listing_item.edit', $item['id'])}}" href="" class="btn btn-success">Edytuj</a>
        <button type="button" class="btn btn-primary me-1" data-bs-toggle="modal" data-bs-target="#extendModal">Przedłuż</a>
        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">Usuń</a>
    </div>
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
          Czy na pewno chcesz usunąć ogłoszenie?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Anuluj</button>
          <a href="{{route('listing_item.delete', $item['id'])}}" href="" class="btn btn-danger">Usuń</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal extend-->
<div class="modal fade" id="extendModal" tabindex="-1" aria-labelledby="extendModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="extendModalLabel">Przedłużyć ogłoszenie?</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Termin ważności ogłoszenia zostanie przedłużony o 30 dni, licząc od dzisiaj.
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Anuluj</button>
          <a href="{{route('listing_item.add_time', $item['id'])}}" href="" class="btn btn-primary">Zatwierdź</a>
        </div>
      </div>
    </div>
  </div>

    @if (session()->has('success'))
            <!--<h1>{{ session('success') }}</h1>-->
    @endif
    @if (session()->has('error'))
        <h1>{{ session('error') }}</h1>
    @endif

@endforeach

<hr>

<div class="d-flex justify-content-center">{{$listing_items->links()}}</div>

@endsection

