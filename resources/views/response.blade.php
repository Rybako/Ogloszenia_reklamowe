@if (session()->has('success'))
    <h1>{{ session('success') }}</h1>
@endif
@if (session()->has('error'))
    <h1>{{ session('error') }}</h1>
@endif