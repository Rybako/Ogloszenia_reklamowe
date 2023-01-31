@extends('layouts.app')
@section('content')
<div>

	<form id="filter" action="{{ route('listing_item.search') }}" method="post" class="row g-3">
		@csrf <!-- {{ csrf_field() }} -->
		<div class="col-md">
			<label for="price_min">Cena od (zł/ms)</label>
			<input type="number" name='price_min' min="0" max="99999999.99"  step="0.01" value='{{isset($old) ? $old->price_min : 0.01}}' class="form-control">
		</div>
		<div class="col-md">
			<label for="price_max">Cena do (zł/ms)</label>
			<input type="number" name='price_max' min="0"   max="99999999.99" step="0.01" value='{{isset($old) ? $old->price_max : 99999999.99}}' class="form-control">
		</div>
		<div class="col-md">
			<label for="height_min">Wysokość od (w metrach)</label>
			<input type="number" name='height_min' min="0"   max="999.99" step="0.01" value='{{isset($old) ? $old->height_min : 0.01}}' class="form-control">
		</div>
		<div class="col-md">
			<label for="width_min">Szerokość od (w metrach)</label>
			<input type="number" name='width_min' min="0"  max="999.99"  step="0.01" value='{{isset($old) ? $old->width_min : 0.01}}' class="form-control">
		</div>
		<div class="col-md">
			<label for="category">Kategoria</label>
			<select id="category" name="category" class="form-control">
				<option {{isset($old) ? $old->category=='Wszystkie Kategorie' ? 'selected': '' : ''}} value="Wszystkie Kategorie">Wszystkie Kategorie</option>
				<option {{isset($old) ? $old->category=='Bilbord' ? 'selected': '' : ''}} value="Bilbord">Bilbord</option>
				<option {{isset($old) ? $old->category=='Witryna' ? 'selected': '' : ''}} value="Witryna">Witryna</option>
				<option {{isset($old) ? $old->category=='Baner' ? 'selected': '' : ''}} value="Baner">Baner</option>
				<option {{isset($old) ? $old->category=='Telebim' ? 'selected': '' : ''}} value="Telebim">Telebim</option>
				<option {{isset($old) ? $old->category=='Inne' ? 'selected': '' : ''}} value="Inne">Inne</option>
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

<div> @include('components.foreach_listing_items') </div>

<div class="row mb-3 mt-3">
	<div class="col ">
		<div class="card">
			<div class="card-header">
				Aktualnie widoczne ogłoszenia:
			</div>
			<div class="">
				<div id="map" class="form-control" style="width: auto; height: 50vh;"></div>
			</div>
		<div>
	</div>
</div>


<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM="
crossorigin=""></script>

<script>

	console.log(document.getElementById("map").getAttribute("x"))
	const map = L.map('map', {
	center: [52, 19],
	zoom: 6
	});

	L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors' }).addTo(map);

	const listings = document.getElementsByClassName("listing_coords")
	console.log(listings)
	for (const listing of listings) {
	var marker = L.marker([listing.getAttribute("x"), listing.getAttribute("y")]);
	const popup = L.popup()
	.setContent(`<img src="${listing.getAttribute("pic")}" class="img-fluid rounded-start rounded-end mb-3" >
    <a href="${listing.getAttribute("path")}" style="text-decoration:none; color:inherit; "><h4>${listing.getAttribute("name")}</h4> </a>
    <h5>  <span class="float-end">Typ: ${listing.getAttribute("type")}</span>
    <span>${listing.getAttribute("width")}x${listing.getAttribute("height")}m</span> </h5>
    <span>${listing.getAttribute("price")} zł/ms</span>`);
	marker.bindPopup(popup);

	marker.addTo(map);

	}


</script>

<hr>

<div class="d-flex justify-content-center">{{$listing_items->links()}}</div>

@endsection
