@extends('layouts.dash')
@section('title')
Update your profile
@stop
@section('script_head')
<link rel="stylesheet" href="{{url('public/dash/profile/edit_styler.css')}}">
@stop
@section('dash_sect')
 @if(Auth::user()->id == $profile->user_id)
<div class="row" id="main">
        <div class="col-md-4 well" id="leftPanel">
            <div class="row">
                <div class="col-md-12">
                	<div>
        				<img src="{{ asset('/public/storage/'.Auth::user()->image)}}" alt="Profile Picture" class="img-circle img-thumbnail">
        				<!-- Button trigger modal -->
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
							  Upload Profile photo
							</button>

							<!-- Modal -->
							
							<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
							  <div class="modal-dialog modal-dialog-centered" role="document">
							  	<form id="proform" method="POST" action="{{ route('propic') }}" enctype="multipart/form-data">						
							                @csrf
								    <div class="modal-content">
								      <div class="modal-header">
								        <h3 class="modal-title" id="exampleModalLongTitle">Upload profile picture</h3>
								        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								          <span aria-hidden="true">&times;</span>
								        </button>
								      </div>
								      <div class="modal-body">									
							                <div class="form-group">
							                    <input name="pr" type="file" class="form-control"><br/>
							                    <div class="progress">
							                        <div class="bar"></div >
							                        <div class="percent">100%</div>
							                    </div>
							                    <br>
							                </div>
							           		<div class="success">Uploaded Successfully</div>
								      </div>
								      <div class="modal-footer">
								        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
								        <button type="submit" id="prosubmit" name="upload" class="btn btn-primary">Upload</button>						        
								      </div>
								    </div>
							     </form> 
							  </div>
							</div>							        				 
        				<h2>Gopinath Perumal</h2>
        				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        				tempor incididunt ut labore et dolore magna aliqua.</p>
                        <div class="btn-group">
                            <button type="button" class="btn btn-warning">
                                Social</button>
                            <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
                                <span class="caret"></span><span class="sr-only">Social</span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Twitter</a></li>
                                <li><a href="https://plus.google.com/+Jquery2dotnet/posts">Google +</a></li>
                                <li><a href="https://www.facebook.com/jquery2dotnet">Facebook</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Github</a></li>
                            </ul>
                        </div>
        			</div>
        		</div>
            </div>
        </div>
        <div class="col-md-8 well" id="rightPanel">
            <div class="row">
    <div class="col-md-12">
    	<form action="{{ route('profile.update',$profile->id) }}" method="post">
    		{{method_field('PATCH')}}
    		@csrf
    		<input type="hidden" value="{{$profile->id}}" name="id">
			<h2>Update your profile.<small>It's always easy</small></h2>
			<hr class="colorgraph">
			<div class="row">
				<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="form-group">
						<label for="full_name">Full Name</label>
                        <input type="text" name="full_name" value="{{$profile->full_name}}" id="full_name" class="form-control input-lg" placeholder="Full Name" tabindex="1">
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="form-group">
						<label for="date_of_birth">Date of Birth</label>
						<input type="date" name="date_of_birth" value="{{$profile->Dateofbirth}}" id="date_of_birth" class="form-control input-lg" placeholder="Date of Birth" tabindex="2">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="form-group">
						<label for="religion">Religion</label>
                        <input type="text" name="religion" id="religion" class="form-control input-lg" value="{{$profile->Religion}}" placeholder="Your Religion" tabindex="1">
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="form-group">
						<label for="school">School Name</label>
						<input type="text" name="school" id="school" class="form-control input-lg" value="{{$profile->school}}" placeholder="Your School" tabindex="2">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="form-group">
						<label for="college">College Name</label>
                        <input type="text" name="college" id="college" class="form-control input-lg" value="{{$profile->college}}" placeholder="Your College" tabindex="1">
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="form-group">
						<label for="university">University Name</label>
						<input type="text" name="university" id="university" class="form-control input-lg" value="{{$profile->university}}" placeholder="Your University" tabindex="2">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="form-group">
						<label for="work">Work at</label>
                        <input type="text" name="work" id="work" class="form-control input-lg" value="{{$profile->works_at}}" placeholder="Name of your Work" tabindex="1">
					</div>
				</div>
			</div>
			<hr class="colorgraph">
			<div class="row">
				<div class="col-xs-12 col-md-6"></div>
				<div class="col-xs-12 col-md-6"><button type="submit" class="btn btn-success btn-block btn-lg">Update</button></div>
			</div>
		</form>
	</div>
</div>
 @else
 <div class="well">
	<div class="h1">Sorry,Requested Page Could'nt found</div>
</div>
@endif
@section('script_footer')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>
<script src="{{url('public/dash/profile/pr-sc.js')}}"></script>
@stop
@stop