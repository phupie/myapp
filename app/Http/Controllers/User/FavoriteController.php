<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Favorite;
use App\Models\Gallery;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request, Favorite $favorite)
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
    public function destroy(Favorite $favorite)
    {
        //
    }
    
    public function favorite(Request $request, Favorite $favorite)
    {
        $user_id = auth()->user()->id;
        $gallery_id = $request->gallery_id;
        $already_favorited = Favorite::where('user_id', $user_id)->where('gallery_id', $gallery_id)->first(); //3.

        if (!$already_favorited) { //もしこのユーザーがこの投稿にまだいいねしてなかったら
            $favorite->gallery_id = $gallery_id; //Likeインスタンスにreview_id,user_idをセット
            $favorite->user_id = $user_id;
            $favorite->save();
        } else { //もしこのユーザーがこの投稿に既にいいねしてたらdelete
            Favorite::where('gallery_id', $gallery_id)->where('user_id', $user_id)->delete();
        }
        //5.この投稿の最新の総いいね数を取得
        $gallery_favorites_count = Gallery::withCount('favorites')->findOrFail($gallery_id)->favorites_count;
        $param = [
            'gallery_favorites_count' => $gallery_favorites_count,
        ];
        return response()->json($param); //6.JSONデータをjQueryに返す
    }
}
