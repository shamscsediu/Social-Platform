<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    protected $fillable = ['sender_id','receiver_id', 'status','is_friend'];    
    public function sender() {
    	return $this->belongsTo('App\User');
    }
}
