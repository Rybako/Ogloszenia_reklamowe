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
		</div>
</div>
</a>
@endforeach