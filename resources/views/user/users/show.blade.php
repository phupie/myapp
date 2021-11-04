@extends('layouts.user.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col p-1">
            <div class="card text-light" id="profile">
                @if(isset($user->profile->head_img_path))
                    <img class="card-image-top" src="{{ $user->profile->head_img_path }}">
                @else
                    <img class="card-image-top" src="https://myappff14.s3.ap-northeast-1.amazonaws.com/+material/795112796565.png">
                @endif
                <div class="card-body text-light px-2 pb-0">
                    @if(!empty($user->profile))
                        <div class="d-flex flex-row mb-3">
                            
                            <div class="d-md-flex flex-row flex-grow-1 justify-content-between">
                                <div class="d-flex flex-column pl-2 mb-2 border-left">
                                    <div class="d-md-flex flex-md-row mb-1">
                                        @if(isset($user->profile->img_path))
                                            <img class="rounded-circle mr-3" src="{{ $user->profile->img_path }}" style="width: 30%;">
                                        @else
                                            <img class="rounded-circle mr-3" src="https://myappff14.s3.ap-northeast-1.amazonaws.com/+material/79511279656599.png" width="100" height="100">
                                        @endif
                                            <div class="align-self-center">
                                                <h5 class="mt-1">@if(!empty($user->profile)){{ $user->profile->display_name }}@else匿名@endif</h4>
                                                <span class="text-secondary">＠{{ $user->name }}</span>
                                            </div>
                                    </div>
                                    <div class="d-flex justify-content-first">
                                        <p class="mr-2 mb-0"><span class="font-weight-bold mr-1">{{ $gallery_count }}</span>ギャラリー</p>
                                        <p class="mr-2 mb-0"><span class="font-weight-bold mr-1">{{ $follow_count }}</span>フォロー</p>
                                        <p class="mr-2 mb-0"><span class="font-weight-bold mr-1">{{ $follower_count }}</span>フォロワー</p>
                                    </div>
                                </div>
                                
                                <div class="pl-2 mb-2 border-left">
                                    <h5 id="profile-h"><自己紹介></h4>
                                    <p class="mb-0">{!! nl2br(e($user->profile->introduction)) !!}</p>
                                </div>
                                
                                <div class="d-md-flex flex-column pl-2 mb-2 border-left">
                                    <h5 id="profile-h"><メインジョブ></h4>
                                    <p class="mb-4">{{ $user->profile->jobName }}</p>
                                    <h5 id="profile-h"><ストーリー進行度></h4>
                                    <p class="mb-0">{{ $user->profile->storyName }}</p>
                                </div>
                                
                                <div>
                                </div>
                            </div>
                            
                            
                            <div class="d-flex flex-column">
                                @if ($user->id === Auth::user()->id)
                                    <div class="d-flex flex-md-column mt-1 mb-auto ml-auto">
                                        @if(!empty($user->profile))
                                            <a href="{{ url('user/profiles/' .$user->profile->id .'/edit') }}" class="btn btn-primary">編集</a>
                                        @else
                                            <a href="{{ url('user/profiles/create') }}" class="btn btn-primary">作成</a>
                                        @endif
                                    </div>
                                @else
                                    @if(Auth::check() && Auth::id() != $user->id)
                                		<follow-button 
                                    		:login_user_id="{{json_encode(Auth::id())}}" 
                                    		:user_id="{{json_encode($user->id)}}" 
                                    		:csrf="{{json_encode(csrf_token())}}" 
                                    		:following="{{json_encode(Auth::user()->isFollowing($user->id))}}" 
                                    		:followed="{{json_encode(Auth::user()->isFollowed($user->id))}}">
                                		</follow-button>
                            		@endif
            
                                    @if ($is_followed)
                                        <span class="mt-2 px-1 bg-secondary text-light mr-auto">フォローされています</span>
                                    @endif
                                @endif
                            </div>
                        </div>
                    @else
                        <h5>プロフィールはありません</h5>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@if (isset($timelines))
    <div class="container-fluid">
        <div class="row row-cols-xl-3 row-cols-lg-2 row-cols-1 grid">
            @foreach($timelines as $timeline)
                <div class="col mb-1 p-1 grid-item">
                    <div class="card">
                        <!-- Product image-->
                        <a href="{{ url('user/galleries/' .$timeline->id) }}"><img class="card-img-top" src="{{ $timeline->img_path }}"/></a>
                        <!-- Product details-->
                        <div class="card-img-overlay p-1 mt-auto">
                            
                            <div class="d-flex align-items-center w-100 p-1">
                                <div class="card-footer d-flex bd-highlight w-100 py-1">
                                    <div class="mb-0 text-secondary mr-auto small py-1">
                                        {{ $timeline->created_at->format('Y-m-d H:i') }}
                                    </div>
                                    <div class="mr-3 d-flex align-items-center">
                                        <a href="{{ url('user/galleries/' .$timeline->id) }}"><i class="far fa-comment fa-fw"></i></a>
                                        <p class="mb-0 text-secondary">{{ count($timeline->comments) }}</p>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        @if (!$timeline->isFavorited(Auth::user()))
                                            <span class="favorites">
                                                <i class="far fa-heart fa-fw favorite-toggle text-primary" data-gallery-id="{{ $timeline->id }}"></i>
                                                <span class="favorite-counter text-secondary">{{ $timeline->favorites_count }}</span>
                                            </span><!-- /.likes -->
                                        @else
                                            <span class="favorites">
                                                <i class="fas fa-heart fa-fw favorite-toggle text-primary" data-gallery-id="{{ $timeline->id }}"></i>
                                                <span class="favorite-counter text-secondary">{{ $timeline->favorites_count }}</span>
                                            </span><!-- /.likes -->
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{ $timelines->links() }}
    </div>
@endif
@endsection
