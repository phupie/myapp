@extends('layouts.user.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card text-light">
                @if(isset($user->profile->head_img_path))
                    <img class="card-image-top" src="{{ $user->profile->head_img_path }}">
                @else
                    <img class="card-image-top" src="{{ asset( 'storage/image/795112796565.png') }}">
                @endif
                <div class="card-body text-light">
                    <div class="d-md-flex flex-row bd-highlight mb-3">
                        <div class="d-flex mb-3">
                            @if(isset($user->profile->img_path))
                                <img class="rounded-circle mr-3" src="{{ $user->profile->img_path }}" width="150" height="150">
                            @else
                                <img class="rounded-circle mr-3" src="{{ asset( 'storage/image/79511279656599.png') }}" width="150" height="150">
                            @endif
                                <div class="align-self-center">
                                    <h4>@if(!empty($user->profile)){{ $user->profile->display_name }}@else匿名@endif</h4>
                                    <span class="text-secondary">＠{{ $user->name }}</span>
                                </div>
                        </div>
                        <div class="ml-auto">
                            @if ($user->id === Auth::user()->id)
                                <div class="d-flex flex-md-column bd-highlight mt-1 mb-auto ml-auto">
                                    @if(!empty($user->profile))
                                        <a href="{{ url('user/profiles/' .$user->profile->id .'/edit') }}" class="btn btn-primary d-flex">プロフィールを編集する</a>
                                    @else
                                        <a href="{{ url('user/profiles/create') }}" class="btn btn-primary d-flex">プロフィールを作成する</a>
                                    @endif
                                </div>
                            @else
                                @if(Auth::check() && Auth::id() != $user->id)
                            		<follow-button 
                                		login_user_id="{{json_encode(Auth::id())}}" 
                                		user_id="{{json_encode($user->id)}}" 
                                		csrf="{{json_encode(csrf_token())}}" 
                                		following="{{json_encode(Auth::user()->isFollowing($user->id))}}" 
                                		followed="{{json_encode(Auth::user()->isFollowed($user->id))}}">
                            		</follow-button>
                        		@endif
        
                                @if ($is_followed)
                                    <span class="mt-2 px-1 bg-secondary text-light">フォローされています</span>
                                @endif
                            @endif
                            
                        </div>
                    </div>
                    @if(!empty($user->profile))
                        <div class="d-flex flex-column">
                            <h5>自己紹介</h5>
                            <p>{!! nl2br(e($user->profile->introduction)) !!}</p>
                        </div>
                        <div class="d-md-flex">
                            <p class="flex-fill bd-highlight">メインジョブ：{{ $user->profile->jobName }}</p>
                            <p class="flex-fill bd-highlight">ストーリー進行度：{{ $user->profile->storyName }}</p>
                        </div>
                        <div class="d-flex justify-content-first">
                            <p class="mr-2 mb-0"><span class="font-weight-bold mr-1">{{ $gallery_count }}</span>ギャラリー</p>
                            <p class="mr-2 mb-0"><span class="font-weight-bold mr-1">{{ $follow_count }}</span>フォロー</p>
                            <p class="mr-2 mb-0"><span class="font-weight-bold mr-1">{{ $follower_count }}</span>フォロワー</p>
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
    <div class="container">
        <div class="row row-cols-md-2 row-cols-xl-3" data-masonry='{"percentPosition": true }'>
            @foreach($timelines as $timeline)
                <div class="col mb-1 p-1">
                    <div class="card">
                        <!-- Product image-->
                        <a href="{{ url('user/galleries/' .$timeline->id) }}"><img class="card-img-top" src="{{ $timeline->img_path }}"/></a>
                        <!-- Product details-->
                        <div class="card-footer d-flex bd-highlight w-100 py-1">
                            <div class="mb-0 text-secondary bd-highlight mr-auto small py-1">
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
            @endforeach
        </div>
        {!! $timelines->render() !!}
    </div>
@endif
@endsection
