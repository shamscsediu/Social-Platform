@extends('layouts.dash')
@section('title')
Posts
@endsection
@section('script_head')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
<link rel="stylesheet" href="{{url('/public/dash/post/post.css')}}">
@endsection
@section('dash_sect')
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
                            <li><span>{{$post->created_at->diffForHumans()}}</span></li>
                        </ul>
                    </div>
                </div>
                </div>
  @endforeach
  @else
  <h1>No post to show</h1>
  @endif
  </div>
  <div class="col-sm-6">
    <div class="col-sm-6">
    <form action="{{ route('posts.store') }}" method="post">
      @csrf
  <div class="form-group">
    <label for="title">Title</label>
    <input type="text" name="title" class="form-control" id="title" placeholder="Title">
  </div>
  <div class="form-group">
    <label for="content">Content</label>
    <textarea class="form-control" name="content" id="content" placeholder="Post body"> </textarea>
  </div>
  <button type="submit" class="btn btn-primary">Post</button>
</form>
  </div>
  </div>
</div>
@stop
@section('script_footer')
    <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>

    <!-- Bootstrap JavaScript -->
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.1/js/bootstrap.min.js"></script>

    <!-- toastr notifications -->
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <!-- icheck checkboxes -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/icheck.min.js"></script>
    <script src="{{url('public/dash/post/post.js')}}"></script>
@stop
