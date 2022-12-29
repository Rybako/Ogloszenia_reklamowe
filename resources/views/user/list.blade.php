@extends('layouts.app')

@section('content')

<div class='container'>

    <table class="table">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Email</th>
        <th scope="col">Name</th>
        <th scope="col">Surname</th>
        <th scope="col">Role</th>
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
                <td>
                <a href="{{ route('user.edit', $user->id) }}">
                            <button class="btn btn-success btn-sm"><i class="far fa-edit">
                                Edit
                            </i></button>
                        </a>
                        
                        <form action="{{ route('user.destroy', $user->id) }}" method="post">
                         @method('POST')
                        @csrf
                        <input class="btn btn-danger btn-sm delete" type="submit" value="Delete" />
                        </form>
                        
                    </td>
            </tr>
        @endforeach
    </tbody>
    </table>
    {{ $users -> links()}}
</div>