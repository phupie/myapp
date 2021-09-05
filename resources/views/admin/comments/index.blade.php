@extends('layouts.admin.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="display-3 font-italic">Comment</h1>
            @if(isset($repoorts))
                @foreach ($reports as $report)
                    <div class="card">
                        <div class="card-body p-3 w-100 d-flex">
                            @if(isset($report->comment->user->profile->img_path))
                                <img class="rounded-circle mr-3" src="{{ $report->comment->user->profile->img_path }}" width="50" height="50">
                            @else
                                <img class="rounded-circle mr-3" src="{{ asset( 'storage/image/79511279656599.png') }}" width="50" height="50">
                            @endif
                            <div class="d-flex flex-column">
                                <a href="" class="text-secondary">＠{{ $report->comment->user->name }}</a>
                            </div>
                            <div class="ml-5 d-flex flex-column">
                                <label>内容</label>
                                <p>{{ $report->comment->text }}</p>
                            </div>
                            <form method="POST" action="{{ route('admin.comments.destroy' ,$report->comment->id) }}" class="ml-auto" id="{{ $loop->index }}">
                                @csrf
                                @method('DELETE')
    
                                <button type="submit" class="btn btn-danger" onclick="deleteConfirm({{$loop->index}});return false;">削除</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    <div class="my-4 d-flex justify-content-center">
        {{ $reports->links() }}
    </div>
</div>
@endsection
