<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('header')</title>
    <link rel="stylesheet" href="{{asset('/css/style.css')}}">
</head>
<body>
    <div class="overlay">
<header>
<h1>ABC School -  @yield('header')</h1>
</header>



@include('sweetalert::alert')

<nav class="mainnav">
    <ul>
<li><a href="{{url('home')}}">Home</a></li>
<li><a href="{{url('course')}}">Our Courses</a></li>
<li><a href="{{url('subject')}}">Subjects</a></li>
<li><a href="{{url('teacher')}}">Our Teachers</a></li>


@can('list', \App\Models\User::class)
<li><a href="{{url('user')}}">User</a></li>
@endcan

<li class="spookyuser">@auth
<span>{{ \Auth::user()->name }}</span>
<a href="{{url('auth/logout')}}">Logout</a> 
@endauth</li>
</nav>



@if(session()->has('status'))
<div class="status">
<span class="info">{{session()->get('status') }}</span>
</div>
@endif

<main>
@yield('content') 
</main>
</div>
</body>
</html>