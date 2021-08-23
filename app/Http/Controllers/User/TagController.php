<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tag;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::withCount('galleries')
        ->orderBy('galleries_count', 'desc')
        ->paginate(20);
        
        return view('user.tags.index', [
            'tags' => $tags
        ]);
    }
}
