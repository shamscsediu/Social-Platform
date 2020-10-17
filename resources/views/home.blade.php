@extends('layouts.dash')
@section('title')
Welcome to Dashboard
@endsection
@section('script_head')
<link rel="stylesheet" href="{{url('public/dash/h_style.css')}}">
@stop
@section('dash_sect')
<div class="row wrapper">
	<div class="col-sm-6">
@if(!$posts->isEmpty())
@foreach($posts as $post) 
<div class="well">
                <div class="media">
                    <a class="pull-left" href="single.php"><img src="" width="35%" height="40%"/></a>
                  <div class="media-body">
                        <h4 class="media-heading"><a href="{{url('')}}/posts/{{$post->id}}">{{$post->title}}</a></h4>

                      <p class="text-right">
                         
                        </p>
                            <p>
                              {{$post->content}}
                            </p>
                              
                        <ul class="list-inline list-unstyled">
                            <li> <span>
                            </span></li>
                            <li>|</li>
                            <span><i class="glyphicon glyphicon-comment"></i>  comments</span>
                            <li>|</li>
                            <li>
                                <!-- Use Font Awesome http://fortawesome.github.io/Font-Awesome/ -->
                                <span><i class="fab fa-facebook-square"></i></span>
                                <span><i class="fab fa-twitter-square"></i></span>
                            </li>
                            <li>{{$post->created_at->diffForHumans()}}</li>
                        </ul>
                    </div>
                </div>
                </div>
  @endforeach
  @else
  <p>No post to show</p>
  @endif
		
	</div>
</div>
@endsection
