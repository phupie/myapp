@extends('layouts.user.app')

@section('content')
<h1 class="display-3 font-italic text-center">タグ一覧</h1>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <ul class="list-group text-light">
                @if (isset($tags))
                    @foreach($tags as $tag)
                        <li class="list-group-item d-flex justify-content-between">
                            <form class="d-flex" action="{{ url('user/galleries/search') }}" method="post">
                                @csrf
                                @method('GET')
                                <input type="hidden" class="form-control me-2" type="search" aria-label="Search" name="keyword" value="{{ $tag->name }}">
                                <button type="submit" class="btn btn-link text-light py-0">
                                    {{ $tag->name }}
                                </button>
                            </form>
                            <h5 class="my-0">
                                <span class="badge bg-secondary my-auto">{{ $tag->galleries_count }}件</span>
                            </h5>
                        </li>
                    @endforeach
                @endif
            </ul>
        </div>
    </div>
</div>
@endsection
