@extends('layouts.main')

@section('header', $title)

@section('content')

@include('sweetalert::alert')
<form action="{{ route('teacher.update', ['teacher' => $teacher->code,]) }}" method="post">
@csrf

<table>

<tr>
<td><strong>Code</strong></td>
<td class="blue">::</td>
<td><input type="text" name="code" value="{{ old('code', $teacher->code) }}" /></td>
</tr>

<tr>
<td><strong>First name</strong></td>
<td class="blue">::</td>
<td><input type="text" name="t_firstname" value="{{ old('t_firstname', $teacher->t_firstname) }}"/></td>
</tr>

<tr>
<td><strong>Last name</strong></td>
<td class="blue">::</td>
<td><input type="text" name="t_lastname" value="{{ old('t_lastname', $teacher->t_lastname) }}"/></td>
</tr>

<tr>
<td><strong>Teacher's field</strong></td>
<td class="blue">::</td>
<td><input type="text" name="t_special" value="{{ old('t_special', $teacher->t_special) }}"/></td>
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
</table>

<input type="submit" value="Update" class="submit">

</form>

@endsection