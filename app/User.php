<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;
use Laravolt\Avatar\Facade as Avatar;


class User extends Authenticatable
{
    use LaratrustUserTrait;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name' , 'email', 'password', 'image'
    ];

    protected $appends = ['image_path'];

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

    // function to return the first name and last name
    public function the_name(){
        return $this->first_name.' '.$this->last_name;
    }

    // function for create avatar of user from first name and last name
    public function avatar(){

        $username = $this->first_name.' '.$this->last_name;
        $avatar = 'user dev';
        if($username){
            $avatar = Avatar::create($username)->toBase64();
        }

        return $avatar;

    }

    // fuction for the capitalize the first name and last name
    public function getFirstNameAttribute($value){
        return ucfirst($value);
    }

    public function getLastNameAttribute($value){
        return ucfirst($value);
    }

    public function getImagePathAttribute(){
       return asset('public/assets/backend/images/users/'.$this->image);
    }

}
