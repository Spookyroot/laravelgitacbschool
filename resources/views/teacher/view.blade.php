@extends('layouts.main')

@section('header', 'Our teachers')
@section('content')

<nav class="spookynew">
    <ul>@can('update', \App\Models\Teacher::class)
<li><a href="{{route('teacher.update-form', [
'teacher' => $teacher->code,
])}}">Update</a></li>
@endcan

@can('delete', \App\Models\Teacher::class)
<li><a href="{{route('teacher.delete', [
'teacher' => $teacher->code,
])}}">Delete</a></li>
@endcan</ul>

</nav>

<table class="spookylist">
    <tr>
        <td><b>Code ::</b></td>
        <td><span>{{ $teacher['code'] }}</span><br/></td>
    </tr>
    <tr>
        <td><b>Name ::</b></td>
        <td><span>{{ $teacher['t_firstname'] }}</span> <span>{{ $teacher['t_lastname'] }}</span><br/></td>
    </tr>
    <tr>
        <td><b>Teacher's specialize field ::</b></td>
        <td><span>{{ $teacher['t_special'] }}</span><br/></td>
    </tr>
    <tr>
        <td><b>Teaching subject ::</b> </td>
        <td>
<span>{{ $teacher['subject_id'] }}</span></td>
    </tr>

</table>
@endsection

