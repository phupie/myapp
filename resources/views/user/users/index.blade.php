@extends('layouts.user.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="font-italic">ユーザー一覧</h1>
            @foreach ($all_users as $user)
                <div class="card">
                    <div class="card-haeder p-3 w-100 d-flex">
                        <img src="{{ asset('storage/profile_image/' .$user->profile->img_path) }}" class="rounded-circle" width="50" height="50">
                        <div class="ml-2 d-flex flex-column">
                            <a href="{{ url('user/users/' .$user->id) }}" class="text-body mb-0">{{ $user->profile->display_name }}</a>
                            <a href="{{ url('user/users/' .$user->id) }}" class="text-secondary">＠{{ $user->name }}</a>
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
