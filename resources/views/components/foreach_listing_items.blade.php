@foreach($listing_items as $item)

<div class="my-1" style="overflow: hidden;">
	<a href="{{route('listing_item.view', $item['id'])}}" style="text-decoration:none; color:inherit; ">
		<div class="card mb-3">
			<div class="row g-0">
				<div class="col-md-3 thumb-post" style="height: 250px;">
					<img src=" {{ asset('images/'.$item['src']) }}" class="img-fluid rounded-start">
				</div>
			<div class="col row" style="height: 250px;">
				<div class="card-body cardList">
					<h3 class="card-title">{{$item['title']}}</h3>
					<div class="listing_coords" x="{{$item['position_X']}}" y="{{$item['position_Y']}}" id="{{$item['id']}}" path="{{route('listing_item.view', $item['id'])}}" > </div>
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
@endforeach
