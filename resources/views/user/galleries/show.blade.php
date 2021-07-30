@extends('layouts.user.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <img class="card-image-top" src="{{ asset('storage/image/' .$gallery->img_path) }}">
                <div class="card-header d-flex w-100">
                    <div class="mb-0 d-flex pr-2">{{ $gallery->user->name }}</div>
                    <div class="mb-0 text-secondary d-flex justify-content-end flex-grow-1">
                        {{ $gallery->created_at->format('Y-m-d H:i') }}
                    </div>
                </div>
                <div class="card-body">
                    <h4>
                        {{ $gallery->title }}
                        <small class="text-muted">
                            {{ $gallery->areaName }}
                        </small>
                    </h4>
                    <p>{!! nl2br(e($gallery->explanation)) !!}</p>
                </div>
                <div class="card-footer">
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
