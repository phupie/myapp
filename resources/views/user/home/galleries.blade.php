@extends('layouts.user.app')

@section('title', 'おすすめギャラリー')

@section('content')
<div class="row">
    <div class="col-lg-3"></div>
    <h1 class="col-lg-6 display-3 font-italic text-center">Gallery</h1>
    <div class="col-lg-3 text-center align-items-center">
        <a href="{{ url('user/home/all') }}" class="btn btn-primary col-md-10 mt-3">すべてのギャラリー<i class="fas fa-arrow-circle-right"></i></a>
        <p class="col-md-10 mx-auto px-0 mb-0">現在、プロフィールの設定に応じたギャラリーを表示しています</p>
    </div>
</div>
<div class="container-fluid">
    <div class="row row-cols-md-2 row-cols-xl-3" data-masonry='{"percentPosition": true }'>
        @if (isset($timelines))
            @foreach($timelines as $timeline)
                <div class="col mb-1 p-1">
                    <div class="card">
                        <!-- Product image-->
                        <a href="{{ url('user/galleries/' .$timeline->id) }}"><img class="card-img-top" src="{{ $timeline->img_path }}"/></a>
                        <!-- Product details-->
                        <div class="card-footer d-flex bd-highlight w-100 py-1">
                            @if(isset($timeline->user->profile->img_path))
                                <img class="rounded-circle mr-1" src="{{ $timeline->user->profile->img_path }}" width="30" height="30">
                            @else
                                <img class="rounded-circle mr-1" src="https://myappff14.s3.ap-northeast-1.amazonaws.com/+material/79511279656599.png" width="30" height="30">
                            @endif
                            <div class="mr-3 d-flex align-items-center mr-auto">
                                <a href="{{ url('user/users/' .$timeline->user->id) }}" class="text-light mr-1">@if(!empty($timeline->user->profile)){{ $timeline->user->profile->display_name }}@else{{ $timeline->user->name }}@endif </a>
                                <p class="mb-0 text-secondary">＠{{ $timeline->user->name }}</p>
                                <div class="mb-0 text-secondary mr-auto small">
                                ・{{ $timeline->created_at->format('Y-m-d H:i') }}
                                </div>
                            </div>
                            <div class="py-1 d-flex justify-content-end">
                                <div class="mr-3 d-flex align-items-center">
                                    <a href="{{ url('user/galleries/' .$timeline->id) }}"><i class="far fa-comment fa-fw"></i></a>
                                    <p class="mb-0 text-secondary">{{ count($timeline->comments) }}</p>
                                </div>
                                <div class="d-flex align-items-center">
                                      <!-- Review.phpに作ったisLikedByメソッドをここで使用 -->
                                      @if (!$timeline->isFavorited(Auth::user()))
                                        <span class="favorites">
                                            <i class="far fa-heart fa-fw favorite-toggle text-primary LikesIcon-fa-heart" data-gallery-id="{{ $timeline->id }}"></i>
                                          <span class="favorite-counter text-secondary">{{$timeline->favorites_count}}</span>
                                        </span><!-- /.likes -->
                                      @else
                                        <span class="favorites">
                                            <i class="fas fa-heart fa-fw favorite-toggle text-primary LikesIcon-fa-heart heart" data-gallery-id="{{ $timeline->id }}"></i>
                                          <span class="favorite-counter text-secondary">{{$timeline->favorites_count}}</span>
                                        </span><!-- /.likes -->
                                      @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            {{ $timelines->links() }}
        @endif
    </div>
</div>
@endsection
