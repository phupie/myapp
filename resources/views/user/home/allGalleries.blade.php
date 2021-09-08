@extends('layouts.user.app')

@section('title', 'すべてのギャラリー')

@section('content')
<div class="row">
    <div class="col-lg-3"></div>
    <h1 class="col-lg-6 display-3 font-italic text-center">All Gallery</h1>
    <div class="col-lg-3 text-center align-items-center">
        @if (isset(Auth::user()->profile))
            <a href="{{ url('user/home/galleries') }}" class="btn btn-primary col-md-10 mt-3">おすすめギャラリー<i class="fas fa-arrow-circle-right"></i></a>
            <p class="col-md-10 mx-auto px-0 mb-0">ストーリー進行度より先の投稿を非表示にする</p>
        @else
            <a href="#" class="btn btn-primary col-md-10 mt-3  disabled" aria-disabled="true">おすすめギャラリー<i class="fas fa-arrow-circle-right"></i></a>
            <p  class="col-md-10 mx-auto px-0 mb-0"></p><a href="{{ url('user/profile/create') }}" class="text-secondary">ストーリー進行度より先の投稿を非表示にするにはプロフィールを作成してください⇒</a></p>
        @endif
    </div>
</div>
<div class="container-fluid">
    <div class="row row-cols-md-2 row-cols-xl-3" data-masonry='{"percentPosition": true }'>
        @if (isset($posts))
            @foreach($posts as $post)
                <div class="col mb-1 p-1">
                    <div class="card">
                        <!-- Product image-->
                        <a href="{{ url('user/galleries/' .$post->id) }}"><img class="card-img-top" src="{{ $post->img_path }}"/></a>
                        <!-- Product details-->
                        <div class="card-footer d-flex bd-highlight w-100 py-1">
                            @if(isset($post->user->profile->img_path))
                                <img class="rounded-circle mr-1" src="{{ $post->user->profile->img_path }}" width="30" height="30">
                            @else
                                <img class="rounded-circle mr-1" src="https://myappff14.s3.ap-northeast-1.amazonaws.com/+material/79511279656599.png" width="30" height="30">
                            @endif
                            <div class="mr-3 d-flex align-items-center mr-auto">
                                <a href="{{ url('user/users/' .$post->user->id) }}" class="text-light mr-1">@if(!empty($post->user->profile)){{ $post->user->profile->display_name }}@else{{ $post->user->name }}@endif </a>
                                <p class="mb-0 text-secondary">＠{{ $post->user->name }}</p>
                                <div class="mb-0 text-secondary mr-auto small">
                                ・{{ $post->created_at->format('Y-m-d H:i') }}
                                </div>
                            </div>
                            <div class="py-1 d-flex justify-content-end">
                                <div class="mr-3 d-flex align-items-center">
                                    <a href="{{ url('user/galleries/' .$post->id) }}"><i class="far fa-comment fa-fw"></i></a>
                                    <p class="mb-0 text-secondary">{{ count($post->comments) }}</p>
                                </div>
                                <div class="d-flex align-items-center">
                                      <!-- Review.phpに作ったisLikedByメソッドをここで使用 -->
                                      @if (!$post->isFavorited(Auth::user()))
                                        <span class="favorites">
                                            <i class="far fa-heart fa-fw favorite-toggle text-primary LikesIcon-fa-heart" data-gallery-id="{{ $post->id }}"></i>
                                          <span class="favorite-counter text-secondary">{{$post->favorites_count}}</span>
                                        </span><!-- /.likes -->
                                      @else
                                        <span class="favorites">
                                            <i class="fas fa-heart fa-fw favorite-toggle text-primary LikesIcon-fa-heart heart" data-gallery-id="{{ $post->id }}"></i>
                                          <span class="favorite-counter text-secondary">{{$post->favorites_count}}</span>
                                        </span><!-- /.likes -->
                                      @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            {{ $posts->links() }}
        @endif
    </div>
</div>
@endsection
