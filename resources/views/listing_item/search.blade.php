@extends('layouts.app')
@section('content')
<div>

	<form action="{{ route('listing_item.search') }}" method="post" class="row g-3">
		@csrf <!-- {{ csrf_field() }} -->
		<div class="col-md">
			<label for="price_min">Cena od</label>
			<input type="number" name='price_min' min="0" value='0' class="form-control">
		</div>
		<div class="col-md">
			<label for="price_max">Cena do</label>
			<input type="number" name='price_max' min="0" value='99999' class="form-control">
		</div>
		<div class="col-md">
			<label for="height_min">Wysokość od</label>
			<input type="number" name='height_min' min="0" value='1' class="form-control">
		</div>
		<div class="col-md">
			<label for="width_min">Szerokość od</label>
			<input type="number" name='width_min' min="0" value='1' class="form-control">
		</div>
		<div class="col-md">
			<label for="category">Kategoria</label>
			<select id="category" name="category" class="form-control">
				<option value="Kategoria1">Kategoria1</option>
				<option value="Kategoria2">Kategoria2</option>
				<option value="Kategoria3">Kategoria3</option>
				<option value="Kategoria4">Kategoria4</option>
			</select>
		</div>
		<div class="col-md">
			<label for="sort">Sortuj</label>
			<select id="sort" name="sort" class="form-control">
				<option value='new'>Od najnowszych</option>
				<option value='cheap'>Od najtańszych</option>
				<option value="expensive">Od najdroższych</option>
			</select>
		</div>
		<div class="col-md">
			<label for="submit"></label>
			<button type="submit" id="submit" name="submit" class="form-control btn btn-warning">Szukaj</button>
		</div>
		<div class="d-flex justify-content-center">{{$listing_items->links()}}</div>
	</form>

</div>

<hr>

@include('components.foreach_listing_items')

<hr>

<div class="d-flex justify-content-center">{{$listing_items->links()}}</div>

@endsection