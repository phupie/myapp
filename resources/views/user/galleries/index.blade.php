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
                                <a href="{{ url('user/users/' .$timeline->user->id) }}" class="text-body mr-1">{{ $timeline->user->profile->display_name }}</a>
                                <p class="mb-0 text-secondary ">＠{{ $timeline->user->name }}</p>
                                <div class="mb-0 text-secondary mr-auto small">
                                ・{{ $timeline->created_at->format('Y-m-d H:i') }}
                                </div>
                            </div>
                            <div class="py-1 d-flex justify-content-end">
                                <div class="mr-3 d-flex align-items-center">
                                    <a href="{{ url('tweets/' .$timeline->id) }}"><i class="far fa-comment fa-fw"></i></a>
                                    <p class="mb-0 text-secondary">{{ count($timeline->comments) }}</p>
                                </div>
                                <div class="d-flex align-items-center">
                                    @if (!in_array($user->id, array_column($timeline->favorites->toArray(), 'user_id'), TRUE))
                                        <form method="POST" action="{{ url('user/favorites/') }}" class="mb-0">
                                            @csrf
    
                                            <input type="hidden" name="gallery_id" value="{{ $timeline->id }}">
                                            <button type="submit" class="btn p-0 border-0 text-primary"><i class="far fa-heart fa-fw"></i></button>
                                        </form>
                                    @else
                                        <form method="POST" action="{{ url('user/favorites/' .array_column($timeline->favorites->toArray(), 'id', 'user_id')[$user->id]) }}" class="mb-0">
                                            @csrf
                                            @method('DELETE')
    
                                            <button type="submit" class="btn p-0 border-0 text-danger"><i class="fas fa-heart fa-fw"></i></button>
                                        </form>
                                    @endif
                                    <p class="mb-0 text-secondary">{{ count($timeline->favorites) }}</p>
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
