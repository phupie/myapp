@extends('layouts.user.app')

@section('content')
<section class="py-5 px-3">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row justify-content-center" data-masonry='{"percentPosition": true }'>
            @foreach($posts as $post)
                <div class="col mb-1 p-1">
                    <div class="card">
                        <!-- Product image-->
                        <img class="card-img-top" src="{{ asset('storage/image/' .$post->img_path) }}"/>
                        <!-- Product details-->
                        <div class="card-body">
                            <div class="d-flex justify-content-end flex-grow-1">
                                <p class="mb-0 text-secondary">{{ $post->created_at->format('Y-m-d H:i') }}</p>
                            </div>
                        </div>
                        <!-- Product actions-->
                        <div class="card-footer <!--p-4 pt-0 border-top-0 bg-transparent-->">
                            <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">View options</a></div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
