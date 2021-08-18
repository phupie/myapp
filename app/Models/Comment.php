<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'text'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function commentStore(Int $user_id, Array $data)
    {
        $this->user_id = $user_id;
        $this->gallery_id = $data['gallery_id'];
        $this->text = $data['text'];
        $this->save();
        
        return;
    }
    
    public function getComment(Int $comment_id)
    {
        return $this->with('user')->where('id', $comment_id)->first();
    }
    
    public function getComments(Int $gallery_id)
    {
        return $this->with('user')->where('gallery_id', $gallery_id)->get();
    }
}
