@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edycja użytkownika</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('user.update', $user->id) }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="id" class="col-md-4 col-form-label text-md-end">Id</label>

                            <div class="col-md-6">
                                <input id="id" type="text" value="{{ $user->id }}" class="form-control" readonly>

                                @error('id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Imię i nazwisko</label>

                            <div class="col-md-6">
                                <input id="name" type="text" maxlength="30" value="{{ $user->name }}" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">Adres email</label>

                            <div class="col-md-6">
                                <input id="email" type="email" maxlength="40" pattern="[a-z0-9._%+-]+@[a-z0-9]+\.[a-z]{2,4}$" value="{{ $user->email }}" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="phone_number" class="col-md-4 col-form-label text-md-end">Numer telefonu</label>

                            <div class="col-md-6">
                                <input id="phone_number" type="tel" maxlength="11" pattern="[0-9]{3}-[0-9]{3}-[0-9]{3}" placeholder="np. 123-123-123" value="{{ $user->phone_number }}" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ old('phone_number') }}" required autocomplete="phone_number" autofocus>

                                @error('phone_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="role" class="col-md-4 col-form-label text-md-end">Rola</label>

                            <div class="col-md-6">
                                <select id="role" class="form-control @error('role') is-invalid @enderror" name="role" value="{{ $user->role }}" required>
                                    <option @if($user['role']=="user") selected @endif value="user">User</option>
                                    <option @if($user['role']=="admin") selected @endif value="admin">Admin</option>
                                </select>
                                @error('role')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Zatwierdź
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection