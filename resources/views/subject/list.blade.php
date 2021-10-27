@extends('layouts.main')

@section('header',' Our Subject')
@section('content')

<nav nav class="spookynew">
<ul>
@can('create', \App\Models\Subject::class)
<li>
<a href="{{ route('subject.create-form') }}">New Subject</a>
</li>
@endcan
</ul>
</nav>

<table class="spookylist">
    <tr>
        <th>Subject Code</th>
        <th>Subject</th>
    </tr>
@foreach($subjects as $subject)
<tr>
<td><a href="{{url('subject-view',['code' => $subject['code']])}}">{{$subject['code']}}</a></td>
<td>{{$subject['sub_name']}}</td>
</tr>
@endforeach
</table>
@endsection