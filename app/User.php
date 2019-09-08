<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','is_a'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public  function image()
    {
        return $this->morphOne('App\Image', 'imageable');
    }

    public function  userInformation()
    {
        return $this->hasOne('App\CompanyInformation' , 'user_id');
    }
    public function item()
    {
        return $this->hasMany('App\Item' ,'user');
    }

    public static function creatCompany(array $data)
    {
        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'is_a' => 2,
        ]);
    }

    public static function deleteUserReservation($id)
    {
        DB::table('notifications')->delete($id);
    }

}
