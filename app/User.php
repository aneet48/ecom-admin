<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'is_admin', 'api_token', 'first_name',
        'last_name',
        'phone_number',
        'branch_id',
        'university_id',
        'branch',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'api_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $append=['name'];

    public function university()
    {
        return $this->belongsTo('App\University', 'university_id');
    }

    public function unHide()
    {
        $this->hidden = [];
    }

    public function getNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    // public function getIdAttribute($value)
    // {
    //     return Crypt::encrypt($value);;
    // }
}
