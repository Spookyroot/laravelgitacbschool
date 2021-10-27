@extends('layouts.main')

@section('header', $title)

@section('content')

<form action="{{ route('user.list') }}" method="get" class="search-form">
<div>
<table>

    <tr>
<td class="table-label"><label for="cmp-search"><strong>Search</strong></label></td>
<td class="table-sep"><label class="table-sep">::</label></td>
<td><input id="cmp-search" type="text" name="term" value="{{ $search['term'] }}" class="searchbox" /></td>
<td><input type="submit" value="Search" class="accent">
<a href="{{ route('user.list') }}"><button type="button" class="accent">Clear</button></a></td>
</tr>
</table> </form>

<nav class="spookynew">
<ul>
<li>
<a href="{{ route('user.create-form') }}">New User</a>
</li>
</ul>
</nav>

{{ $users->withQueryString()->links() }}

<table class="spookylist">

<tr>
    <th class="email">E-mail</th>
    <th>Name</th>
    <th class="role">Role</th>
</tr>

@foreach($users as $user)
<tr>
<td class="email">
<a class="code" href="{{route('user.view', [
'user' => $user->email,
])}}">
{{$user->email }}
</a>
</td>
<td>{{$user->name }}</td>
<td>{{$user->role }}</td>
</tr>
@endforeach
</table>

@endsection