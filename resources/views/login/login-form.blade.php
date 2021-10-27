<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{asset('/css/login.css')}}">
</head>
<body>
<div class='bold-line'></div>
<div class='container'>
  <div class='window'>
    <div class='overlay'></div>
    <div class='content'>
<header class="welcome">
<h1>ABC School Login</h1>
</header>

<main>
<form action="{{route('authenticate') }}" method="post" class="login">
@csrf
<table>

<tr>

<td><input type="text" name="email" required class="input-line full-width" placeholder='Email'/></td>
</tr>

<tr>

<td><input type="password" name="password" required class="input-line full-width" placeholder='Password'/></td>
</tr>

</table>


<br/>
<center><button type="submit" class='ghost-round full-width'>Login</button></center>
</form>
@include('sweetalert::alert')
@error('credentials')
<br>
@enderror
</main>
</div>
</div>
</div>
</html>