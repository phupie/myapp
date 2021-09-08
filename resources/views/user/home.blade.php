@extends('layouts.user.app')

@section('title', 'ようこそ')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card text-light">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    ログインしました！
                    @if(empty(Auth::user()->profile))
                        次にプロフィールを作成しましょう！
                    @endif
                </div>
                <div class="card-footer d-flex justify-content-end align-items-center">
                    @if(empty(Auth::user()->profile))
                        <div class="mr-auto">
                            <a href="{{ url('user/profiles/create') }}" class="btn btn-primary">
                                プロフィールを作成する
                            </a>
                        </div>
                        <div class="">
                            <a href="{{ url('/') }}">
                                スキップ    
                            </a>
                        </div>
                    @else
                        <a href="{{ url('/') }}">
                            トップへ    
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
