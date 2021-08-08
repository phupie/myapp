<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    public $timestamps = false;
    //いいねしてるか
    public function isFavorite(Int $user_id, Int $gallery_id)
    {
        return (boolean) $this->where('user_id', $user_id)->where('gallery_id', $gallery_id)->first();
    }
    //いいねする
    public function storeFavorite(Int $user_id, Int $gallery_id)
    {
        $this->user_id = $user_id;
        $this->gallery_id = $gallery_id;
        $this->save();
    }
    //いいね解除
    public function destroyFavorite(Int $favorite_id)
    {
        return $this->where('id', $favorite_id)->delete();
    }
}
