@extends('layouts.user.app')

@section('title', 'マイギャリー')

@section('content')
<h1 class="display-3 font-italic text-center">My Gallery</h1>
<div class="container-fluid">
    <div class="row row-cols-xl-3 row-cols-lg-2 row-cols-1 grid">
        @if (isset($timelines))
            @foreach($timelines as $timeline)
                <div class="col mb-1 p-1 grid-item">
                    <div class="card">
                        <!-- Product image-->
                        <a href="{{ url('user/galleries/' .$timeline->id) }}"><img class="card-img-top h-100" src="{{$timeline->img_path}}"/></a>
                        <!-- Product details-->
                        <div class="card-img-overlay py-1 mt-auto">
                            
                            <div class="d-flex align-items-center w-100 p-1">
                                @if(isset($timeline->user->profile->img_path))
                                    <img class="rounded-circle mr-1" src="{{ $timeline->user->profile->img_path }}" width="30" height="30">
                                @else
                                    <img class="rounded-circle mr-1" src="https://myappff14.s3.ap-northeast-1.amazonaws.com/+material/79511279656599.png" width="30" height="30">
                                @endif
                                <div class="mr-3 d-flex align-items-center mr-auto">
                                    <a href="{{ url('user/users/' .$timeline->user->id) }}" class="text-light mr-1">@if(!empty($timeline->user->profile)){{ $timeline->user->profile->display_name }}@else{{ $timeline->user->name }}@endif </a>
                                    <div class="mb-0 text-secondary mr-auto small">
                                        {{ $timeline->created_at->format('Y-m-d H:i') }}
                                    </div>
                                </div>
                                
                                <div class="py-1 d-flex justify-content-end">
                                    <div class="mr-3 d-flex align-items-center">
                                        <a href="{{ url('user/galleries/' .$timeline->id) }}"><i class="far fa-comment fa-fw"></i></a>
                                        <p class="ml-1 mb-0 text-secondary">{{ count($timeline->comments) }}</p>
                                    </div>
                                    <div class="d-flex align-items-center">
                                          <!-- Review.phpに作ったisLikedByメソッドをここで使用 -->
                                          @if (!$timeline->isFavorited(Auth::user()))
                                            <span class="favorites">
                                                <i class="far fa-heart fa-fw favorite-toggle text-primary LikesIcon-fa-heart" data-gallery-id="{{ $timeline->id }}"></i>
                                              <span class="favorite-counter text-secondary">{{$timeline->favorites_count}}</span>
                                            </span><!-- /.likes -->
                                          @else
                                            <span class="favorites">
                                                <i class="fas fa-heart fa-fw favorite-toggle text-primary LikesIcon-fa-heart heart" data-gallery-id="{{ $timeline->id }}"></i>
                                              <span class="favorite-counter text-secondary">{{$timeline->favorites_count}}</span>
                                            </span><!-- /.likes -->
                                          @endif
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            {{ $timelines->links() }}
        @endif
    </div>
</div>
@endsection
