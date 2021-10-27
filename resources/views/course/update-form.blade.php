@extends('layouts.main')

@section('header', $title)

@section('content')


<form action="{{ route('course.update', ['course' => $course->code,]) }}" method="post">
@csrf
<table>
    <tr>
<td><strong>Code</strong></td>
<td class="blue">::</td>
<td><input type="text" name="code" value="{{ old('code', $course->code) }}"
    required/><td>
</tr>

<tr>
<td><strong>Course Name</strong></td>
<td class="blue">::</td>
<td><input type="text" name="name" value="{{ old('name', $course->name) }}"
    required/></td>
</tr>

<tr>
<td><strong>Subject</strong></td>
<td class="blue">::</td>
<td>
<select name="subjects_code">
    <option>-- Plese select subject --</option>

                @foreach($subjects as $subject)

                <option value="{{ old('subjects_code', $subject->subjects_code) }}">[{{$subject->code}}] {{$subject->sub_name}}</option>

                @endforeach
            </select>
</td>
</tr>

<tr>
<td class="adress" valign="top"><strong>Description</strong></td>
<td valign="top" class="blue">::</td>
<td>
<textarea name="description" cols="80" rows="10" required>{{ old('course_des', $course->course_des) }}</textarea>
</td>
</tr>

<tr>

</table>

<input type="submit" value="Update" class="submit">

</form>
@include('sweetalert::alert')
@endsection