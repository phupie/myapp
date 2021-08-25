<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\User;
use App\Models\Gallery;
use App\Models\Follower;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        $all_users = $user->getAllUsers(auth()->user()->id);
        
        return view('user.users.index', [
            'all_users' => $all_users
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
    public function show(User $user, Profile $profile, Gallery $gallery, Follower $follower)
    {
        $login_user = auth()->user();
        $profiles = $profile->getProfile($user->id);
        $is_following = $login_user->isFollowing($user->id);
        $is_followed = $login_user->isFollowed($user->id);
        $timelines = $gallery->getUserTimeLine($user->id);
        $gallery_count = $gallery->getGalleryCount($user->id);
        $follow_count = $follower->getFollowCount($user->id);
        $follower_count = $follower->getFollowerCount($user->id);
        
        
        return view('user.users.show', [
            'user'           => $user,
            'profiles'       => $profiles,
            'is_following'    => $is_following,
            'is_followed'    => $is_followed,
            'timelines'      => $timelines,
            'gallery_count'  => $gallery_count,
            'follow_count'   => $follow_count,
            'follower_count' => $follower_count,
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
    
    //フォロー
    public function follow(User $user)
    {
        $follower = auth()->user();
        
        if($follower->id != $user->id) {
            $follower->follow($user->id);
            return response()->json($follower->isFollowing($user->id));
        }
    }
    
    //フォロー確認
    public function follow_check(User $user)
    {
        $check_user = auth()->user();
        
        return response()->json($check_user->isFollowing($user->id));
    }
}
