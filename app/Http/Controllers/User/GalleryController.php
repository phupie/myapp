<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Comment;
use App\Models\Follower;
use Storage;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Gallery $gallery)
    {
        $user = auth()->user();
        $posts = Gallery::all()->sortByDesc('created_at');
        
        return view('user.galleries.index', [
            'user' => $user,
            'posts' => $posts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = auth()->user();
        
        return view('user.galleries.create', [
            'user' => $user
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Gallery $gallery)
    {
        $user = auth()->user();
        $data = $request->all();
        
        $validator = Validator::make($data,[
            'title' => ['required', 'string'],
            'explanation' => ['required', 'string'],
            'img' => ['required','file', 'image', 'mimes:jpeg,png,jpg'],
            'areaName' => ['required', 'integer']
        ]);
        
        $validator->validate();
        $gallery->galleryStore($user->id, $data);
        
        return redirect('user/galleries');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Gallery $gallery)
    {
        $user = auth()->user();
        $gallery = $gallery->getGallery($gallery->id);
        
        return view('user.galleries.show', [
            'user' => $user,
            'gallery' => $gallery
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
