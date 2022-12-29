@extends('layouts.app')
@section('content')
<div>
	<script>var x={{$listing_items->toJson()}}</script>
	<form  action="{{ route('listing_item.search') }}" method="post" >
		@csrf <!-- {{ csrf_field() }} -->
		Cena od <input name='price_min' value='0'> Cena do <input name='price_max' value='99999'>
		Wysokość od <input name='height_min' value='1'> Szerokość od <input name='width_min' value='1'>
		Kategoria 
		<select id="category" name="category">
			<option value="Kategoria1">Kategoria1</option>
			<option value="Kategoria2">Kategoria2</option>
			<option value="Kategoria3">Kategoria3</option>
			<option value="Kategoria4">Kategoria4</option>
		</select>
		Sortuj<select name='sort'><option value='new'>Od najnowszych</option><option value='cheap'>Od najtańszych</option><option value="expensive">Od najdroższych</option></select>

		<button type="submit">Szukaj</button>
	</form>
	
	{{$listing_items->links()}}


</div>

<hr>

@include('components.foreach_listing_items')
@endsection


