@extends('layouts.user.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <img class="card-image-top" src="{{ asset('storage/image/' .$galleries->img_path) }}">
                <div class="card-header d-flex w-100">
                    <div class="mb-0 d-flex pr-2">{{ $galleries->user->name }}</div>
                    <div class="mb-0 text-secondary d-flex justify-content-end flex-grow-1">
                        {{ $galleries->created_at->format('Y-m-d H:i') }}
                    </div>
                </div>
                <div class="card-body">
                    <h4>
                        {{ $galleries->title }}
                        <small class="text-muted">
                            {{ $galleries->areaName }}
                        </small>
                    </h4>
                    <p>{!! nl2br(e($galleries->explanation)) !!}</p>
                </div>
                <div class="card-footer py-1 d-flex justify-content-end">
                    @if ($galleries->user->id === Auth::user()->id)
                        <div class="dropdown mr-3 d-flex align-items-center">
                            <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-fw"></i>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <form method="POST" action="{{ url('user/galleries/' .$galleries->id) }}" class="mb-0" id="delele">
                                    @csrf
                                    @method('DELETE')

                                    <a href="{{ url('user/galleries/' .$galleries->id .'/edit') }}" class="dropdown-item">編集</a>
                                    <button type="submit" class="dropdown-item del-btn" onclick="deleteConfirm('delele');return false">削除</button>
                                </form>
                            </div>
                        <div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
