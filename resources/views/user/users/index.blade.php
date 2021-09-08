@extends('layouts.user.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="display-3 font-italic">User</h1>
            <div id="app">
                @foreach ($all_users as $user)
                    <div class="card">
                        <div class="card-haeder p-3 w-100 d-flex">
                            @if(isset($user->profile->img_path))
                                <img class="rounded-circle mr-3" src="{{ $user->profile->img_path }}" width="50" height="50">
                            @else
                                <img class="rounded-circle mr-3" src="https://myappff14.s3.ap-northeast-1.amazonaws.com/+material/79511279656599.png" width="50" height="50">
                            @endif
                            <div class="ml-2 d-flex flex-column">
                                <a href="{{ url('user/users/' .$user->id) }}" class=" text-light mb-0">@if(!empty($user->profile)){{ $user->profile->display_name }}@else匿名@endif </a>
                                <a href="{{ url('user/users/' .$user->id) }}" class="text-secondary">＠{{ $user->name }}</a>
                            </div>
                            @if (auth()->user()->isFollowed($user->id))
                                <div class="px-2 ml-auto">
                                    <span class="px-1 bg-secondary text-light">フォローされています</span>
                                </div>
                            @endif
                            <div class="d-flex justify-content-end flex-grow-1">
                                @if(Auth::check() && Auth::id() != $user->id)
                            		<follow-button 
                                		:login_user_id="{{json_encode(Auth::id())}}" 
                                		:user_id="{{json_encode($user->id)}}" 
                                		:csrf="{{json_encode(csrf_token())}}" 
                                		:following="{{json_encode(Auth::user()->isFollowing($user->id))}}" 
                                		:followed="{{json_encode(Auth::user()->isFollowed($user->id))}}">
                            		</follow-button>
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
