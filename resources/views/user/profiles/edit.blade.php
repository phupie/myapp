@extends('layouts.user.app')

@section('title', 'プロフィール作成')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>プロフィールを編集する</h1>
            <div class="card text-light">
                <div class="card-header">プロフィール</div>

                <div class="card-body">
                    
                    <form method="POST" action="{{ route('user.profiles.update', [$profiles->id]) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        
                        <label for="">ヘッダー画像</label>
                        <div id="input-form" class="form-group">
                            <div id="image-area border">
                                <label class="btn p-0 hover">
                                    <input type="file" id="image-head" name="image" accept="image/*" class="image-head" style="display:none;">
                                    <div id="image-style"　class="hover-img">
                                        <img src="{{ $profiles->head_img_path }}" id="image-output-head" class="w-100">
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
                                            <img src="{{ $profiles->img_path }}" id="image-output" class="rounded-circle w-100 fas fa-camera fa-2x" height="200px">
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
                                    <input id="display_name" type="text" class="form-control @error('display_name') is-invalid @enderror" name="display_name" required autocomplete="display_name" value="{{ $profiles->display_name }}">
        
                                    @error('display_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="job">メインジョブ</label>
                                    <select id="job" type="text" class="form-control @error('job') is-invalid @enderror" name="jobName" required autocomplete="job">
                                        <option value="{{ $profiles->main_job }}" hidden>{{ $profiles->jobName }}</option>
                                        <optgroup label="-TANK-" class="text-primary">
                                        </optgroup>
                                            @foreach(config('job') as $index => $name)
                                                @if($index < 30)
                                                    <option value="{{ $index }}">{{ $name }}</option>
                                                @endif
                                            @endforeach
                                        <optgroup label="-HEALER-" class="text-success">
                                        </optgroup>
                                            @foreach(config('job') as $index => $name)
                                                @if(30 <= $index && $index < 50)
                                                    <option value="{{ $index }}">{{ $name }}</option>
                                                @endif
                                            @endforeach
                                        <optgroup label="-DPS-" class="text-danger">
                                        </optgroup>
                                            @foreach(config('job') as $index => $name)
                                                @if(50 <= $index)
                                                    <option value="{{ $index }}">{{ $name }}</option>
                                                @endif
                                            @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="story">ストーリー進行度</label>
                                    <select id="story" type="text" class="form-control @error('story') is-invalid @enderror" name="storyName" required autocomplete="story">
                                            <option value="{{ $profiles->story_progress }}" hidden>{{ $profiles->storyName }}</option>
                                        @foreach(config('story') as $index => $name)
                                            <option value="{{ $index }}">{{ $name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                        </div>
                        
                        <div class="form-group">
                            <label for="introduction">自己紹介
                            </label>
                            <textarea id="introduction" type="text" class="form-control @error('introduction') is-invalid @enderror" name="introduction" required autocomplete="introduction" row="4">{{ $profiles->introduction }}
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
                                編集
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
