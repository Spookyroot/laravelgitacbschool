@extends('layouts.main')

@section('header', $title)

@section('content')

@include('sweetalert::alert')
<form action="{{ route('user.create') }}" method="post">
@csrf

<table>

<tr>
<td><strong>E-mail</strong></td>
<td class="blue">::</td>
<td><input type="text" name="email" /></td>
</tr>

<tr>
<td><strong>Name</strong></td>
<td class="blue">::</td>
<td><input type="text" name="name" /></td>
</tr>

<tr>
<td><strong>Password</strong></td>
<td class="blue">::</td>
<td><input type="password" name="password" /></td>
</tr>

<tr>
<td><strong>Role</strong></td>
<td class="blue">::</td>
<td>
<select name="role">
    <option>-- Plese select --</option>
    <option value="USER">USER</option>
                <option value="ADMIN">ADMIN</option>
            </select>
</td>
</tr>


</table>

<input type="submit" value="Create" class="submit">

</form>

@endsection