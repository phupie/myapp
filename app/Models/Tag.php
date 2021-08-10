<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    
    protected $fillable = [
        'name'
    ];
    
    public function galleries()
    {
        return $this->belongsToMany(Gallery::class, 'gallery_tag');
    }
}