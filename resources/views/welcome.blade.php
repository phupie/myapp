@extends('layouts.user.app')

@section('title', 'エオルゼア美術館')

@section('content')
<!-- Masthead-->
        <header class="masthead">
                <img src="{{ asset('storage/sample/GGpc6fd6hvRaFTsQM5hq1629528068-1629528327 (1).gif') }}" class="w-100" style="margin-top: -24px;"></img>
        </header>
        <!-- Icons Grid-->
        <div class="">
            <section class="features-icons text-center">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4">
                            <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
                                <img src="{{ asset('storage/sample/14_Primary_logo_on_transparent_414x63.png') }}">
                            </div>
                        </div>
                    </div>
                </div>
                <p class="lead mb-0 text-body">ここでは光の戦士たちがファイナルファンタジー１４で撮った風景を展示してもらいます<br>皆さんもどんどん飾ってここだけの美術館を作っていきましょう！</p>
            </section>
            <!-- Image Showcases-->
            <section class="showcase text-center">
                <div class="container p-0">
                    <h1 class="row pt-4 justify-content-center">投稿のルール</h1>
                    <div class="row g-0 mb-2">
                        <div class="col-lg-12 text-white" style="background-image: url('assets/img/bg-showcase-1.jpg')"></div>
                        <div class="col-lg-12 my-auto">
                            <h2>風景や建物が主役！！</h2>
                            <p class="lead mb-0">エオルゼア美術館ではその名の通り美術品を飾ってもらいたいです。<br>キャラクターが主役になっているスクリーンショットではなく、風景や建物を主役としたスクリーンショットを投稿しましょう！<br>（キャラクターを写す場合はあくまでアクセント）</p>
                        </div>
                    </div>
                    <div class="row g-0 mb-2">
                        <div class="col-lg-12 text-white" style="background-image: url('assets/img/bg-showcase-2.jpg')"></div>
                        <div class="col-lg-12 my-auto">
                            <h2>ゲーム内のグループポーズを活用しよう！</h2>
                            <p class="lead mb-0">FF14ではグループポーズというとても便利な機能があります。<br>それを活用して風景画のクオリティを上げましょう！ステッカー機能等も使用してかまいません。</p>
                        </div>
                    </div>
                    <div class="row g-0 mb-2">
                        <div class="col-lg-12 order-lg-2 text-white showcase-img" style="background-image: url('assets/img/bg-showcase-3.jpg')"></div>
                        <div class="col-lg-12 order-lg-1 my-auto showcase-text">
                            <h2>「イイ！ね」やコメントをしよう！</h2>
                            <p class="lead mb-0">他の人が投稿したギャラリーを気に入ったらイイねをしましょう！<br>また、コメントでここが好きというところを発言していきましょう！</p>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Testimonials-->
            <section class="testimonials text-center bg-light">
                <div class="container">
                    <h2 class="mb-3">さぁ、皆さんも新規登録・ログインして投稿していきましょう！</h2>
                    <div class="row">
                        @unless (Auth::guard('user')->check())
                                <div class="col-lg-12">
                                    <div class="testimonial-item mx-auto mb-5 mb-lg-1">
                                        <a class="btn btn-primary btn-lg btn-block" href="{{ route('user.login') }}">{{ __('Login') }}</a>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="testimonial-item mx-auto mb-5 mb-lg-0">
                                        <a class="btn btn-secondary btn-lg btn-block" href="{{ route('user.register') }}">{{ __('Register') }}</a>
                                    </div>
                                </div>
                            @else
                            <div class="col-lg-12">
                                <div class="testimonial-item mx-auto mb-5 mb-lg-0">
                                    <a class="btn btn-primary btn-lg btn-block" href="{{ url('user/galleries/create') }}">投稿する</a>
                                </div>
                            </div>
                        @endguest
                    </div>
                    @if(Auth::user())
                        <div class="d-flex justify-content-end">
                            <a href="{{ url('user/home/galleries') }}"><h3>ヒカセンのギャラリーを見る→</h3></a>
                        </div>
                    @endif
                </div>
            </section>
            <!-- Call to Action-->
        </div>
        <!-- Footer-->
        <footer class="footer bg-light">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 h-100 text-center text-lg-end my-auto">
                        <ul class="list-inline mb-0">
                            <li class="list-inline-item me-4">
                                <a href="#!"><i class="bi-facebook fs-3"></i></a>
                            </li>
                            <li class="list-inline-item me-4">
                                <a href="#!"><i class="bi-twitter fs-3"></i></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#!"><i class="bi-instagram fs-3"></i></a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-12 h-100 text-center text-lg-start my-auto">
                        <ul class="list-inline mb-2">
                            {{-- <li class="list-inline-item"><a href="#!">About</a></li>
                            <li class="list-inline-item">⋅</li>
                            <li class="list-inline-item"><a href="#!">Contact</a></li>
                            <li class="list-inline-item">⋅</li>
                            <li class="list-inline-item"><a href="#!">Terms of Use</a></li>
                            <li class="list-inline-item">⋅</li>
                            <li class="list-inline-item"><a href="#!">Privacy Policy</a></li> --}}
                        </ul>
                        <p class="text-muted small mb-4 mb-lg-0">&copy; Eorzea Museum 2021. All Rights Reserved.</p>
                    </div>
                </div>
            </div>
        </footer>
@endsection
