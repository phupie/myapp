@extends('layouts.user.app')

@section('title', 'ギャラリー投稿')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card text-light">
                <div class="card-header">投稿する</div>

                <div class="card-body">
                    
                    <form method="POST" action="{{ route('user.galleries.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group mb-0">
                            <label for="img">あなたの一枚<small class="text-danger">8MBまで！</small></label>
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
                        
                        <div class="form-group">
                            <label for="title">タイトル</label>
                            <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" required autocomplete="title" value="{{ old('title') }}">

                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <div class="form-group form-row">
                            <div class="col">
                                <label for="area">エリア</label>
                                <select id="area" type="text" class="parent form-control @error('area') is-invalid @enderror" name="areaName" required autocomplete="area">
                                        <option value="" class="text-body msg" disabled selected>-----エリアを選択してください-----</option>
                                    @foreach(config('area') as $index => $name)
                                        <option value="{{ $index }}">{{ $name }}</option>
                                    @endforeach
                                </select>
    
                                @error('area')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        
                            <div class="col">
                                <label class="text-muted mute" for="area-detail">リージョン <small>または</small> ID(インスタンスダンジョン)</label>
                                <select id="area-detail" type="text" class="children form-control @error('area-detail') is-invalid @enderror" name="detailArea" required autocomplete="area-detail" disabled>
                                        <option value="" class="msg" disabled selected>-----詳細なエリアを選択してください-----</option>
                                        <optgroup class="region text-dark" label="-----リージョン-----">
                                            @foreach(config('area-detail') as $index => $name)
                                                    @if($index < 230)
                                                        <option value="{{ $index }}" data-val="20">{{ $name }}</option>
                                                    @endif
                                            @endforeach
                                            @foreach(config('area-detail') as $index => $name)
                                                    @if(300 < $index && $index < 330)
                                                        <option value="{{ $index }}" data-val="30">{{ $name }}</option>
                                                    @endif
                                            @endforeach
                                            @foreach(config('area-detail') as $index => $name)
                                                    @if(400 < $index && $index < 430)
                                                        <option value="{{ $index }}" data-val="40">{{ $name }}</option>
                                                    @endif
                                            @endforeach
                                            @foreach(config('area-detail') as $index => $name)
                                                    @if(500 < $index && $index < 530)
                                                        <option value="{{ $index }}" data-val="50">{{ $name }}</option>
                                                    @endif
                                            @endforeach
                                        </optgroup>
                                        <optgroup class="id text-dark" label="-----ID(インスタンスダンジョン)-----">
                                            @foreach(config('area-detail') as $index => $name)
                                                    @if(230 <= $index && $index < 270)
                                                        <option value="{{ $index }}" data-val="20">{{ $name }}</option>
                                                    @endif
                                            @endforeach
                                            @foreach(config('area-detail') as $index => $name)
                                                    @if(330 <= $index && $index < 370)
                                                        <option value="{{ $index }}" data-val="30">{{ $name }}</option>
                                                    @endif
                                            @endforeach
                                            @foreach(config('area-detail') as $index => $name)
                                                    @if(430 <= $index && $index < 470)
                                                        <option value="{{ $index }}" data-val="40">{{ $name }}</option>
                                                    @endif
                                            @endforeach
                                            @foreach(config('area-detail') as $index => $name)
                                                    @if(530 <= $index && $index < 570)
                                                        <option value="{{ $index }}" data-val="50">{{ $name }}</option>
                                                    @endif
                                            @endforeach
                                        </optgroup>
                                </select>
                                
                                @error('area-detail')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="tags">タグ</label>
                            <input id="tags" type="tags" class="form-control" name="tags" value="{{ old('tags') }}" placeholder="例)#自然">
                            <small>※　「＃きれい」のように入力して下さい</small><br>
                            <small>※　複数入れる場合は＃で区切って入力して下さい</small>
                        </div>
                        
                        <div class="form-group">
                            <label for="explanation">説明文</label>
                            <input id="explanation" type="text" class="form-control @error('explanation') is-invalid @enderror" name="explanation" required autocomplete="explanation" value="{{ old('explanation') }}" placeholder="例)〇〇エリアのこの場所で撮りました！"　rows="4">
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
