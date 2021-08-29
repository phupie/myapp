@extends('layouts.user.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mb-3">
            <div class="card">
                <img class="card-image-top" src="{{ $gallery->img_path }}">
                <div class="card-body">
                    <div class="d-flex mb-3">
                        @if(isset($gallery->user->profile->img_path))
                            <img class="rounded-circle mr-3" src="{{ asset( 'storage/profile_image/' .$gallery->user->profile->img_path) }}" width="50" height="50">
                        @else
                            <img class="rounded-circle mr-3" src="{{ asset( 'storage/image/79511279656599.png') }}" width="50" height="50">
                        @endif
                        <div class="ml-2 d-flex flex-column">
                            <a href="{{ url('user/users/' .$gallery->user->id) }}" class="mb-0 text-light">{{ $gallery->user->profile->display_name }}</a>
                            <a href="{{ url('user/users/' .$gallery->user->id) }}" class="text-secondary">＠{{ $gallery->user->name }}</a>
                        </div>
                        <div class="mb-0 text-secondary d-flex justify-content-end flex-grow-1">
                            {{ $gallery->created_at->format('Y-m-d H:i') }}
                        </div>
                    </div>
                    <h4 class="text-light">
                        {{ $gallery->title }}
                        <small class="text-muted">
                            {{ $gallery->areaName }}
                        </small>
                    </h4>
                    <div>
                    	@foreach($gallery->tags as $tag)
                        	<span class="badge badge-pill badge-info py-0">
                        	    <form class="d-flex" action="{{ url('user/galleries/search') }}" method="post">
                                    @csrf
                                    @method('GET')
                                    <input type="hidden" class="form-control me-2" type="search" aria-label="Search" name="keyword" value="{{ $tag->name }}">
                                    <button type="submit" class="btn btn-link text-body p-0"><small>{{ $tag->name }}</small></button>
                                </form>
                        	</span>
                        @endforeach
                    </div>
                    <p class="text-light">{!! nl2br(e($gallery->explanation)) !!}</p>
                </div>
                <div class="card-footer py-1 d-flex justify-content-end">
                    @if ($gallery->user->id === Auth::user()->id)
                        <div class="dropdown mr-3 d-flex align-items-center">
                            <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-fw"></i>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <form method="POST" action="{{ url('user/galleries/' .$gallery->id) }}" class="mb-0" id="delele">
                                    @csrf
                                    @method('DELETE')

                                    <a href="{{ url('user/galleries/' .$gallery->id .'/edit') }}" class="dropdown-item">編集</a>
                                    <button type="submit" class="dropdown-item del-btn" onclick="deleteConfirm('delele');return false">削除</button>
                                </form>
                            </div>
                        </div>
                    @endif
                    <div class="mr-3 d-flex align-items-center">
                        <a href="{{ url('user/galleries/' .$gallery->id) }}"><i class="far fa-comment fa-fw"></i></a>
                        <p class="mb-0 text-secondary">{{ count($gallery->comments) }}</p>
                    </div>
                    <div class="d-flex align-items-center">
                        @if (!$gallery->isFavorited(Auth::user()))
                            <span class="favorites">
                                <i class="far fa-heart fa-fw favorite-toggle text-primary LikesIcon-fa-heart" data-gallery-id="{{ $gallery->id }}"></i>
                                <span class="favorite-counter text-secondary">{{$gallery->favorites_count}}</span>
                            </span><!-- /.likes -->
                        @else
                        <span class="favorites">
                            <i class="fas fa-heart fa-fw favorite-toggle text-primary LikesIcon-fa-heart heart" data-gallery-id="{{ $gallery->id }}"></i>
                            <span class="favorite-counter text-secondary">{{$gallery->favorites_count}}</span>
                        </span><!-- /.likes -->
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
            <div class="col-md-8 mb-3">
                @if (session('flash_message'))
                    <div class="flash_message text-danger">
                        {{ session('flash_message') }}
                    </div>
                @endif
                <ul class="list-group">
                    <li class="list-group-item pt-0">
                        <div class="pb-3">
                            <form method="POST" action="{{ route('user.comments.store') }}">
                                @csrf
    
                                <div class="form-group row mb-0">
                                    <div class="col-md-12 p-3 w-100 d-flex">
                                        @if(isset($user->profile->img_path))
                                            <img class="rounded-circle mr-3" src="{{ asset( 'storage/profile_image/' .$user->profile->img_path) }}" width="50" height="50">
                                        @else
                                            <img class="rounded-circle mr-3" src="{{ asset( 'storage/image/79511279656599.png') }}" width="50" height="50">
                                        @endif
                                        <div class="ml-2 d-flex flex-column">
                                            <a href="{{ url('user/users/' .$user->id) }}" class="mb-0 text-light">@if(!empty($user->profile)){{ $user->profile->display_name }}@else匿名@endif</a>
                                            <a href="{{ url('user/users/' .$user->id) }}" class="text-secondary">＠{{ $user->name }}</a>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <input type="hidden" name="gallery_id" value="{{ $gallery->id }}">
                                        <textarea class="form-control @error('text') is-invalid @enderror" name="text" required autocomplete="text" rows="4">{{ old('text') }}</textarea>
    
                                        @error('text')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
    
                                <div class="form-group row mb-0">
                                    <div class="col-md-12 text-right">
                                        <p class="mb-4 text-danger">140文字以内</p>
                                        <button type="submit" class="btn btn-primary">
                                            コメントする
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </li>
                    @forelse ($comments as $comment)
                        <li class="list-group-item">
                            <div class="py-3 w-100 d-flex">
                                @if(isset($comment->user->profile->img_path))
                                    <img class="rounded-circle mr-3" src="{{ asset( 'storage/profile_image/' .$comment->user->profile->img_path) }}" width="50" height="50">
                                @else
                                    <img class="rounded-circle mr-3" src="{{ asset( 'storage/image/79511279656599.png') }}" width="50" height="50">
                                @endif
                                <div class="ml-2 d-flex flex-column">
                                    <a href="{{ url('user/users/' .$comment->user->id) }}" class="mb-0 text-light">{{ $comment->user->profile->display_name }}</a>
                                    <a href="{{ url('user/users/' .$comment->user->id) }}" class="text-secondary">＠{{ $comment->user->name }}</a>
                                </div>
                                <div class="d-flex justify-content-end flex-grow-1">
                                    <p class="mb-0 text-secondary mr-1">{{ $comment->created_at->format('Y-m-d H:i') }}</p>
                                    <div>
                                        @if(!in_array(Auth::user()->id, array_column($comment->reports->toArray(), 'user_id'), TRUE))
                                            <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-flag"></i></a>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <a href="{{ url('user/comments/' .$comment->id) }}" class="dropdown-item">報告する</a>
                                            </div>
                                        @else
                                            <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-flag text-danger"></i></a>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <form method="POST" action="{{ url('user/reports/' .array_column($comment->reports->toArray(), 'id', 'user_id')[Auth::user()->id]) }}" class="mb-0" id="delele">
                                                    @csrf
                                                    @method('DELETE')
                                                    
                                                    <button type="submit" class="dropdown-item del-btn">報告を取り消す</button>
                                                </form>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="py-3 text-light">
                                {!! nl2br(e($comment->text)) !!}
                            </div>
                        </li>
                    @empty
                        <li class="list-group-item">
                            <p class="mb-0 text-secondary">コメントはまだありません。</p>
                        </li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
