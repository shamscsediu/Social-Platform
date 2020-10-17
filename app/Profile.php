<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['full_name', 'Dateofbirth', 'Religion', 'school','college','university','works_at'];
}
