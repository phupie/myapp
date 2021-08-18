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
    
}
