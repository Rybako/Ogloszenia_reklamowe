@extends('layouts.app')
@section('content')

	<div class="containter" style="">
		<div class="row">
			<div id="carouselExampleControls" class="carousel carousel-dark col-xl-8 d-block slide" data-bs-ride="carousel" data-bs-interval="1000000">
				<div class="carousel-indicators" >
					<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
					
					@foreach($images as $key=>$image)
						@if($key!=0)
							<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{$key}}"></button>
						@endif
					@endforeach
				  </div>
				<div class="carousel-inner" >
				<div class="carousel-item active" >
					<img src="{{ asset('images/'.$images[0]['src']) }}" class="d-block w-100" alt="...">
				</div>
				@foreach($images as $key=>$image)
					@if($key!=0)
						<div class="carousel-item" >
							<img src=" {{ asset('images/'.$image['src']) }}" class="d-block w-100 " alt="..." >
						</div>
					@endif
				@endforeach
				</div>
				<button class="carousel-control-prev carousel-hud" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="visually-hidden">Previous</span>
				</button>
				<button class="carousel-control-next carousel-hud" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="visually-hidden">Next</span>
				</button>
			</div>

			<div id="map" x="{{$item['position_X']}}" y="{{$item['position_Y']}}" class="col-xl-4"></div>

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
		
		<div class="row">
			<div class="col-xl-8">
				<h1>{{$item['title']}}</h3>
				<span class="text-muted">Dodano: {{$item['add_date']}}</span>
				<h3><span>Wymiary: {{$item['width']}}x{{$item['height']}}m</span></h1>
				<div class="">
					<span>{{$item['address']}}</span>
					<span>{{$item['price']}} zł/ms</span>
				</div>
			</div>

			<div class="col-xl-4">
				<a href="{{route('user.view', $user['id'])}}">{{$user['name']}}</a>
				{{$user['email']}}
				{{$user['asdasdasdasd']}}
			</div>
		</div>
	</div>

@endsection



