<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Favorite;
use Illuminate\Database\Eloquent\SoftDeletes;
use Storage;
use Image;

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
    
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    
    public function reports()
    {
        return $this->hasMany(Report::class);
    }
    
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'gallery_tag');
    }
    
    //投稿
    public function galleryStore(Int $user_id, Array $data)
    {
        
        $this->user_id = $user_id;
        $this->title = $data['title'];
        $this->explanation = $data['explanation'];
        $this->area = $data['areaName'];
        
        // 画像の拡張子を取得
        $extension = $data['img']->getClientOriginalExtension();
        // 画像の名前を取得
        $filename = $data['img']->getClientOriginalName();
        // 画像をリサイズ
        $resize_img = Image::make($data['img'])
        ->resize(1080, null, function ($constraint) {
            $constraint->aspectRatio();
        })
        ->encode($extension);
        $path = Storage::disk('s3')->put('/uploads/'.$filename,(string)$resize_img,'public');
        $this->img_path = Storage::disk('s3')->url('uploads/' .$filename);
        $this->save();
        
        
        return;
    }
    //ギャラリー取得
    public function getGallery(Int $gallery_id)
    {
        return $this->withCount('favorites')->with('user')->where('id',$gallery_id)->first();
    }
    //ユーザーギャラリー取得
    public function getUserTimeLine(Int $user_id)
    {
        return $this->withCount('favorites')->where('user_id',$user_id)->orderBy('created_at', 'DESC')->paginate(20);
    }
    //ストーリーに応じたギャラリー取得
    public function getProfileTimeLine(Int $story_num)
    {
        return $this->withCount('favorites')->where('area', '<=', $story_num)->orderBy('created_at', 'DESC')->paginate(20);
    }
    //フォローユーザーギャラリー取得
    public function getTimeLines(Int $user_id, Array $follow_ids)
    {
        $follow_ids[] = $user_id;
        return $this->withCount('favorites')->whereIn('user_id',$follow_ids)->orderBy('created_at', 'DESC')->paginate(20);
    }
    //ユーザーギャラリー数
    public function getGalleryCount(Int $user_id)
    {
        return $this->where('user_id',$user_id)->count();
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
    //いいねされているか
    public function isFavorited($user): bool 
    {
        return Favorite::where('user_id', $user->id)->where('gallery_id', $this->id)->first() !==null;
    }
    //area変換
    public function getAreaNameAttribute()
    {
        return config('area.'.$this->area);
    }
}
