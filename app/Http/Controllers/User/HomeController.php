<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gallery;
use App\Models\Profile;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:user');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     
    public function index()
    {
        return view('user.home');
    }
    
    public function galleries(Profile $profile, Gallery $gallery)
    {
        $user = auth()->user();
        //すべてのギャラリー
        $posts = $gallery->withCount('favorites')->paginate(20);

        if(isset($user->profile)) {
            
            //プロフィールに応じた表示
            $story_num = Profile::where('user_id', $user->id)->pluck('story_progress')->first();
            $timelines = $gallery->getProfileTimeLine($story_num);
            
            return view('user.home.galleries',[
                'timelines' => $timelines,
                'posts' => $posts
            ]);
        } else {
            $message = "プロフィールを作成するとネタバレになりそうな投稿をブロックできます！";
            return view('user.home.allGalleries',[
                'message' => $message,
                'posts' => $posts
            ]);
        }
    }
    
    public function all(Gallery $gallery)
    {
        $user = auth()->user();
        $posts = $gallery->withCount('favorites')->paginate(20);
        
        return view('user.home.allGalleries',[
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
