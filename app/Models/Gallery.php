<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use softDeletes;
    
    protected $fillable = [
        'explanation'
    ];
    
    public function user()
    {
        return $this->bellongsTo(User::class);
    }
    
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }
    
    public function commnets()
    {
        return $this->hasMany(Comment::class);
    }
}
