@extends('layouts.user.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="display-3 font-italic">User</h1>
            <div id="app">
                @foreach ($all_users as $user)
                    <div class="card">
                        <div class="card-haeder p-2 w-100 d-flex">
                            <div class="d-flex align-items-center mr-auto">
                                @if(isset($user->profile->img_path))
                                    <img class="rounded-circle mx-2" src="{{ $user->profile->img_path }}" width="50" height="50">
                                @else
                                    <img class="rounded-circle mx-2" src="https://myappff14.s3.ap-northeast-1.amazonaws.com/+material/79511279656599.png" width="50" height="50">
                                @endif
                                <div class="ml-2 d-flex flex-column">
                                    <a href="{{ url('user/users/' .$user->id) }}" class=" text-light mb-0">@if(!empty($user->profile)){{ $user->profile->display_name }}@else匿名@endif </a>
                                    <a href="{{ url('user/users/' .$user->id) }}" class="text-secondary">＠{{ $user->name }}</a>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center flex-column mr-2">
                                @if(Auth::check() && Auth::id() != $user->id)
                            		<follow-button class="d-flex justify-content-end"
                                		:login_user_id="{{json_encode(Auth::id())}}" 
                                		:user_id="{{json_encode($user->id)}}" 
                                		:csrf="{{json_encode(csrf_token())}}" 
                                		:following="{{json_encode(Auth::user()->isFollowing($user->id))}}" 
                                		:followed="{{json_encode(Auth::user()->isFollowed($user->id))}}">
                            		</follow-button>
                        		@endif
                            @if (auth()->user()->isFollowed($user->id))
                                <div class="mt-1">
                                    <span class="bg-secondary text-light">フォローされています</span>
                                </div>
                            @else
                                <div class="mt-1">
                                    <span class="bg-secondary text-light">フォローされていません</span>
                                </div>
                            @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="my-4 d-flex justify-content-center">
        {{ $all_users->links() }}
    </div>
</div>
@endsection
