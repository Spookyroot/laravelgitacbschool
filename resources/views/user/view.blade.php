@extends('layouts.main')

@section('header', $title)

@section('content')

<nav class="spookynew">
<ul>

<a href="{{ route('user.update-form', [
'user' => $user->email,
]) }}">Update</a>
</li>
<li>
<a href="{{ route('user.delete', [
'user' => $user->email,
]) }}">Delete</a>
</li>
<li>
<a href="{{
session()->get('bookmark.user-view', route('user.list'))
}}">&lt; Back</a>
</li>
</ul>
</nav>

<table class="spookylist">
    <tr>
        <td><strong>E-mail::</strong></td>
        
        <td>{{$user['email']}}</td>
</tr>

<tr>
<td><strong>Name::</strong></td>
        
        <td class="name">{{$user['name']}}</td>
</tr>

<tr>
<td><strong>Role::</strong></td>
   
        <td>{{$user['role']}}</td>
</tr>
</table>

@endsection