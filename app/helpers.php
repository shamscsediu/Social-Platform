<?php
use App\Friend;
use App\User;
function get_friend_status($u) {
	$query = Friend::where([
		['sender_id',Auth::user()->id],
		['receiver_id',$u],
	])->first();
	return $query;
}
function get_req_count() {
	$query = Friend::where([
		['receiver_id',Auth::user()->id],
		['status',0]
	])->get();
	$nmbr_of_req = count($query);
	if($nmbr_of_req != 0){
		return $nmbr_of_req;
	}
	
}
function get_friend_profile($id){
	return User::where('id', $id)->get()[0];
}
function cvf_convert_object_to_array($data) {

    if (is_object($data)) {
        $data = get_object_vars($data);
    }

    if (is_array($data)) {
        return array_map(__FUNCTION__, $data);
    }
    else {
        return $data;
    }
}
function get_mutual_friend($id) {
	$current = DB::table('friends')
				->select('sender_id', 'receiver_id')
				->where('sender_id', $id)
				->orWhere('receiver_id', $id)
				->where('status', 1)
				->get();
	$myfriends = DB::table('friends')
				->select('sender_id', 'receiver_id')
				->where(function ($query) {
					$auth = Auth::user();
					$query->where('sender_id', $auth->id)
						->orWhere('receiver_id', $auth->id);
				})
				->where('status', 1)
				->get();
	$current = json_decode(json_encode($current),true);
	$myfriends = json_decode(json_encode($myfriends),true);
	foreach($current as $key => $val) {
		for($i=0;$i< count($myfriends);$i++) {
			if(($val['sender_id'] == $myfriends[$i]['sender_id']) || ($val['sender_id'] == $myfriends[$i]['receiver_id']) || ($val['receiver_id'] == $myfriends[$i]['sender_id']) || ($val['receiver_id'] == $myfriends[$i]['receiver_id'])) {
				return array($val['sender_id']);
			}else {
				return null;
			}
		}
	}
}
?>