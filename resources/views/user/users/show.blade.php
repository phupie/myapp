@extends('layouts.user.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @if(isset($user->profile->head_img_path))
                    <img class="card-image-top" src="{{ asset( 'storage/profile_image/' .$user->profile->head_img_path) }}">
                @else
                    <img class="card-image-top" src="{{ asset( 'storage/image/795112796565.png') }}">
                @endif
                <div class="card-body d-md-flex flex-row bd-highlight mb-0">
                    <div class="d-flex">
                    @if(isset($user->profile->img_path))
                        <img class="rounded-circle mr-3" src="{{ asset( 'storage/profile_image/' .$user->profile->img_path) }}" width="150" height="150">
                    @else
                        <img class="rounded-circle mr-3" src="{{ asset( 'storage/image/79511279656599.png') }}" width="150" height="150">
                    @endif
                        <div class="flex-md-column align-self-center">
                            <h4>{{ $user->profile->display_name }}</h4>
                            <span class="text-secondary">＠{{ $user->name }}</span>
                            
                        </div>
                    </div>
                    @if ($user->id === Auth::user()->id)
                        <div class="d-flex flex-md-column bd-highlight mt-1 mb-auto ml-auto">
                            <a href="{{ url('user/profiles/' .$user->profile->id .'/edit') }}" class="btn btn-primary d-flex">プロフィールを編集する</a>
                        </div>
                    @else
                        @if ($is_following)
                            <form action="{{ route('user.unfollow', $user->id) }}" method="POST" class="d-flex flex-md-column bd-highlight mt-1 mb-auto ml-auto">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}

                                    <button type="submit" class="btn btn-danger">フォロー解除</button>
                            </form>
                        @else
                            <form action="{{ route('user.follow', $user->id) }}" method="POST" class="d-flex flex-md-column bd-highlight mt-1 mb-auto ml-auto">
                                {{ csrf_field() }}

                                    <button type="submit" class="btn btn-primary">フォローする</button>
                            </form>
                        @endif

                        @if ($is_followed)
                            <span class="mt-2 px-1 bg-secondary text-light">フォローされています</span>
                        @endif
                    @endif
                </div>
                <div class="card-body py-0">
                    <h5>自己紹介</h5>
                    <p>{!! nl2br(e($user->profile->introduction)) !!}</p>
                </div>
                <div class="card-body py-0">
                    <div class="row">
                        <div class="col-md">
                            <p class="pr-2 flex-fill bd-highlight">メインジョブ：{{ $user->profile->jobName }}</p>
                        </div>
                        <div class="col-md">
                            <p class="pr-2 flex-fill bd-highlight">ストーリー進行度：{{ $user->profile->storyName }}</p>
                        </div>
                    </div>
                </div>
                <div class="card-footer py-0">
                    <div class="row justify-content-around">
                        <div class="p-2 d-flex flex-column align-items-center">
                            <p class="font-weight-bold mb-1">ギャラリー数</p>
                            <span>{{ $gallery_count }}</span>
                        </div>
                        <div class="p-2 d-flex flex-column align-items-center">
                            <p class="font-weight-bold mb-1">フォロー数</p>
                            <span>{{ $follow_count }}</span>
                        </div>
                        <div class="p-2 d-flex flex-column align-items-center">
                            <p class="font-weight-bold mb-1">フォロワー数</p>
                            <span>{{ $follower_count }}</span>
                        </div>
                    </div>
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
                        <a href="{{ url('user/galleries/' .$timeline->id) }}"><img class="card-img-top" src="{{ asset('storage/image/' .$timeline->img_path) }}"/></a>
                        <!-- Product details-->
                        <div class="card-footer d-flex bd-highlight w-100">
                            <div class="mb-0 text-secondary bd-highlight mr-auto small py-1">
                                {{ $timeline->created_at->format('Y-m-d H:i') }}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endif
@endsection
