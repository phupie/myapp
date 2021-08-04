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
        //profile image
        $cropImageData = base64_decode(explode(",", explode(";", $data['img'])[1])[1]);

        $imagePath = '/profile_image/' . str_random(10) . '.jpeg';

        $storageImagePath = storage_path('app/public') . $imagePath;
        \file_put_contents($storageImagePath, $cropImageData);
        //header image
        $head_cropImageData = base64_decode(explode(",", explode(";", $data['head_img'])[1])[1]);

        $head_imagePath = '/profile_image/' . str_random(10) . '.jpeg';

        $head_storageImagePath = storage_path('app/public') . $head_imagePath;
        \file_put_contents($head_storageImagePath, $head_cropImageData);
        
        $this->user_id = $user_id;
        $this->display_name = $data['display_name'];
        $this->main_job = $data['jobName'];
        $this->story_progress = $data['storyName'];
        $this->introduction = $data['introduction'];
        $this->img_path = basename($storageImagePath);
        $this->head_img_path = basename($head_storageImagePath);
        $this->save();
        
        return;
    }
    //プロフィール取得
    public function getProfile(Int $user_id)
    {
        return $this->with('user')->where('id', $user_id)->first();
    }
    //プロフィール編集
    public function getEditProfile(Int $user_id, Int $profile_id)
    {
        return $this->where('user_id', $user_id)->where('id', $profile_id)->first();
    }
    //編集
    public function profileUpdate(Array $data)
    {
        if (isset($data['img']) && isset($data['head_img'])) {
        //profile image
        $cropImageData = base64_decode(explode(",", explode(";", $data['img'])[1])[1]);

        $imagePath = '/profile_image/' . str_random(10) . '.jpeg';

        $storageImagePath = storage_path('app/public') . $imagePath;
        \file_put_contents($storageImagePath, $cropImageData);
        //header image
        $head_cropImageData = base64_decode(explode(",", explode(";", $data['head_img'])[1])[1]);

        $head_imagePath = '/profile_image/' . str_random(10) . '.jpeg';

        $head_storageImagePath = storage_path('app/public') . $head_imagePath;
        \file_put_contents($head_storageImagePath, $head_cropImageData);
        
        $this::where('id', $this->id)
            ->update([
                'display_name'   => $data['display_name'],
                'main_job'       => $data['jobName'],
                'story_progress' => $data['storyName'],
                'introduction'   => $data['introduction'],
                'img_path'       => basename($storageImagePath),
                'head_img_path'  => basename($head_storageImagePath)
            ]);
        } elseif (isset($data['img'])) {
            //profile image
            $cropImageData = base64_decode(explode(",", explode(";", $data['img'])[1])[1]);
    
            $imagePath = '/profile_image/' . str_random(10) . '.jpeg';
    
            $storageImagePath = storage_path('app/public') . $imagePath;
            \file_put_contents($storageImagePath, $cropImageData);
            
            $this::where('id', $this->id)
            ->update([
                'display_name'   => $data['display_name'],
                'main_job'       => $data['jobName'],
                'story_progress' => $data['storyName'],
                'introduction'   => $data['introduction'],
                'img_path'       => basename($storageImagePath)
            ]);
        } elseif (isset($data['head_img'])) {
            //header image
            $head_cropImageData = base64_decode(explode(",", explode(";", $data['head_img'])[1])[1]);
    
            $head_imagePath = '/profile_image/' . str_random(10) . '.jpeg';
    
            $head_storageImagePath = storage_path('app/public') . $head_imagePath;
            \file_put_contents($head_storageImagePath, $head_cropImageData);
            
            $this::where('id', $this->id)
                ->update([
                    'display_name'   => $data['display_name'],
                    'main_job'       => $data['jobName'],
                    'story_progress' => $data['storyName'],
                    'introduction'   => $data['introduction'],
                    'head_img_path'  => basename($head_storageImagePath)
                ]);
        } else {
             $this::where('id', $this->id)
                ->update([
                    'display_name'   => $data['display_name'],
                    'main_job'       => $data['jobName'],
                    'story_progress' => $data['storyName'],
                    'introduction'   => $data['introduction']
                ]);
        }
        
        return;
    }
    //削除
    public function profileDestroy(Int $user_id, Int $profile_id)
    {
        return $this->where('user_id', $user_id)->where('id', $profile_id)->delete();
    }
    //job変換
    public function getJobNameAttribute()
    {
        return config('job.'.$this->main_job);
    }
    //story変換
    public function getStoryNameAttribute()
    {
        return config('story.'.$this->story_progress);
    }
}
