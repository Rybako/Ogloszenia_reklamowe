<form method="POST" action="{{ route('user.update', $user->id) }}">
@csrf <!-- {{ csrf_field() }} -->
    {{ $user->id }}

<input name="name" value="{{ $user->name }}">
<input name="email"  value="{{ $user->email }}">
<input name="phone_number"  value="{{ $user->phone_number }}">
<input name="role"  value="{{ $user->role }}">
<input type="submit">

</form>