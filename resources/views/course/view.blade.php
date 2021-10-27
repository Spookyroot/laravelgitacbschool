@extends('layouts.main')

@section('header', 'Our Courses')
@section('content')

<nav class="spookynew">
    <ul>@can('update', \App\Models\Course::class)
<li><a href="{{route('course.update-form', [
'course' => $course->code,
])}}">Update</a></li>
@endcan

@can('delete', \App\Models\Course::class)
<li><a href="{{route('course.delete', [
'course' => $course->code,
])}}">Delete</a></li>
@endcan</ul>

</nav>


<table class="spookylist">
<tr>
    <td><b>Code ::</b></td>
    <td><span>{{ $course['code'] }}</span><br /></td>
</tr>
<tr>
    <td><b>Name ::</b></td>
    <td><span>{{ $course['name'] }}</span><br /></td>
</tr>
<tr>
    <td><b>Subject ::</b></td>
    <td><span>{{ $course['subjects_code'] }}</span><br /></td>
</tr>
</table>

<table class="spookylist"><tr><td><pre>{{ $course['course_des']}}</pre></td></tr></table>
<p>








@endsection