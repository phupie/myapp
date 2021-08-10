@extends('layouts.user.app')

@section('title', 'ギャラリー作成')

@section('content')
<script>
    function previewImage(obj)
    {
    	var fileReader = new FileReader();
    	fileReader.onload = (function() {
    		document.getElementById('preview').src = fileReader.result;
    	});
    	fileReader.readAsDataURL(obj.files[0]);
    }
</script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">投稿する</div>

                <div class="card-body">
                    
                    <form method="POST" action="{{ route('user.galleries.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group mb-0">
                            <label for="img">あなたの一枚</label>
                            <input class="form-control-file @error('img') is-invalid @enderror" type="file" name="img" onchange="previewImage(this);" autocomplete="img">
                            @error('img')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group m-0">
                            <img id="preview" class="w-100">
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="title">タイトル</label>
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" required autocomplete="title" value="{{ old('title') }}">

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="area">エリア</label>
                                <select id="area" type="text" class="form-control @error('area') is-invalid @enderror" name="areaName" required autocomplete="area">
                                    @foreach(config('area') as $index => $name)
                                        <option value="" hidden>エリアを選択してください▼</option>
                                        <option value="{{ $index }}">{{ $name }}</option>
                                    @endforeach
                                </select>

                                @error('area')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="tags">タグ</label>
                            <input id="tags" type="tags" class="form-control @error('tags') is-invalid @enderror" name="tags" required autocomplete="tags" value="{{ old('tags') }}">
                            @error('tags')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <div class="col-md-12">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="explanation">説明文</label>
                            <input id="explanation" type="text" class="form-control @error('explanation') is-invalid @enderror" name="explanation" required autocomplete="explanation" value="{{ old('explanation') }}" placeholder="例：〇〇エリアのこの場所で撮りました！"　rows="4">
                            @error('explanation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <div class="col-md-12">
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                投稿する
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
