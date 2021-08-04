@extends('layouts.user.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
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
                    @endif
                </div>
                <div class="card-body py-0">
                    <h5>自己紹介</h5>
                    <p>{!! nl2br(e($user->profile->introduction)) !!}</p>
                </div>
                <div class="card-body d-flex bd-highlight py-0">
                    <label>メインジョブ：</label>
                    <p class="pr-2 flex-fill bd-highlight">{{ $user->profile->jobName }}</p>
                    <label>ストーリー進行度：</label>
                    <p class="pr-2 flex-fill bd-highlight">{{ $user->profile->storyName }}</p>
                </div>
                <div class="card-footer py-1 d-flex justify-content-end">
                    @if ($user->id === Auth::user()->id)
                        <div class="dropdown mr-3 d-flex align-items-center">
                            <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-fw"></i>
                            </a>
                        <div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
