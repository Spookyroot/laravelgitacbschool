@extends('layouts.main')

@section('header', $title)

@section('content')


<form action="{{ route('subject.update', ['subject' => $subject->code,]) }}" method="post">
@csrf
<table>

<tr>
<td><strong>Subject Code</strong></td>
<td class="blue">::</td>
<td><input type="text" name="code" value="{{ old('code', $subject->code) }}" /></td>
</tr>

<tr>
<td><strong>Subject</strong></td>
<td class="blue">::</td>
<td><input type="text" name="sub_name" value="{{ old('sub_name', $subject->sub_name) }}"/></td>

</table>

<input type="submit" value="Update" class="submit">

</form>

@endsection