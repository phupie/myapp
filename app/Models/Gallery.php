<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gallery extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'explanation',
        'img_path',
        'title',
        'area'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }
    
    public function commnets()
    {
        return $this->hasMany(Comment::class);
    }
    
    public function galleryStore(Int $user_id, Array $data)
    {
        $this->user_id = $user_id;
        $this->title = $data['title'];
        $this->explanation = $data['explanation'];
        $this->area = $data['areaName'];
        
        $path = $data['img']->store('public/image/');
        $this->img_path = basename($path);
        $this->save();
        
        return;
    }
    
    public function getAreaNameAttribute()
    {
        return config('area.'.$this->area);
    }
}
