@extends('layouts.admin.app')

@section('content')
<div class="container-fluid">
    <h1 class="display-3 font-italic">Gallery</h1>
    <div class="row">
        @if(isset($galleries))
            @foreach ($galleries as $gallery)
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-img-top w-100">
                            <img class="w-100" src="{{ $gallery->img_path }}">
                        </div>
                        <form method="POST" action="{{ route('admin.galleries.destroy' ,$gallery->id) }}" class="ml-auto card-footer" id="{{ $loop->index }}">
                            @csrf
                            @method('DELETE')
        
                            <button type="submit" class="btn btn-danger" onclick="deleteConfirm({{$loop->index}});return false;">削除</button>
                        </form>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
    <div class="my-4 d-flex justify-content-center">
        {{ $galleries->links() }}
    </div>
</div>
@endsection
