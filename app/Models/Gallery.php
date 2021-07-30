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
    //投稿
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
    //ギャラリー取得
    public function getGallery(Int $gallery_id)
    {
        return $this->with('user')->where('id',$gallery_id)->first();
    }
    //ギャラリー編集
    public function getEditGallery(Int $user_id, Int $gallery_id)
    {
        return $this->where('user_id', $user_id)->where('id', $gallery_id)->first();
    }
    //編集
    public function galleryUpdate(Array $data)
    {
        $this::where('id', $this->id)
            ->update([
                'title'       => $data['title'],
                'explanation' => $data['explanation'],
                'area'        => $data['areaName']
            ]);
        
        return;
    }
    //削除
    public function galleryDestroy(Int $user_id, Int $gallery_id)
    {
        return $this->where('user_id', $user_id)->where('id', $gallery_id)->delete();
    }
    //area変換
    public function getAreaNameAttribute()
    {
        return config('area.'.$this->area);
    }
}
