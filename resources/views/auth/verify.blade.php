@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Zweryfikuj swój adres mailowy</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            Nowy link weryfikacyjny został wysłany na Twój adres.
                        </div>
                    @endif

                    Aby dodać ogłoszenie, musisz najpierw potwierdzić adres mailowy. Sprawdź swoją skrzynkę.
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('Kliknij tutaj aby wysłać nową wiadomość weryfikacyjną.') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
