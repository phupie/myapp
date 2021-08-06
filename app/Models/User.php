<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
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
        'name', 'email', 'password',
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
    //リレーション
    public function followers()
    {
        return $this->belongsToMany(self::class, 'followers', 'followed_id', 'following_id');
    }
    
    public function follows()
    {
        return $this->belongsToMany(self::class, 'followers', 'following_id', 'followed_id');
    }
    
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }
    //フォロー
    public function follow(Int $user_id)
    {
        return $this->follows()->attach($user_id);
    }
    //フォロー解除
    public function unfollow(Int $user_id)
    {
        return $this->follows()->detach($user_id);
    }
    //フォローしてるか
    public function isFollowing(Int $user_id)
    {
        return (boolean) $this->follows()->where('followed_id', $user_id)->first(['id']);
    }
    //フォローされているか
    public function isFollowed(Int $user_id)
    {
        return (boolean) $this->followers()->where('following_id', $user_id)->first(['id']);
    }
    //ユーザー全件取得
    public function getAllUsers(Int $user_id)
    {
        return $this->with('profile')->where('id', '<>', $user_id)->paginate(5);
    }
}
