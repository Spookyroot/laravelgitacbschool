@extends('layouts.main')

@section('header',' Our teacher')
@section('content')

<form action="{{ route('teacher.list') }}" method="get" class="spookysearch">
<div>
<table>
    <tr>
<td class="table-label"><label for="cmp-search"><strong>Search</strong></label></td>
<td class="table-sep"><label class="table-sep">::</label></td>
<td><input id="cmp-search" type="text" name="term" value="{{ $search['term'] }}" class="searchbox"/></td>
<td class="table-submit"></td>
<td><input type="submit" value="Search" class="accent"></td>
<td><a href="{{ route('teacher.list') }}">
<button type="button" class="accent">Clear</button>
</a></td>
<td></td>
</tr>
</table>
</form>

<nav class="spookynew">
<ul>
@can('create', \App\Models\Teacher::class)
<li>
<a href="{{ route('teacher.create-form') }}">New Teacher</a>
</li>
@endcan
</ul>
</nav>


<table class="spookylist">
    <tr>
        <th>Teacher's code</th>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Teacher's field</th>
        <th>Teaching subject</th>
    </tr>
@foreach($teachers as $teacher)
<tr>
<td><a href="{{url('teacher-view',['code' => $teacher['code']])}}">{{$teacher['code']}}</a></td>
<td>{{$teacher['t_firstname']}}</td>
<td>{{$teacher['t_lastname']}}</td>
<td>{{$teacher['t_special']}}</td>
<td>{{$teacher['subject_id']}}</td>
</tr>
@endforeach
</table>
<nav class="spookypagin"><center>{{ $teachers->withQueryString()->links() }}</center></nav>
@endsection