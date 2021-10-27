@extends('layouts.main')

@section('header', $title)

@section('content')

@include('sweetalert::alert')
<form action="{{ route('course.create') }}" method="post">
@csrf

<table>

<tr>
<td><strong>Code</strong></td>
<td class="blue">::</td>
<td><input type="text" name="code" /></td>
</tr>

<tr>
<td><strong>Course Name</strong></td>
<td class="blue">::</td>
<td><input type="text" name="name" /></td>
</tr>

<tr>
<td><strong>Subject</strong></td>
<td class="blue">::</td>
<td>
<select name="subjects_code">
    <option>-- Plese select subject --</option>

                @foreach($subjects as $subject)

                <option value="{{$subject->code}}">[{{$subject->code}}] {{$subject->sub_name}}</option>

                @endforeach
            </select>
</td>
</tr>

<tr>
<td><strong>Teacher code</strong></td>
<td class="blue">::</td>
<td><input type="text" name="teacher_id" /></td>
</tr>

<tr>
<td valign="top"><strong>Course description</strong></td>
<td valign="top" class="blue">::</td>
<td><textarea name="course_des" cols="80" rows="10"></textarea>



</table>

<input type="submit" value="Create" class="submit">

</form>

@endsection