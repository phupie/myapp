<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    public $timestamps = false;
    
    public function user()
    {
        return $this->belongTo(User::class);
    }
    
    public function gallery()
    {
        return $this->belongTo(Gallery::class);
    }
    
    //いいねする
    public function storeFavorite(Int $user_id, Int $gallery_id)
    {
        $this->user_id = $user_id;
        $this->gallery_id = $gallery_id;
        $this->save();
    }
    //いいね解除
    public function destroyFavorite(Int $user_id, Int $gallery_id)
    {
        return $this->where('user_id', $user_id)->where('gallery_id', $gallery_id)->delete();
    }
}
