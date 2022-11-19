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
			</div>
		</div>
	</div>
		
@endsection