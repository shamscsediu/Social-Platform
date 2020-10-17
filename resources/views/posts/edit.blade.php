@extends('layouts.dash')
@section('title')
Edit Post
@endsection
@section('dash_sect')
<div class="row">
  <div class="col-sm-4">    
  </div>
  <div class="col-sm-6">
    @if(Auth::user()->id == $post->user_id) 
     <form action="{{ route('posts.update',$post->id) }}" method="post">
    	{{method_field('PATCH')}}
      @csrf
  <div class="form-group">
    <label for="title">Title</label>
    <input type="text" name="title" class="form-control" id="title" value="{{$post->title}}">
  </div>
  <div class="form-group">
    <label for="content">Content</label>
    <textarea class="form-control" name="content" id="content"> {{$post->content}}</textarea>
  </div>
  <ul style="list-style: none;display: -webkit-inline-box">
  	<li><button type="submit" class="btn btn-primary">Update</button></form></li>
  	<li><form action="{{ route('posts.destroy',$post->id) }}" method="post">
	@csrf
	{{method_field('DELETE')}}
	<button type="submit" class="btn btn-danger">Delete Post</button>
</form></li>
  </ul>


@else
<div class="well">
	<div class="h1">Sorry,Requested Page Could'nt found</div>
</div>
@endif
  </div>
</div> 
@stop