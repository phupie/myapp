<?php

namespace App\Http\Components;

use App\Models\Gallery;

class Search
{
  public static function searchGallery($keyword,$keyword_area)
  {
          $query = Gallery::query();
          $areaName = config('area.'.$keyword_area);

          if(!empty($keyword) && !empty($keyword_area)) {
          $galleries = $query->withCount('favorites')
                             ->where('area', $keyword_area)
                             ->where('title','like', '%' .$keyword. '%')
                             ->Where('explanation','like', '%' .$keyword. '%')
                             ->orWhereHas('tags', function ($tag) use ($keyword){
                                $tag->where('name', 'like', '%' . $keyword . '%');
                             })
                             ->get();
          $message = $areaName. "の「". $keyword."」を含む投稿の検索が完了しました。";
        } elseif(!empty($keyword) && empty($keyword_age)) {
          $galleries = $query->withCount('favorites')
                             ->where('title','like', '%' .$keyword. '%')
                             ->orWhere('explanation','like', '%' .$keyword. '%')
                             ->orWhereHas('tags', function ($tag) use ($keyword){
                                $tag->where('name', 'like', '%' . $keyword . '%');
                             })
                             ->get();
          $message = "「". $keyword."」を含む投稿の検索が完了しました。";
        } elseif(empty($keyword) && !empty($keyword_area)) {
          $galleries = $query->withCount('favorites')
                             ->where('area', $keyword_area)
                             ->get();
          $message = "「". $areaName."」の投稿の検索が完了しました。";
        }

        
        else {
          $galleries = null;
          $message = "検索結果はありません。";
        }

        return  [$galleries,$message];
  }

}
