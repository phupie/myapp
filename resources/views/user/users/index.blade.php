@extends('layouts.user.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="font-italic">ユーザー一覧</h1>
            @foreach ($all_users as $user)
                <div class="card">
                    <div class="card-haeder p-3 w-100 d-flex">
                        @if(isset($user->profile->img_path))
                            <img class="rounded-circle mr-3" src="{{ asset( 'storage/profile_image/' .$user->profile->img_path) }}" width="50" height="50">
                        @else
                            <img class="rounded-circle mr-3" src="{{ asset( 'storage/image/79511279656599.png') }}" width="50" height="50">
                        @endif
                        <div class="ml-2 d-flex flex-column">
                            <a href="{{ url('user/users/' .$user->id) }}" class=" text-light mb-0">{{ $user->profile->display_name }}</a>
                            <a href="{{ url('user/users/' .$user->id) }}" class="text-secondary">＠{{ $user->name }}</a>
                        </div>
                        @if (auth()->user()->isFollowed($user->id))
                            <div class="px-2 ml-auto">
                                <span class="px-1 bg-secondary text-light">フォローされています</span>
                            </div>
                        @endif
                        <div class="d-flex justify-content-end flex-grow-1">
                            @if (auth()->user()->isFollowing($user->id))
                                <form action="{{ route('user.unfollow', $user->id) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <button type="submit" class="btn btn-danger">フォロー解除</button>
                                </form>
                            @else
                                <form action="{{ route('user.follow', $user->id) }}" method="POST">
                                    {{ csrf_field() }}

                                    <button type="submit" class="btn btn-primary">フォローする</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="my-4 d-flex justify-content-center">
        {{ $all_users->links() }}
    </div>
</div>
@endsection
