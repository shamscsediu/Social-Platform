<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Friend;
use App\User;
use DB;

class FriendsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(User $uinfo) {
    	$prf = User::find($uinfo->id)->profile()->first();
		return view('friend.show',compact('uinfo','prf'));
    }
    public function find_friend_index() {
        $auth = Auth::user();
        // People you may know
        $all_user = User::where('id', '!=', $auth->id)->get();
        $associated_friends = Friend::where(function ($query) {
                                $auth = Auth::user();
                                $query->where('sender_id', $auth->id)
                                    ->orWhere('receiver_id', $auth->id);
                            })
                            ->whereIn('status', [0, 1])
                            ->get();
        $mayknow = array();
        foreach($all_user as $user){
            if($this->searchForId($user->id, $associated_friends)){
                array_push($mayknow,$user);
            }
        }
        $requests = Friend::where([
            ['receiver_id',$auth->id],
            ['status','0']
        ])->simplePaginate(2 , ['*'], 'req'); 
        $friends = DB::table('friends')
                    ->where(function ($query) {
                        $auth = Auth::user();
                        $query->where('sender_id', $auth->id)
                            ->orWhere('receiver_id', $auth->id);
                    })
                    ->where('status', 1)
                    ->get();                
    	return view('friend.friends',compact('requests','auth','friends','mayknow'));
    }
    public function searchForId($id, $array) {
        foreach ($array as $key => $val) {
            if ($val['sender_id'] == $id || $val['receiver_id'] == $id) {
                return null;
            }
        }
        return $id;
     }
    public function search_friends(Request $request) {
    	$input = $request->get('f_search');
    	$users = DB::table('users')
                ->where('name', 'like', '%'.$input.'%')
                ->simplePaginate(3);;
         
        return view('friend.s_result',compact('users','input'));
    }
    //sendeing friend requests
    public function send_req(Request $request) {
        sleep(1.5);
        $rid = $request->uid;
        $sid = Auth::user()->id;

        $req = Friend::updateOrCreate([
                'sender_id' => $sid,
                'receiver_id' => $rid],[
                'status' => 0,
        ]);
        return response()->json($req);
    }
    //cancelling friend requests
    public function cancel_req(Request $request) {
        sleep(1.5);
        $rid = $request->uid;
        $sid = Auth::user()->id;
        $query = Friend::where([
        ['sender_id',$sid ],
        ['receiver_id',$rid],
    ])->delete();
        return response()->json($query);
    }
    //accepting friend requests
    public function con_req(Request $request) {
        $c_sender_id = $request->c_id;
        $authid = Auth::user()->id;
        $query_con = Friend::where([
            ['sender_id', $c_sender_id],
            ['receiver_id',$authid]
        ])->update([
            'status' => 1
        ]);
        return response()->json($query_con);
    }
    //rejecting friend requests
    public function rej_req(Request $request) {
        $r_sender_id = $request->r_id;        
        $authid = Auth::user()->id;
        $query_rej = Friend::where([
            ['sender_id',$r_sender_id],
            ['receiver_id', $authid]
        ])->update([
            'status' => 2,
        ]);
        return response()->json($query_rej);
    }
    public function unfrnd(Request $request) {
        $unid = $request->id_unfriend;
        $auth = Auth::user();
        $query_un = Friend::where([['sender_id', $unid],['receiver_id', $auth->id]])
        ->orWhere([['sender_id', $auth->id],['receiver_id', $unid]])
        ->update(['status' => 3]);
        return response()->json($query_un);
    }

}
