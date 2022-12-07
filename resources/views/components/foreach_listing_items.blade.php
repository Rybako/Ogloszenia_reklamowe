@foreach($listing_items as $item)

	<a href="{{route('listing_item.view', $item['id'])}}" style="text-decoration:none; color:inherit;">	
		<div style="">
		<div class="card mb-3" style="height: 250px; overflow: hidden;">
			<div class="row g-0">
			<div class="col-md-3 thumb-post">
				<img src=" {{ asset('images/'.$item['src']) }}" class="img-fluid rounded-start height: 1px;">
			</div>
			<div class="col-md-8 row justify-content-bottom">
				<div class="card-body">
					<h3 class="card-title">{{$item['title']}}</h3>
					<p class="card-text"><small class="text-muted">{{$item['add_date']}}</small></p>
					{{$item['category']}}
				</div>
				<div class="">
					<p>Tu był jakiś długi tekst ale jnie wiem po co ony był wieć wppisuje poodbąną długą linijke tesktu.</p>
				</div>
			</div>
			</div>
		</div>
	</div>
	</a>
<!--
<a href="{{route('listing_item.view', $item['id'])}}">
<div>
		<img src=" {{ asset('images/'.$item['src']) }}">
		<div>
			<h3>{{$item['title']}}</h3>
			<span>{{$item['width']}}x{{$item['height']}}</span>
			<span>{{$item['address']}}</span>
			<span>{{$item['add_date']}}</span>
			<span>{{$item['price']}}</span>
		</div>
</div>
</a>
-->
@endforeach