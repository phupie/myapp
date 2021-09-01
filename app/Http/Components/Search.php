<?php

namespace App\Http\Components;

use App\Models\Gallery;

class Search
{
  public static function searchGallery($keyword)
  {
          $query = Gallery::query();

          if(!empty($keyword)) {
          $galleries = $query->withCount('favorites')
                             ->where('title','like', '%' .$keyword. '%')
                             ->orWhere('explanation','like', '%' .$keyword. '%')
                             ->orWhereHas('tags', function ($tag) use ($keyword){
                                $tag->where('name', 'like', '%' . $keyword . '%');
                             })
                             ->get();
          $message = "「". $keyword."」を含む投稿の検索が完了しました。";
        }

        
        else {
          $galleries = null;
          $message = "検索結果はありません。";
        }

        return  [$galleries,$message];
  }

}
