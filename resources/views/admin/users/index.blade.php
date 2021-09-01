@extends('layouts.admin.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="display-3 font-italic">User</h1>
            @foreach ($users as $user)
                <div class="card">
                    <div class="card-body p-3 w-100 d-flex">
                        @if(isset($user->profile->img_path))
                            <img class="rounded-circle mr-3" src="{{ $user->profile->img_path }}" width="50" height="50">
                        @else
                            <img class="rounded-circle mr-3" src="{{ asset( 'storage/image/79511279656599.png') }}" width="50" height="50">
                        @endif
                        <div class="ml-2 d-flex flex-column">
                            <a href="" class="text-secondary">＠{{ $user->name }}</a>
                        </div>
                        <form method="POST" action="{{ route('admin.users.destroy' ,$user->id) }}" class="ml-auto" id="delele">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger">削除</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="my-4 d-flex justify-content-center">
        {{ $users->links() }}
    </div>
</div>
@endsection
