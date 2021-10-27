@extends('layouts.main')

@section('header', $title)

@section('content')

@include('sweetalert::alert')
<form action="{{ route('user.update', ['user' => $user->email,]) }}" method="post">
@csrf
<table>

<tr>
<td><strong>E-mail</strong></td>
<td class="blue">::</td>
<td><input type="text" name="email" value="{{ $user->email }}"/></td>
</tr>

<tr>
<td><strong>Name</strong></td>
<td class="blue">::</td>
<td><input type="text" name="name" value="{{ $user->name }}"/></td>
</tr>

<tr>
<td><strong>Password</strong></td>
<td class="blue">::</td>
<td><input type="password" name="password" placeholder="Please input 1234"/></td>
</tr>

<tr>
<td><strong>Role</strong></td>
<td class="blue">::</td>
<td>
<select name="role">
    <option>-- Plese select --</option>

    <option selected value="{{$user->role}}" >
                    {{$user->role}}</option>
    @if ($user->role == "ADMIN")
    <option value="USER">USER</option>
    @else
                <option value="ADMIN">ADMIN</option>
    @endif
            </select>

</td>
</tr>

<tr>

</table>

<input type="submit" value="Update" class="submit">

</form>

@endsection