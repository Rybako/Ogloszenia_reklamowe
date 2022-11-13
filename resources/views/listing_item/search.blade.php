
<div>
	{{json_encode($listing_items)}}
	<form  action="{{ route('listing_item.search') }}" method="post" >
		@csrf <!-- {{ csrf_field() }} -->
		Cena od <input name='price_min' value='0'> Cena do <input name='price_max' value='99999'>
		Wysokość od <input name='height_min' value='1'> Szerokość od <input name='width_min' value='1'>
		Sortuj<select name='sort'><option value='new'>Od najnowszych</option><option value='cheap'>Od najtańszych</option><option value="expensive">Od najdroższych</option></select>

		<button type="submit">Szukaj</button>
	</form>

	<a href="{{ $listing_items->nextPageUrl() }}">Następna Strona</a>
	<a href="{{ $listing_items->previousPageUrl() }}">Poprzednia Strona</a>

</div>

<hr>

@foreach($listing_items as $item)
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
@endforeach



