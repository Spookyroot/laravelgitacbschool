@extends('layouts.main')

@section('header', $title)

@section('content')

@include('sweetalert::alert')
<form action="{{ route('teacher.create') }}" method="post">
@csrf

<table>

<tr>
<td><strong>Code</strong></td>
<td class="blue">::</td>
<td><input type="text" name="code" /></td>
</tr>

<tr>
<td><strong>First name</strong></td>
<td class="blue">::</td>
<td><input type="text" name="t_firstname" /></td>
</tr>

<tr>
<td><strong>Last name</strong></td>
<td class="blue">::</td>
<td><input type="text" name="t_lastname" /></td>
</tr>

<tr>
<td><strong>Teacher's field</strong></td>
<td class="blue">::</td>
<td><input type="text" name="t_special" /></td>
</tr>

<tr>
<td><strong>Subject</strong></td>
<td class="blue">::</td>
<td>
<select name="subject_id">
    <option>-- Plese select subject --</option>

                @foreach($subjects as $subject)

                <option value="{{$subject->code}}">[{{$subject->code}}] {{$subject->sub_name}}</option>

                @endforeach
            </select>
</td>
</tr>
</table>

<input type="submit" value="Create" class="submit">

</form>

@endsection