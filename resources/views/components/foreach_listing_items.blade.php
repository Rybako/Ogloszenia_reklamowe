@foreach($listing_items as $item)

	<a href="{{route('listing_item.view', $item['id'])}}" style="text-decoration:none; color:inherit;">	
		<div style="">
		<div class="card mb-3" style="">
			<div class="row g-0">
			<div class="col-md-3">
				<img src=" {{ asset('images/'.$item['src']) }}" class="img-fluid rounded-start">
			</div>
			<div class="col-md-8">
				<div class="card-body">
					<h3 class="card-title">{{$item['title']}}</h3>
					<p class="card-text"><small class="text-muted">{{$item['add_date']}}</small></p>
				</div>
				<div class="">
					<p>This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
				</div>
			</div>
			</div>
		</div>
	</div>
	</a>
<!--
<a href="{{route('listing_item.view', $item['id'])}}">
<div>
		<img src=" {{ asset('images/'.$item['src']) }}">
		<div>
			<h3>{{$item['title']}}</h3>
			<span>{{$item['width']}}x{{$item['height']}}</span>
			<span>{{$item['address']}}</span>
			<span>{{$item['add_date']}}</span>
			<span>{{$item['price']}}</span>
		</div>
</div>
</a>
-->
@endforeach