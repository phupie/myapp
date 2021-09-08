@extends('layouts.user.app')

@section('title', 'プロフィール作成')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>プロフィールを作成しましょう</h1>
            <div class="card text-light">
                <div class="card-header">プロフィール</div>

                <div class="card-body">
                    
                    <form method="POST" action="{{ route('user.profiles.store') }}" enctype="multipart/form-data">
                        @csrf

                        
                        <label for="">ヘッダー画像</label>
                        <div id="input-form" class="form-group">
                            <div id="image-area border">
                                <label class="btn p-0 hover">
                                    <input type="file" id="image-head" name="image" accept="image/*" class="image-head" style="display:none;">
                                    <div id="image-style"　class="hover-img">
                                        <img src="https://myappff14.s3.ap-northeast-1.amazonaws.com/+material/795112796565.png" id="image-output-head" class="w-100">
                                    </div>
                                    <div class="hover-text  d-flex align-items-center justify-content-center">
                                        <p class="text1 p-0"><i class="fas fa-camera fa-2x"></i></p>
                                    </div>
                                </label>
                            </div>
                            <div id="main mt-0">
                                <div class="modal fade" id="cropImagePop-head" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content center-block">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <div id="upload-demo-head" class="center-block"></div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="modal-btn-cancel" data-dismiss="modal">キャンセル</button>
                                                <button type="button" id="cropImageBtn-head" class="modal-bton-crop">決定</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" id="cropImage-head" name="head_img" value="" />
                        </div>
                        <label for="">プロフィール画像</label>
                        <div class="form-row pl-1">
                            <div id="input-form" class="form-group col-md-4 d-flex  align-items-center justify-content-center">
                                <div id="image-area" class="row justify-content-center m-0">
                                    <label class="btn p-0 m-0 hover">
                                        <input type="file" id="image" name="image" accept="image/*" class="image" style="display:none;">
                                        <div id="image-style" width="200px" height="200px">
                                            <img src="https://myappff14.s3.ap-northeast-1.amazonaws.com/+material/79511279656599.png" id="image-output" class="rounded-circle w-100 fas fa-camera fa-2x" height="200px">
                                        </div>
                                        <div class="hover-text rounded-circle d-flex align-items-center justify-content-center">
                                            <p class="text1 m-0"><i class="fas fa-camera fa-2x"></i></p>
                                        </div>
                                    </label>
                                </div>
                                <div id="main mt-0">
                                    <div class="modal fade" id="cropImagePop" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content center-block">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div id="upload-demo" class="center-block"></div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="modal-btn-cancel" data-dismiss="modal">キャンセル</button>
                                                    <button type="button" id="cropImageBtn" class="modal-bton-crop">決定</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <input type="hidden" id="cropImage" name="img" value=""/>
                                </div>
                            </div>
                            <div class="form-group col-md-8">
                                <div class="form-group">
                                    <label for="display_name">アカウント名<small class="text-secondary ml-1">表示名</small></label>
                                    <input id="display_name" type="text" class="form-control @error('display_name') is-invalid @enderror" name="display_name" required autocomplete="display_name" value="{{ old('display_name') }}">
        
                                    @error('display_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="job">メインジョブ</label>
                                    <select id="job" type="text" class="form-control @error('job') is-invalid @enderror" name="jobName" required autocomplete="job">
                                            <option value="" hidden>メインジョブを選択してください</option>
                                            <optgroup label="TANK" class="text-primary">
                                                @foreach(config('job') as $index => $name)
                                                    @if($index < 30)
                                                        <option value="{{ $index }}">{{ $name }}</option>
                                                    @endif
                                                @endforeach
                                            </optgroup>
                                            <optgroup label="HEALER" class="text-success">
                                                @foreach(config('job') as $index => $name)
                                                    @if(30 <= $index && $index < 50)
                                                        <option value="{{ $index }}">{{ $name }}</option>
                                                    @endif
                                                @endforeach
                                            </optgroup>
                                            <optgroup label="DPS" class="text-danger">
                                                @foreach(config('job') as $index => $name)
                                                    @if(50 <= $index)
                                                        <option value="{{ $index }}">{{ $name }}</option>
                                                    @endif
                                                @endforeach
                                            </optgroup>
                                    </select>
        
                                    @error('job')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="story">ストーリー進行度</label>
                                    <select id="story" type="text" class="form-control @error('story') is-invalid @enderror" name="storyName" required autocomplete="area">
                                            <option value="" hidden>選択してください</option>
                                        @foreach(config('story') as $index => $name)
                                            <option value="{{ $index }}">{{ $name }}</option>
                                        @endforeach
                                    </select>
        
                                    @error('story')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                        </div>
                        
                        <div class="form-group">
                            <label for="introduction">自己紹介
                            </label>
                            <textarea id="introduction" type="text" class="form-control @error('introduction') is-invalid @enderror" name="introduction" required autocomplete="introduction" row="4">よろしくお願いします。{{ old('introduction') }}
                            </textarea>
                            @error('introduction')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <div class="col-md-12">
                            </div>
                        </div>
    
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                作成
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
