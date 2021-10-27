@extends('layouts.main')

@section('header', $title)

@section('content')

<form action="{{ route('subject.create') }}" method="post">
@csrf

<table>

<tr>
<td><strong>Subject Code</strong></td>
<td class="blue">::</td>
<td><input type="text" name="code" /></td>
</tr>

<tr>
<td><strong>Subject</strong></td>
<td class="blue">::</td>
<td><input type="text" name="sub_name" /></td>

</table>

<input type="submit" value="Create" class="submit">

</form>

@endsection