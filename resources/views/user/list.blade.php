@extends('layouts.app')

@section('content')
<div class='container'>

    <table class="table">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Email</th>
        <th scope="col">Imię i nazwisko</th>
        <th scope="col">Numer telefonu</th>
        <th scope="col">Rola</th>
        <th scope="col">Status</th>
        <th scope="col"></th>
        <th scope="col">Akcje</th>
        <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
            <tr>
                <th scope="row">{{ $user->id }}</th>
                <td>{{ $user->email }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->phone_number }}</td>
                <td>{{ $user->role }}</td>
                @if($user->blocked)
                <td>Zablokowany</td>
                @else
                <td>Aktywny</td>
                @endif

                <td>
                    <a href="{{ route('user.edit', $user->id) }}">
                        <button class="btn btn-primary btn-sm">
                            Edytuj
                        </button>
                    </a>
                </td>

                <td>
                    @if(!$user->blocked)
                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#blockModal">Zablokuj</button>
                    @else
                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#unblockModal">Odblokuj</button>
                    @endif
                </td>
                
                <td>
                    <a href="" onclick="document.getElementById('deleteModalHref').href='{{ route('user.destroy', $user->id) }}" data-bs-target="#deleteModal" class="btn btn-danger btn-sm" data-bs-toggle="modal">Usuń</a>
                </td>
            </tr>

            <!-- Modal block-->
            <div class="modal fade" id="blockModal" tabindex="-1" aria-labelledby="blockModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h1 class="modal-title fs-5" id="blockModalLabel">Uwaga</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    Czy na pewno chcesz zablokować tego użytkownika?
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Anuluj</button>
                    <a href="{{ route('user.block', $user->id) }}">
                        <button class="btn btn-warning">
                            Zablokuj
                        </button>
                    </a>
                    </div>
                </div>
                </div>
            </div>

            <!-- Modal unblock-->
            <div class="modal fade" id="unblockModal" tabindex="-1" aria-labelledby="unblockModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h1 class="modal-title fs-5" id="unblockModalLabel">Uwaga</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    Czy na pewno chcesz odblokować tego użytkownika?
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Anuluj</button>
                    <a href="{{ route('user.unblock', $user->id) }}">
                        <button class="btn btn-warning">
                            Odblokuj
                        </button>
                    </a>
                    </div>
                </div>
                </div>
            </div>

            <!-- Modal delete-->
            <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteModalLabel">Uwaga</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    Czy na pewno chcesz usunąć tego użytkownika?
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Anuluj</button>
                    <form action="{{ route('user.destroy', $user->id) }}" method="post">
                        @method('POST')
                        @csrf
                        <input class="btn btn-danger delete" type="submit" id="deleteModalHref" value="Usuń" />
                    </form>
                    </div>
                </div>
                </div>
            </div>
        @endforeach
    </tbody>
    </table>
    {{ $users -> links()}}
</div>

@endsection