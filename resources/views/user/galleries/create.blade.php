@extends('layouts.user.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">投稿する</div>

                <div class="card-body">
                    
                    <form method="POST" action="{{ route('galleries.store') }}">
                        @csrf

                        <div class="form-group mb-0">
                            <label for="explanation">あなたの一枚</label>
                        </div>
                        
                        <div class="form-group m-0">
                            <input type="file" accept='image/*' onchange="previewImage(this);">
                        </div>
                        
                        <div class="form-group m-0">
                            <img id="preview" class="w-100">
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="title">タイトル</label>
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" required autocomplete="title" value="{{ old('title') }}">

                                @error('explanation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="area">エリア</label>
                                <select id="area" type="text" class="form-control @error('area') is-invalid @enderror" name="area" required autocomplete="area">
                                    @foreach(config('area') as $index => $name)
                                        <option value="" hidden>エリアを選択してください▼</option>
                                        <option value="{{ $index }}">{{ $name }}</option>
                                    @endforeach
                                </select>

                                @error('explanation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="explanation">説明文
                            </label>
                            <textarea id="explanation" type="text" class="form-control @error('explanation') is-invalid @enderror" name="explanation" required autocomplete="explanation" row="4">{{ old('explanation') }}
                            </textarea>
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
@endsection