@extends('layouts.user.app')

@section('content')
<div class="display-3 font-italic text-center">Gallery</div>
<div class="container-fluid px-4 px-lg-5 mt-5">
    <div class="row row-cols-md-2 row-cols-xl-3" data-masonry='{"percentPosition": true }'>
        @foreach($posts as $post)
            <div class="col mb-1 p-1">
                <div class="card">
                    <!-- Product image-->
                    <a href="{{ url('user/galleries/' .$post->id) }}"><img class="card-img-top" src="{{ asset('storage/image/' .$post->img_path) }}"/></a>
                    <!-- Product details-->
                    <div class="card-footer d-flex bd-highlight w-100">
                        <div class="mb-0 bd-highlight pr-2">{{ $post->user->name }}</div>
                        <div class="mb-0 text-secondary bd-highlight mr-auto small py-1">
                            {{ $post->created_at->format('Y-m-d H:i') }}
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
