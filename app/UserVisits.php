<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserVisits extends Model
{
    protected $fillable = ['user_id', 'feature'];
}
