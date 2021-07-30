@extends('layouts.user.app')

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
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">編集する</div>

                <div class="card-body">
                    
                    <form method="POST" action="{{ route('user.galleries.update', [$galleries->id]) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-0">
                            <label for="img">あなたの一枚</label>
                            <input type="file" hidden id="img" name="img" readonly>
                            <img class="w-100" src="{{ asset('storage/image/' .$galleries->img_path)}}">
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="title">タイトル</label>
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" required autocomplete="title" value="{{ old('title') ? : $galleries->title}}">

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
                                        <option value="" hidden>{{ $galleries->areaName }}</option>
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
                            <label for="explanation">説明文
                            </label>
                            <textarea id="explanation" type="text" class="form-control @error('explanation') is-invalid @enderror" name="explanation" required autocomplete="explanation" row="4">{{ old('explanation') ? : $galleries->explanation }}
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
                                編集する
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
