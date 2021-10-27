@extends('layouts.main')

@section('header',' Our Course')
@section('content')

<form action="{{ route('course.list') }}" method="get" class="search-form">
<div>
<table>

    <tr>
<td class="table-label"><label for="cmp-search"><strong>Search</strong></label></td>
<td class="table-sep"><label class="table-sep">::</label></td>
<td><input id="cmp-search" type="text" name="term" value="{{ $search['term'] }}" class="searchbox"/></td>
<td class="table-submit"></td>
<td><input type="submit" value="Search" class="accent"></td>
<td><a href="{{ route('course.list') }}">
<button type="button" class="accent">Clear</button>
</a></td>
<td></td>
</tr>
</table>
</form>

<nav class="spookynew">
<ul>
@can('create', \App\Models\Course::class)
<li>
<a href="{{route('course.create-form')}}">New Course</a>
</li>
@endcan
</ul>
</nav>

<table class="spookylist">
    <tr>
        <th>Course Code</th>
        <th>Course Name</th>
        <th>Course Subject</th>
        <th>Course Teacher</th>
    </tr>
@foreach($courses as $course)
<tr>
<td><a href="{{url('course-view',['code' => $course['code']])}}">{{$course['code']}}</a></td>
<td>{{$course['name']}}</td>
<td><a href="{{url('subject-view',['code' => $course['subjects_code']])}}">{{$course['subjects_code']}}</a></td>
<td><a href="{{url('teacher-view',['code' => $course['teacher_id']])}}">{{$course['teacher_id']}}</a></td>
</tr>
@endforeach
</table>
<nav class="spookypagin"><center>{{ $courses->withQueryString()->links() }}</center></nav>

@endsection