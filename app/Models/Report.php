<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }
    
    public function reportStore(Int $user_id, Array $data)
    {
        $this->user_id = $user_id;
        $this->comment_id = $data['comment_id'];
        $this->name = $data['name_category'];
        $this->text = $data['text'];
        $this->save();
        
        return;
    }
    
    public function getReport(Int $comment_id)
    {
        return $this->with('user')->where('comment_id', $comment_id)->get();
    }
    
    public function isReport(Int $user_id, Int $comment_id)
    {
        return $this->where('user_id', $user_id)->where('comment_id', $comment_id)->first();
    }
    
    public function reportDestroy(Int $report_id)
    {
        return $this->where('id', $report_id)->delete();
    }
    
    //name変換
    public function getNameCategoryAttribute()
    {
        return config('report.'.$this->report);
    }
}
