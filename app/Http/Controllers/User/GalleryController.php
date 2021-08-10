<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Gallery;
use App\Models\Comment;
use App\Models\Follower;
use App\Models\Tag;
use Storage;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Gallery $gallery, Follower $follower)
    {
        $user = auth()->user();
        $follow_ids = $follower->followingIds($user->id);
        $folloeing_ids = $follow_ids->pluck('followed_id')->toArray();
        
        $timelines = $gallery->getTimeLines($user->id, $folloeing_ids);
        
        return view('user.galleries.index', [
            'user' => $user,
            'timelines' => $timelines
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
        
        preg_match_all('/#([a-zA-z0-9０-９ぁ-んァ-ヶ亜-熙]+)/u', $request->tags, $match);
        
        $tags = [];
        foreach ($match[1] as $tag) {
            $record = Tag::firstOrCreate(['name' => $tag]); // firstOrCreateメソッドで、tags_tableのnameカラムに該当のない$tagは新規登録される。
            array_push($tags, $record); // $recordを配列に追加します(=$tags)
        };

        // 投稿に紐付けされるタグのidを配列化
        $tags_id = [];
        foreach ($tags as $tag) {
            array_push($tags_id, $tag['id']);
        };
        $gallery->tags()->attach($tags_id);
        
        return redirect('user/galleries');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Gallery $gallery, Comment $comment, Tag $tag)
    {
        $user = auth()->user();
        $gallery = $gallery->getGallery($gallery->id);
        $comments = $comment->getComments($gallery->id);
        
        return view('user.galleries.show', [
            'user' => $user,
            'gallery' => $gallery,
            'comments' => $comments
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Gallery $gallery)
    {
        $user = auth()->user();
        $galleries = $gallery->getEditGallery($user->id, $gallery->id);
        
        if (!isset($galleries)) {
            return redirect('user/galleries');
        }
        
        return view('user.galleries.edit',[
            'user' => $user,
            'galleries' => $galleries
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gallery $gallery)
    {
        $data = $request->all();
        
        $validator = Validator::make($data,[
            'title' => ['required', 'string'],
            'explanation' => ['required', 'string'],
            'areaName' => ['required', 'integer']
        ]);
        
        $validator->validate();
        $gallery->galleryUpdate($data);
        
        return redirect('user/galleries');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallery $gallery)
    {
        $user = auth()->user();
        $gallery->galleryDestroy($user->id, $gallery->id);
        
        return redirect('user/galleries');
    }
}
