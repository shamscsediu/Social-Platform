@extends('layouts.dash')
@section('title')
Search Results
@stop
@section('script_head')
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">

<link rel="stylesheet" href="{{url('public/dash/friends/f_style.css')}}">
@stop
@section('dash_sect')


<div class="row">
	<div class="col-sm-4"></div>
                       <div class="col-sm-6">
                         <h3>Search Results for '{{$input}}'</h3>
                         <h5 class="font-weight-light">   {{$users->count()}} people found</h5>
                           @foreach($users as $user)
                           <div class="wrap_all_f">
                           <div class="col-sm-2">
                               <a href="{{ url('/friend/'.$user->id) }}"><img class="img-thumbnail" src="{{ asset('/public/storage/'.$user->image)}}" alt="ffff"></a>
                           </div>
                           <div class="col-sm-4">
                               <a href="{{ url('/friend/'.$user->id) }}"><span>{{$user->name}}</span></a>
                               <h5 id="add_f"><button class="btn btn-primary">Add friend</button></h5>
                           </div>
                       </div>
                       @endforeach
                        <div class="pagint">
                            {{$users->links()}}
                        </div> 
                       </div>
                       <div class="col-sm-2"></div>

                </div>

@stop
