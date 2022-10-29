@extends('master')
@section('search_section')
<div class='search-form'>
Cena od <input class='price_min'> Cena do <input class='price_max'>
Wysokość od <input class='height_min'> Szerokość od <input class='width_min'>
Kategoria <select list='category'><option>1</option><option>2</option></select>
Sortuj<select list='sort'><option>1</option><option>2</option></select>
</div>


<div class='listings-items'>
	<div class='listings-item'>
	<img><div class='listing-content'></div>
</div>

@endsection

