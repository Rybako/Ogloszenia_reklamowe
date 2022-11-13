<div>
    <form action="{{ route('listing_item.create_form') }}" method="post" enctype="multipart/form-data">
        @csrf <!-- {{ csrf_field() }} -->
        Tytuł <input class='title' name='title' value="{{ old('title') }}">
        @error('title')<span>{{ $message }}</span>@enderror

        Cena <input class='price' name='price' value="{{ old('price') }}">
        @error('price')<span>{{ $message }}</span>@enderror

        Wysokość <input class='height' name='height' value="{{ old('height') }}">
        @error('height')<span>{{ $message }}</span>@enderror 

        Szerokość <input class='width' name='width' value="{{ old('width') }}">
        @error('width')<span>{{ $message }}</span>@enderror

        Adres <input class='address' name='address'  value="{{ old('address') }}">
        @error('address')<span>{{ $message }}</span>@enderror

        <input type="file" class="form-control" name="image"  value="{{ old('image') }}"/>
        @error('image')<span>{{ $message }}</span>@enderror

        <button type="submit">Dodaj</button>
    </form>
    @if(session()->has('error'))
    <div>
        {{ session()->get('error') }}
    </div>
    @endif
    @if(session()->has('success'))
    <div>   
        {{ session()->get('success') }}
        Chcesz zobaczyć swoje ogłoszenie ? <a href="{{ route('listing_item.view',['id'=>session('id')]) }}">Poka</a>
    </div>
    @endif
</div>