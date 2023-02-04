@foreach($listing_items as $item)

<div class="mt-3 mb-1" style="overflow: hidden;">
	<a href="{{route('listing_item.view', $item['id'])}}" style="text-decoration:none; color:inherit; ">
		<div class="card" style="{{$item->blocked?"background-color:red;": ($item->expiration_date<=date('Y-m-d H:i:s')?"background-color:yellow;":"")}}">
			<div class="row g-0">
				<div class="col-md-3 thumb-post" style="height: 250px;">
					<img src=" {{ asset('images/'.$item['src']) }}" class="img-fluid rounded-start">
				</div>
			<div class="col row" style="height: 250px;">
				<div class="card-body cardList">
					<h3 class="card-title">{{$item['title']}}</h3>
					<div class="listing_coords" x="{{$item['position_X']}}" y="{{$item['position_Y']}}" id="{{$item['id']}}" path="{{route('listing_item.view', $item['id'])}}" name="{{$item['title']}}" price="{{$item['price']}}" pic=" {{ asset('images/'.$item['src']) }}" type="{{$item['category']}}" width="{{$item['width']}}"
                    height="{{$item['height']}}" address="{{$item['address']}}"> </div>
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
</div>

@if(Auth::user()!=null?Auth::user()->role=='admin':false)

	@if(!$item->blocked)
			<button class="btn btn-warning" onclick="document.getElementById('blockModal2').href='{{ route('listing_item.block', $item->id) ;}}';" data-bs-toggle="modal" data-bs-target="#blockModal">Zablokuj</button>
    @else
			<button class="btn btn-warning" onclick="document.getElementById('unblockModal2').href='{{ route('listing_item.unblock', $item->id) ;}}';" data-bs-toggle="modal" data-bs-target="#unblockModal">Odblokuj</button>
    @endif

	<!-- Modal block-->
	<div class="modal fade" id="blockModal" tabindex="-1" aria-labelledby="blockModalLabel" aria-hidden="true">
		<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
			<h1 class="modal-title fs-5" id="blockModalLabel">Uwaga</h1>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
			Czy na pewno chcesz zablokować to ogłoszenie?
			</div>
			<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Anuluj</button>
			<a href="{{ route('listing_item.block', $item->id) ;}}" id="blockModal2">
				<button class="btn btn-warning">
					Zablokuj
				</button>
			</a>
			</div>
		</div>
		</div>
	</div>

	<!-- Modal unblock-->
	<div class="modal fade" id="unblockModal" tabindex="-1" aria-labelledby="unblockModalLabel" aria-hidden="true">
		<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
			<h1 class="modal-title fs-5" id="unblockModalLabel">Uwaga</h1>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
			Czy na pewno chcesz odblokować to ogłoszenie?
			</div>
			<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Anuluj</button>
			<a href="{{ route('listing_item.unblock', $item->id) }}" id="unblockModal2">
				<button class="btn btn-warning">
					Odblokuj
				</button>
			</a>
			</div>
		</div>
		</div>
	</div>
@endif



@endforeach