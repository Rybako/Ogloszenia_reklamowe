
		<img src=" {{ asset('images/'.$images[0]['src']) }}">
		
		<div>
			<h3>{{$item['title']}}</h3>
			<span>{{$item['width']}}x{{$item['height']}}</span>
			<span>{{$item['address']}}</span>
			<span>{{$item['add_date']}}</span>
			<span>{{$item['price']}}</span>
		</div>
		@foreach($images as $key=>$image)
		@if($key!=0)
		<img src=" {{ asset('images/'.$image['src']) }}">
		@endif
		@endforeach