@extends('layouts.dash')
@section('title')
Friends
@stop
@section('script_head')
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">

<link rel="stylesheet" href="{{url('public/dash/friends/f_style.css')}}">
@stop
@section('dash_sect')
<div class="row justify-content-center">
   <div class="col-12 col-sm-10 col-lg-8">
      <form action="{{ route('search_friend') }}" class="card card-sm" method='get'>
         @csrf                                                      
         <div class="card-body row no-gutters align-items-center">
            <div class="col-auto">
               <i class="fas fa-search h4 text-body"></i>
            </div>
            <!--end of col-->
            <div class="col">
               <input class="form-control form-control-lg form-control-borderless" name="f_search" type="search" placeholder="Find friends on social">
            </div>
            <!--end of col-->
            <div class="col-auto">
               <button class="btn btn-lg btn-success" type="submit">Search</button>
            </div>
            <!--end of col-->
         </div>
      </form>
      <?php $i = 5; get_mutual_friend($i); ?>
     <!--  <div class="card">
        <div class="card-body">
           <div class="wrap_all_f">
              <div class="col-sm-2">                                
                 <a href=""><img class="img-thumbnail" src="" alt="ffff"></a>
              </div>
              <div class="col-sm-4">Shams Hasan</a></span>
              </div>
           </div>
        </div>
     </div> -->
      <!--end of col-->
   </div>
</div>
<div class="row">
   <div class="col-sm-6">
      <h3>Friend Requests
         @if(get_req_count() != '')
         <span>({{get_req_count()}})</span>
         @endif
      </h3>
      @foreach($requests as $req)
      <div class="wrap_all_f">
         <div class="col-sm-2">
            <?php $suser = App\User::find($req->sender_id); ?>
            <a href="{{ url('/friend/'.$req->sender_id) }}"><img class="img-thumbnail" src="{{ asset('/public/storage/'.$suser->image)}}" alt="ffff"></a>
         </div>
         <div class="col-sm-4">
            <span><a href="{{ url('/friend/'.$req->sender_id ) }}">{{$suser->name}}</a></span>                           
         </div>
         <h5 id="con_f-{{$req->sender_id}}">
            <button con-data-id="{{$req->sender_id}}" class="btn btn-primary con_req" type="submit">Confirm</button>
            <button rej-data-id="{{$req->sender_id}}" class="btn btn-danger rej_req" type="submit">Reject</button>
         </h5>
      </div>
      @endforeach
      @if(get_req_count() == '')
      <span>No request found</span>
      @endif
      <div class="pagint">
         {{$requests->links()}}
      </div>
   </div>
   <div class="col-sm-6">
      <h3>People you may know</h3>
      @foreach($mayknow as $user)
      <div class="wrap_all_f">
         <div class="col-sm-2">
            <a href="{{ url('/friend/'.$user->id) }}"><img class="img-thumbnail" src="{{ asset('/public/storage/'.$user->image)}}" alt="ffff"></a>
         </div>
         <div class="col-sm-4">
            <span><a href="{{ url('/friend/'.$user->id) }}">{{$user->name}}</a></span>
            <h5 id="add_f-{{$user->id}}">
               <button data-id="{{$user->id}}" type="submit" class="btn btn-primary add_f_btn">Add friend</button>
            </h5>
         </div>
      </div>
      @endforeach
      {{-- <div class="pagint">
         {{$users->links()}}
      </div> --}}
   </div>
</div>
<div class="row">
   <div class="col-sm-6">
      <h3>Friends</h3>
      @foreach($friends as $fr)
      <?php
      if(Auth::user()->id == $fr->sender_id){
         $friend_profile = get_friend_profile($fr->receiver_id);
      }else{
         $friend_profile = get_friend_profile($fr->sender_id);
      }
      ?>
      <div class="wrap_all_f">
         <div class="col-sm-2">
            <a href="{{ url('/friend/'.$friend_profile['id']) }}"><img class="img-thumbnail" src="{{ asset('/public/storage/'.$friend_profile['image'])}}" alt="ffff"></a>     
         </div>
         <div class="col-sm-4">
            <span><a href="{{ url('/friend/'.$friend_profile['id']) }}">{{$friend_profile['name']}}</a></span>
            <h5 id="un_f-{{$friend_profile['id']}}">
               <button un-data-id="{{$friend_profile['id']}}" class="btn btn-warning un_frnd" type="submit">unfriend</button>
            </h5>
         </div>
      </div>
      @endforeach 
   </div>
</div>  
@section('script_footer')
<script>
    /*script for friend request send and cancel*/
    $(document.body).on('click', '.add_f_btn', function(){
       var id = $(this).attr("data-id");
       $('#add_f-'+id).html('<img src="{{url('public/images/loader/486.gif')}} "alt="...." width="30px" height="16px">');
       $.ajax({
          url: "{{ route('send_req') }}",
          method: 'get',
          data: {uid: id},
          success: function(res){
            $('#add_f-'+id).html('<button del_data_id="'+id+'" type="submit" class="btn btn-primary del_req">Cancel request</button>');
        }});
    });
    $(document.body).on('click', '.del_req', function(e){
       var del_id = $(this).attr('del_data_id');
       $('#add_f-'+del_id).html('<img src="{{url('public/images/loader/486.gif')}} "alt="...." width="30px" height="16px">');        
        $.ajax({
          url: "{{ route('cancel_req') }}",
          method: 'get',
          data: {uid: del_id},
          error: function (xhr, status, error) {                                                     
                console.log(xhr.responseText);
            },
          success: function(query) {
            $('#add_f-'+del_id).html('<button data-id="'+del_id+'" type="submit" class="btn btn-primary add_f_btn">Add friend</button>');
        }});
    });
   /*script for friend request accept and reject*/
   $(document.body).on('click','.con_req', function(){
        var con_id = $(this).attr('con-data-id');
        $('#con_f-'+con_id).html('<img src="{{url('public/images/loader/486.gif')}} "alt="...." width="30px" height="16px">');
        $.ajax({
            url: "{{ route('con_req') }}",
            method: 'get',
            data: {c_id: con_id},
            error: function (xhr) {
                console.log(xhr.responseText);
            },
            success: function() {
                 $('#con_f-'+con_id).html('<p class="text-success">You are now friends</p>');
            }
        });
   });
   $(document.body).on('click','.rej_req', function(){
        var rej_id = $(this).attr('rej-data-id');
        $('#con_f-'+rej_id).html('<img src="{{url('public/images/loader/486.gif')}} "alt="...." width="30px" height="16px">');
        $.ajax({
            url: "{{ route('rej_req') }}",
            method: 'get',
            data: {r_id: rej_id},
            error: function (xhr) {
                console.log(xhr.responseText);
            },
            success: function() {
                 $('#con_f-'+rej_id).html('<p class="text-danger">Rejected</p>');
            }
        });
   });
   //script for unfriend
   $(document.body).on('click','.un_frnd', function(){
        var un_id = $(this).attr('un-data-id');
        $('#un_f-'+un_id).html('<img src="{{url('public/images/loader/486.gif')}} "alt="...." width="30px" height="16px">');
        $.ajax({
            url: "{{ route('unfrnd') }}",
            method: 'get',
            data: {id_unfriend: un_id},
            error: function (xhr) {
                console.log(xhr.responseText);
            },
            success: function() {
                 $('#un_f-'+un_id).html('<p class="text-success">unfriend successfully</p>');
            }
        });
   });
   
   //script for frnd search suggestion
   
</script>
@stop
@stop