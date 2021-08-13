@extends('layouts.user.app')

@section('content')
<h1 class="display-3 font-italic text-center">Gallery</h1>
<div class="container-fluid">
    <div class="row row-cols-md-2 row-cols-xl-3" data-masonry='{"percentPosition": true }'>
        @if (isset($timelines))
            @foreach($timelines as $timeline)
                <div class="col mb-1 p-1">
                    <div class="card">
                        <!-- Product image-->
                        <a href="{{ url('user/galleries/' .$timeline->id) }}"><img class="card-img-top" src="{{ asset('storage/image/' .$timeline->img_path) }}"/></a>
                        <!-- Product details-->
                        <div class="card-footer d-flex bd-highlight w-100 py-1">
                            <img src="{{ asset('storage/profile_image/' .$timeline->user->profile->img_path) }}" class="rounded-circle mr-1" width="30" height="30">
                            <div class="mr-3 d-flex align-items-center mr-auto">
                                <a href="{{ url('user/users/' .$timeline->user->id) }}" class="text-light mr-1">{{ $timeline->user->profile->display_name }}</a>
                                <p class="mb-0 text-secondary">＠{{ $timeline->user->name }}</p>
                                <div class="mb-0 text-secondary mr-auto small">
                                ・{{ $timeline->created_at->format('Y-m-d H:i') }}
                                </div>
                            </div>
                            <div class="py-1 d-flex justify-content-end">
                                <div class="mr-3 d-flex align-items-center">
                                    <a href="{{ url('user/galleries/' .$timeline->id) }}"><i class="far fa-comment fa-fw"></i></a>
                                    <p class="mb-0 text-secondary">{{$timeline->favorites_count}}</p>
                                </div>
                                <div class="d-flex align-items-center">
                                      <!-- Review.phpに作ったisLikedByメソッドをここで使用 -->
                                      @if (!$timeline->isFavorited(Auth::user()))
                                        <span class="favorites">
                                            <i class="far fa-heart fa-fw favorite-toggle" data-gallery-id="{{ $timeline->id }}"></i>
                                          <span class="favorite-counter text-secondary">{{$timeline->favorites_count}}</span>
                                        </span><!-- /.likes -->
                                      @else
                                        <span class="favorites">
                                            <i class="far fa-heart fa-fw favorite-toggle favorited" data-gallery-id="{{ $timeline->id }}"></i>
                                          <span class="favorite-counter text-secondary">{{$timeline->favorites_count}}</span>
                                        </span><!-- /.likes -->
                                      @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>
@endsection
