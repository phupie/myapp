@extends('layouts.user.app')

@section('title', 'コメント報告')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 text-light">
            <div class="card">
                <div class="card-header">コメントの報告</div>
                <div class="card-body">
                    <div class="py-3 w-100 d-flex">
                        @if(isset($comment->user->profile->img_path))
                            <img class="rounded-circle mr-3" src="{{ $comment->user->profile->img_path }}" width="50" height="50">
                        @else
                            <img class="rounded-circle mr-3" src="https://myappff14.s3.ap-northeast-1.amazonaws.com/+material/79511279656599.png" width="50" height="50">
                        @endif
                        <div class="ml-2 d-flex flex-column">
                            @if(isset($comment->user->profile))
                                <a href="{{ url('user/users/' .$comment->user->id) }}" class="mb-0 text-light">{{ $comment->user->profile->display_name }}</a>
                            @endif
                            <a href="{{ url('user/users/' .$comment->user->id) }}" class="text-secondary">＠{{ $comment->user->name }}</a>
                        </div>
                        <div class="d-flex justify-content-end flex-grow-1">
                            <p class="mb-0 text-secondary">{{ $comment->created_at->format('Y-m-d H:i') }}</p>
                        </div>
                    </div>
                    <div class="py-3 text-light">
                        {!! nl2br(e($comment->text)) !!}
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    
                    <form method="POST" action="{{ route('user.reports.store') }}">
                        @csrf
                        
                        <div class="form-group">
                            <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                            <input type="hidden" name="gallery_id" value="{{ $comment->gallery_id }}">
                            <label for="report">内容</label>
                            <select id="report" type="text" class="form-control @error('report') is-invalid @enderror" name="name_category" required autocomplete="report">
                                @foreach(config('report') as $index => $name)
                                    <option value="" hidden>内容を選択してください▼</option>
                                    <option value="{{ $index }}">{{ $name }}</option>
                                @endforeach
                            </select>

                            @error('report')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="text">詳細</label>
                            <input id="text" type="text" class="form-control" name="text" value="{{ old('text') }}" placeholder="その他の場合は詳細を記入" rows="4">
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                報告する
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
