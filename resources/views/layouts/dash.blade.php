<!doctype html>
<html lang='{{ str_replace('_', '-', app()->getLocale()) }}'>
<head>
   <meta charset='utf-8'>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="csrf-token" content="{{ csrf_token() }}">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>@yield('title')</title>
   <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

   <link rel="stylesheet" href="{{url('public/dash/css/styles.css')}}">
   @yield('script_head')
   
</head>
<body>

<div id='cssmenu'>
<ul>
   <li class='active'><a href='{{url('')}}'><i class="fas fa-home">Home</i></a></li>
   <li><a href='{{url('profile')}}'><i class="fas fa-user-circle">Profile</i></a></li>
   <li><a href='{{url('posts')}}'><i class="fab fa-blogger-b">Posts</i></a></li>
   <li><a href='{{ url('friends') }}'><i class="fas fa-users">Friends
   @if(get_req_count() != '')
      <i class="fas fa-user-plus"><span style="color: black; font-size: 16px">({{get_req_count()}})</span></i>      
   @endif
   </i></a></li>
   <li><a href='#'><i class="fas fa-envelope">Messages</i></a></li>
   <li><a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt">Logout</i></a></li>
  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
      @csrf
 </form>
</ul>
</div>
<div class="container">
   @yield('dash_sect')
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="{{url('public/dash/js/script.js')}}"></script>
@yield('script_footer')
</body>
<html>
