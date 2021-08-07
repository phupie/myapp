<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Comment extends Model
{
    use softDeletes;
    
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
}
