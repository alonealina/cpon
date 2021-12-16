<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>Cポンポータル</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.7.1/css/lightbox.css" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <div class="loader-wrap">
        <div class="loader"></div>
        <div class="loader_text">Loading...</div>
    </div>
    <div id="registration_pc">
        <body>
            <header class="mb-4">
                <div class="header_black"></div>
                <div class="header_orange"></div>
                <nav class="navbar navbar-expand-sm header_content">
                    <a class="navbar-brand" href="/">
                        <img src="{{ asset('img/logo.png') }}" class="cpon_logo" alt="">
                    </a>

                    <form id="freeword_form" action="{{ route('search') }}" method="get">
                        {!! Form::text('freeword' ,'', ['class' => 'freeword_text', 'placeholder' => '店舗名・商品で検索'] ) !!}
                        <button type="submit" class="fas_search_button"><i class="fas fa-search"></i></button>
                    </form>
                </nav>
            </header>

            <div class="container">
                @yield('content')
            </div>

            <footer>
                <a href="/">
                    <img src="{{ asset('img/logo2.png') }}" class="cpon_logo2" alt="">
                </a>
                <div class="footer_menu">
                    <a href ="{{ route('help') }}">ヘルプ・お問い合わせ</a> ｜
                    <a href ="{{ route('terms') }}">利用規約</a> ｜
                    <a href ="{{ route('policy') }}">プライバシーポリシー</a> ｜
                    <a href ="https://app.cpon.co.jp/">CポンWEBAPP</a> ｜
                    <a href ="https://mall.cpon.co.jp/">Cポンモール</a>
                </div>
                <div class="copyright">copyright (c) © KOC・JAPAN, Inc. all rights reserved.</div>
                <div class="footer_black"></div>
            </footer>
        </body>
    </div>

    <div id="registration_ipad">
        <body>
            <header class="mb-4">
                <div class="header_black"></div>
                <div class="header_orange"></div>
                <div class="cpon_logo_div">
                    <a href="/">
                        <img src="{{ asset('img/logo.png') }}" class="cpon_logo_ipad" alt="">
                    </a>
                </div>
            </header>

            @yield('content_ipad')

            <footer>
                <a href="/">
                    <img src="{{ asset('img/logo2.png') }}" class="cpon_logo2" alt="">
                </a>
                <div class="footer_menu">
                    <a href ="{{ route('help') }}">ヘルプ・お問い合わせ</a> ｜
                    <a href ="{{ route('terms') }}">利用規約</a> ｜
                    <a href ="{{ route('policy') }}">プライバシーポリシー</a> ｜
                    <a href ="https://app.cpon.co.jp/">CポンWEBAPP</a> ｜
                    <a href ="https://mall.cpon.co.jp/">Cポンモール</a>
                </div>
                <div class="copyright">copyright (c) © KOC・JAPAN, Inc. all rights reserved.</div>
                <div class="footer_black"></div>
            </footer>
        </body>
    </div>

    <div id="registration_sp">
        <body>
            <header class="mb-4">
                <div class="header_black"></div>
                <div class="header_orange"></div>
                @yield('back_button')
                <div class="cpon_logo_div_sp">
                    <a href="/">
                        <img src="{{ asset('img/logo.png') }}" class="cpon_logo_sp" alt="">
                    </a>
                </div>
            </header>

            <div class="body_sp">
            @yield('content_sp')
            </div>

            <footer>

                <div class="footer_menu">
                    <a href ="{{ route('help') }}" class="footer_menu_sp">ヘルプ・お問い合わせ</a>
                    <a href ="{{ route('policy') }}" class="footer_menu_sp">プライバシーポリシー</a>
                    <a href ="{{ route('terms') }}" class="footer_menu_sp">利用規約</a>
                </div>
                <a href="/">
                    <img src="{{ asset('img/logo2.png') }}" class="cpon_logo2" alt="">
                </a>
                <div class="copyright">copyright (c) © KOC・JAPAN, Inc. all rights reserved.</div>
                <div class="footer_black"></div>
            </footer>
        </body>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.7.1/js/lightbox.min.js" type="text/javascript"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</html>