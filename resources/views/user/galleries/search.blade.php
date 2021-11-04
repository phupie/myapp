@extends('layouts.user.app')

@section('title', '検索結果')

@section('content')
<h1 class="display-3 font-italic text-center">Gallery</h1>
    @if(!empty($message))
        <div class="alert alert-primary container" role="alert">{{ $message }}</div>
    @endif
<div class="container-fluid">
    <div class="row row-cols-md-2 row-cols-xl-3" data-masonry='{"percentPosition": true }'>
        @if (isset($galleries))
            @foreach($galleries as $gallery)
                <div class="col mb-1 p-1">
                    <div class="card">
                        <!-- Product image-->
                        <a href="{{ url('user/galleries/' .$gallery->id) }}"><img class="card-img-top" src="{{ $gallery->img_path }}"/></a>
                        <!-- Product details-->
                        <div class="card-img-overlay py-1 mt-auto">
                            
                            <div class="d-flex align-items-center w-100 p-1">
                                @if(isset($gallery->user->profile->img_path))
                                    <img src="{{ $gallery->user->profile->img_path }}" class="rounded-circle mr-1" width="30" height="30">
                                @else
                                    <img class="rounded-circle mr-1" src="https://myappff14.s3.ap-northeast-1.amazonaws.com/+material/79511279656599.png" width="30" height="30">
                                @endif
                                <div class="mr-3 d-flex align-items-center mr-auto">
                                    <a href="{{ url('user/users/' .$gallery->user->id) }}" class="text-light mr-1">@if(!empty($gallery->user->profile)){{ $gallery->user->profile->display_name }}@else{{ $gallery->user->name }}@endif</a>
                                    <p class="mb-0 text-secondary">＠{{ $gallery->user->name }}</p>
                                    <div class="mb-0 text-secondary mr-auto small">
                                    ・{{ $gallery->created_at->format('Y-m-d H:i') }}
                                    </div>
                                </div>
                                
                                <div class="py-1 d-flex justify-content-end">
                                    <div class="mr-3 d-flex align-items-center">
                                        <a href="{{ url('user/galleries/' .$gallery->id) }}"><i class="far fa-comment fa-fw"></i></a>
                                        <p class="ml-1 mb-0 text-secondary">{{$gallery->favorites_count}}</p>
                                    </div>
                                    <div class="d-flex align-items-center">
                                          @if (!$gallery->isFavorited(Auth::user()))
                                            <span class="favorites">
                                                <i class="far fa-heart fa-fw favorite-toggle text-primary" data-gallery-id="{{ $gallery->id }}"></i>
                                                <span class="favorite-counter text-secondary">{{ $gallery->favorites_count }}</span>
                                            </span><!-- /.likes -->
                                        @else
                                            <span class="favorites">
                                                <i class="fas fa-heart fa-fw favorite-toggle text-primary" data-gallery-id="{{ $gallery->id }}"></i>
                                                <span class="favorite-counter text-secondary">{{ $gallery->favorites_count }}</span>
                                            </span><!-- /.likes -->
                                        @endif
                                    </div>
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
