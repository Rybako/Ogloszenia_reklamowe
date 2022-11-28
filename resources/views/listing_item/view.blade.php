@extends('layouts.app')
@section('content')

	<div class="containter">
		<div class="row">
			<div id="carouselExampleControls" class="carousel col-6" data-bs-ride="carousel">
				<div class="carousel-inner">
				<div class="carousel-item active">
					<img src=" {{ asset('images/'.$images[0]['src']) }}" class="d-block w-100" alt="...">
				</div>
				@foreach($images as $key=>$image)
					@if($key!=0)
						<div class="carousel-item">
							<img src=" {{ asset('images/'.$image['src']) }}" class="d-block w-100" alt="...">
						</div>
					@endif
				@endforeach
				</div>
				<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="visually-hidden">Previous</span>
				</button>
				<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="visually-hidden">Next</span>
				</button>
			</div>

			<div class="col-6">
				<h1>{{$item['title']}}</h3>
				<span class="text-muted">Dodano: {{$item['add_date']}}</span>
				<h3><span>Wymiary: {{$item['width']}}x{{$item['height']}}m</span></h1>
				<div class="align-text-bottom">
					<span>{{$item['address']}}</span>
					<span>{{$item['price']}} zł/ms</span>
				</div>
				 <div id="map" x="{{$item['position_X']}}" y="{{$item['position_Y']}}" ></div>

 <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
     integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM="
     crossorigin=""></script>


<script>


console.log(document.getElementById("map").getAttribute("x"))
const map = L.map('map', {
  center: [document.getElementById("map").getAttribute("x"), document.getElementById("map").getAttribute("y")],
  zoom: 15
});

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors' }).addTo(map);
var marker = L.marker([document.getElementById("map").getAttribute("x"), document.getElementById("map").getAttribute("y")]);

marker.addTo(map);

    </script>
			</div>
		</div>
	</div>


@endsection



