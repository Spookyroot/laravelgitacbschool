@extends('layouts.main')

@section('header', 'Subject we provided')
@section('content')

<nav class="spookynew">
    <ul>@can('update', \App\Models\Subject::class)
<li><a href="{{route('subject.update-form', [
'subject' => $subject->code,
])}}">Update</a></li>
@endcan

@can('delete', \App\Models\Subject::class)
<li><a href="{{route('subject.delete', [
'subject' => $subject->code,
])}}">Delete</a></li>
@endcan</ul>

</nav>

<table class="spookylist">
    <tr>
        <td><b>Code ::</b></td>
        <td><span>{{ $subject['code'] }}</span><br/></td>
    </tr>
    <tr>
        <td><b>Name ::</b></td>
        <td><span>{{ $subject['sub_name'] }}</span><br/></td>
    </tr>
</table>
@endsection