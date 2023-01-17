@extends('layouts.app')
@section('content')

	<div class="containter" style="">
		<div class="row">
			<!--CAROUSEL-->
			<div id="carouselExampleControls" class="carousel carousel-dark col-xl-8 carousel-mini d-block slide" data-bs-ride="carousel" data-bs-interval="1000000">
				<div class="carousel-indicators" >
					<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>

					@foreach($images as $key=>$image)
						@if($key!=0)
							<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{$key}}"></button>
						@endif
					@endforeach
				</div>

				<a href="" data-bs-toggle="modal" data-bs-target="#exampleModal">
					<div class="carousel-inner" >
					<div class="carousel-item active">
						<a data-bs-toggle="modal" data-bs-target="#exampleModal">
						<img id="Myimg" src="{{ asset('images/'.$images[0]['src']) }}" class="d-block w-100" alt="..." data-bs-toggle="modal" data-bs-target="#exampleModal">
						</a>
					</div>
					@foreach($images as $key=>$image)
						@if($key!=0)
							<div class="carousel-item" >
								<a data-bs-toggle="modal" data-bs-target="#exampleModal">
								<img src=" {{ asset('images/'.$image['src']) }}" class="d-block w-100 " alt="..." >
								</a>
							</div>
						@endif
					@endforeach
					</div>
				</a>
				<button class="carousel-control-prev carousel-hud" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="visually-hidden">Previous</span>
				</button>
				<button class="carousel-control-next carousel-hud" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="visually-hidden">Next</span>
				</button>
			</div>

			<!--Modal carousel max-->
			<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-fullscreen">
				  <div class="modal-content">
					<div class="modal-header">
					  <h1 class="modal-title fs-5" id="exampleModalLabel">Galeria</h1>
					  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<!--Carousel max-->
						<div id="carouselModalControls" class="carousel carousel-dark carousel-max d-block slide" data-bs-ride="carousel" data-bs-interval="1000000">
							<div class="carousel-indicators" >
								<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>

								@foreach($images as $key=>$image)
									@if($key!=0)
										<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{$key}}"></button>
									@endif
								@endforeach
							</div>

							<div class="carousel-inner" >
							<div class="carousel-item active">
								<img id="Myimg" src="{{ asset('images/'.$images[0]['src']) }}" class="d-block w-100" alt="..." data-bs-toggle="modal" data-bs-target="#exampleModal">
							</div>
							@foreach($images as $key=>$image)
								@if($key!=0)
									<div class="carousel-item" >
										<img src=" {{ asset('images/'.$image['src']) }}" class="d-block w-100 " alt="..." >
									</div>
								@endif
							@endforeach
							</div>
							<button class="carousel-control-prev carousel-hud" type="button" data-bs-target="#carouselModalControls" data-bs-slide="prev">
							<span class="carousel-control-prev-icon" aria-hidden="true"></span>
							<span class="visually-hidden">Previous</span>
							</button>
							<button class="carousel-control-next carousel-hud" type="button" data-bs-target="#carouselModalControls" data-bs-slide="next">
							<span class="carousel-control-next-icon" aria-hidden="true"></span>
							<span class="visually-hidden">Next</span>
							</button>
						</div>
					</div>
				  </div>
				</div>
			  </div>

			<!--MAPA-->
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

		<div class="row mx-0 mt-3 me-2">

			<div class="card col-xl-8">
				<h3 class="card-header">{{$item['title']}}</h3>
				<div class="card-body">

					<h4>
						<span>{{$item['price']}} zł/ms</span>
						<span class="float-end"> {{$item['address']}}</span>
					</h4>

					<h4>
						<span>{{$item['width']}}x{{$item['height']}}m</span>
						<span class="float-end">Typ: {{$item['category']}}</span>

					</h4>

				  <h5 class="card-title"></h5>
				  <p class="card-text">{{$item['content']}}</p>
				</div>
				<div class="card-footer text-muted">
					Dodano: {{$item['add_date']}}
				</div>
			</div>

			<div class="col-xl-4">
				<h3 class="text-muted">Autor:</h3>
				<h4>
					<a href="{{route('user.view', $user['id'])}}">{{$user['name']}}</a>
				</h4>
				<span>{{$user['email']}}</span><br>
				<span>tel. {{$user['phone_number']}}</span>
			</div>
		</div>
	</div>

@endsection



