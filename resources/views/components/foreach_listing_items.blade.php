@foreach($listing_items as $item)

<div class="my-1" style=" overflow: hidden;">
	<a href="{{route('listing_item.view', $item['id'])}}" style="text-decoration:none; color:inherit; ">	
		<div class="card mb-3">
			<div class="row g-0">
			<div class="col-md-3 thumb-post" style="height: 250px;">
				<img src=" {{ asset('images/'.$item['src']) }}" class="img-fluid rounded-start height: 1px;">
			</div>
			<div class="col-md-8 row">
				<div class="card-body">
					<h3 class="card-title">{{$item['title']}}</h3>
					<p class="card-text"><small class="text-muted">{{$item['add_date']}}</small></p>
					{{$item['category']}}
				</div>
				<div class="listText">
					<p>{{$item['content']}}</p>
				</div>
			</div>
		</div>
	</div>
	</a>
</div>
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
			<span>{{$item['category']}}</span>
			<span>{{$item['content']}}</span>
		</div>
</div>
</a>
-->
@endforeach