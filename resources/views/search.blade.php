
<div class='search-form'>
Cena od <input class='price_min'> Cena do <input class='price_max'>
Wysokość od <input class='height_min'> Szerokość od <input class='width_min'>
Kategoria <select list='category'><option>1</option><option>2</option></select>
Sortuj<select list='sort'><option>1</option><option>2</option></select>
</div>

<hr>
@foreach($listing_items as $item)
<div class='listings-items'>
	<div class='listings-item'>
	<img><div class='listing-content'>
		<h3 class='listing-item-title'>{{$item['title']}}</h3>
		<span class='lisiting-item-size'>{{$item['width']}}x{{$item['height']}}</span>
		<span class='lisiting-item-address'>{{$item['address']}}</span>
		<span class='lisiting-item-add_date'>{{$item['add_date']}}</span>
		<span class='lisiting-item-category'>{{$item['category']}}</span>

	</div>
</div>

@endforeach

<div class='listings-items'>
	<div class='listings-item'>
	<img><div class='listing-content'></div>
</div>


