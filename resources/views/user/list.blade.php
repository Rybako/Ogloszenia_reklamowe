<div class='container'>

    <table class="table">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Email</th>
        <th scope="col">Name</th>
        <th scope="col">Surname</th>
        <th scope="col">Role</th>
        <th scope="col">Status</th>
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
                <td>blocked</td>
                @else
                <td>active</td>
                @endif


                <td>
                    @if(!$user->blocked)
                    <a href="{{ route('user.block', $user->id) }}">
                        <button class="btn btn-success btn-sm"><i class="far fa-edit">
                            Block
                        </i></button>
                    </a>
                    @else
                    <a href="{{ route('user.unblock', $user->id) }}">
                        <button class="btn btn-success btn-sm"><i class="far fa-edit">
                            unBlock
                        </i></button>
                    </a>
                    @endif
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