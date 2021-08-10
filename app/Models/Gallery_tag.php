<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery_tag extends Model
{
    protected $fillable = [
        'gallery_id',
        'tag_id'
    ];
}
