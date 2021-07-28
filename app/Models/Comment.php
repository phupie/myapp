<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
