@extends('layouts.dash')
@section('title')
Single Post
@endsection
@section('dash_sect')
<div class="media border p-3">
  <img src="https://images.maskworld.com/is/image/maskworld/bigview/john-doe-foam-latex-mask--mw-117345-1.jpg" alt="John Doe" class="mr-3 mt-3 rounded-circle" height="400px" width="700px">
  <div class="media-body">
    <h4 style="color: #79afa5;font-family: verdana;"> {{$post->title}} <small><i>Posted on {{$post->created_at->format('d.m.Y')}} By {{$user->name}}</i></small></h4>
    <p>{{$post->content}}</p>
  </div>
</div>
@if(Auth::user()->id == $post->user_id)
<ul style="list-style: none;display: -webkit-inline-box"> 
<li><button type="button" class="btn btn-primary"><a id="editbar" href="{{ url('/posts') }}/{{$post->id}}/edit">Edit</a></button></li>
	<li><form action="{{ route('posts.destroy',$post->id) }}" method="post">
	@csrf
	{{method_field('DELETE')}}
	<button type="submit" class="btn btn-danger">Delete Post</button>
</form></li>
  </ul>
@endif
<div class="row">
	<div class="col-sm-6">	
		@if($countcom == 0)
			<h3>No comment</h3>				
		@elseif($countcom == 1)
			<h3>1 comment</h3>
		@else
		<h3>All comments({{$countcom}})</h3>
		<br> <br>
		@endif
		@foreach($comment as $cm)
		<div class="well">
			<div>
				<h5 style="color: #0739af;font-family: verdana;">{{$cm->commenter}}</h5>
			</div>
		<div>{{$cm->body}}</div>
		<small>{{$cm->created_at->diffForHumans()}}</small></div>
		@endforeach
		<form action="{{$post->id}}/comment" method="post">
			@csrf
			<div class="form-group">
  				<label for="comment">Add Comment</label>
  				<textarea name="comment" class="form-control" rows="3" placeholder="write a comment..." id="comment"></textarea>
			</div>
			<button type="submit" class="btn btn-primary btn-sm">Post</button>
		</form>
	</div>
</div>
@stop