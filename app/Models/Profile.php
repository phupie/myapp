<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded = [
        'id',
        'user_id'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    //作成
    public function profileStore(Int $user_id, Array $data)
    {
        $path = $data['img']->store('public/profile_image/');
        $haed_path = $data['head_img']->store('public/profile_image/');
        $this->img_path = basename($path);
        
        $this::where('id', $this->id)
            ->save([
                'display_name'   => $data['display_name'],
                'main_job'       => $data['jobName'],
                'story_progress' => $data['storyName'],
                'introduction'   => $data['introduction'],
                'img_path'       => basename($path),
                'head_img_path'  => basename($head_path)
            ]);
        
        return;
    }
    //job変換
    public function getJobNameAttribute()
    {
        return config('job.'.$this->job);
    }
    //story変換
    public function getStoryNameAttribute()
    {
        return config('story.'.$this->story);
    }
}
