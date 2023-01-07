
@extends('layouts.app')

@section('content')
{{$user['email']}}
{{$user['name']}}
{{$user['phone_number']}}
{{$user['created_at']}}

{{$listing_items->links()}}

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
        <a href="{{route('listing_item.add_time', $item['id'])}}" href="" class="btn btn-primary">Przedłuż</a>
        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">Usuń</a>
    </div>
</div>

<!-- Modal delete-->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Uwaga</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Czy na pewno chcesz usunąć ogłoszenie?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <a href="{{route('listing_item.delete', $item['id'])}}" href="" class="btn btn-danger">Usuń</a>
        </div>
      </div>
    </div>
  </div>

    @if (session()->has('success'))
        <script>
            function closeModal2() {
                document.getElementById('dateExtendModal').style.display = "none";
            }
        </script>


        <!-- Modal -->
        <div class="modal fade show" id="dateExtendModal" tabindex="-1" aria-labelledby="dateExtendModalLabel" style="display: block;">
            <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                <h1 class="modal-title fs-5" id="dateExtendModalLabel">Sukces!</h1>
                <button type="button" id="close2" onclick="closeModal2()" class="btn-close"></button>
                </div>
                <div class="modal-body">
                    <h4>{{ session('success') }}</h4>
                </div>
            </div>
            </div>
        </div>
            <!--<h1>{{ session('success') }}</h1>-->
    @endif
    @if (session()->has('error'))
        <h1>{{ session('error') }}</h1>
    @endif

@endforeach

<hr>

{{$listing_items->links()}}

@endsection

