@extends('layouts.main')

@section('header',' Home')

@section('content')

<body >
    <table class="homepic">
        <tr>
        <img src="{{url('/images/welcome.png')}}" alt="Image"/>
        </tr>
    </table>

</body>
@endsection