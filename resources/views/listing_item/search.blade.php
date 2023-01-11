@extends('layouts.app')
@section('content')
<div>

	<form id="filter" action="{{ route('listing_item.search') }}" method="post" class="row g-3">
		@csrf <!-- {{ csrf_field() }} -->
		<div class="col-md">
			<label for="price_min">Cena od</label>
			<input type="number" name='price_min' min="0" value='{{isset($old) ? $old->price_min : 0}}' class="form-control">
		</div>
		<div class="col-md">
			<label for="price_max">Cena do</label>
			<input type="number" name='price_max' min="0" value='{{isset($old) ? $old->price_max : 99999}}' class="form-control">
		</div>
		<div class="col-md">
			<label for="height_min">Wysokość od</label>
			<input type="number" name='height_min' min="0" value='{{isset($old) ? $old->height_min : 1}}' class="form-control">
		</div>
		<div class="col-md">
			<label for="width_min">Szerokość od</label>
			<input type="number" name='width_min' min="0" value='{{isset($old) ? $old->width_min : 1}}' class="form-control">
		</div>
		<div class="col-md">
			<label for="category">Kategoria</label>
			<select id="category" name="category" class="form-control">
				<option {{isset($old) ? $old->category=='Kategoria1' ? 'selected': '' : ''}} value="Kategoria1">Kategoria1</option>
				<option {{isset($old) ? $old->category=='Kategoria2' ? 'selected': '' : ''}} value="Kategoria2">Kategoria2</option>
				<option {{isset($old) ? $old->category=='Kategoria3' ? 'selected': '' : ''}} value="Kategoria3">Kategoria3</option>
				<option {{isset($old) ? $old->category=='Kategoria4' ? 'selected': '' : ''}} value="Kategoria4">Kategoria4</option>
			</select>
		</div>
		<div class="col-md">
			<label for="sort">Sortuj</label>
			<select id="sort" name="sort" class="form-control">
				<option {{isset($old) ? $old->sort=='new' ? 'selected': '' : ''}} value='new'>Od najnowszych</option>
				<option {{isset($old) ? $old->sort=='cheap' ? 'selected': '' : ''}} value='cheap'>Od najtańszych</option>
				<option {{isset($old) ? $old->sort=='expensive' ? 'selected': '' : ''}} value="expensive">Od najdroższych</option>
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