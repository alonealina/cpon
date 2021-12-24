<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>Cポンお店ナビ</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.7.1/css/lightbox.css" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Clamp.js/0.5.1/clamp.min.js"></script>
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
                        {!! Form::text('freeword' ,'', ['class' => 'freeword_text', 'placeholder' => 'キーワードで検索'] ) !!}
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
                    <a href ="https://app.cpon.co.jp/" target="_blank">CポンWEBAPP</a> ｜
                    <a href ="https://mall.cpon.co.jp/" target="_blank">Cポンモール</a>
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
                    <a href ="https://app.cpon.co.jp/" target="_blank">CポンWEBAPP</a> ｜
                    <a href ="https://mall.cpon.co.jp/" target="_blank">Cポンモール</a>
                </div>
                <div class="copyright">copyright (c) © KOC・JAPAN, Inc. all rights reserved.</div>
                <div class="footer_black"></div>
            </footer>
        </body>
    </div>

    <div id="registration_sp">
        <body>
            <header class="mb-4">
                <div class="header_black" id="page_top"></div>
                <div class="header_orange"></div>
                @yield('back_button')
                <div class="cpon_logo_div_sp">
                    <a href="/">
                        <img src="{{ asset('img/logo.png') }}" class="cpon_logo_sp" alt="">
                    </a>
                </div>
                <div class="hamburger-menu">
                    <input type="checkbox" id="menu-btn-check">
                    <label for="menu-btn-check" class="menu-btn"><span></span></label>
                    <div class="menu-content">
                        <ul>
                            <li>
                                <a href ="{{ route('help') }}" class="footer_menu_sp">ヘルプ・お問い合わせ</a>
                            </li>
                            <li>
                                <a href ="{{ route('policy') }}" class="footer_menu_sp">プライバシーポリシー</a>
                            </li>
                            <li>
                                <a href ="{{ route('terms') }}" class="footer_menu_sp">利用規約</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </header>

            <div class="body_sp">
            @yield('content_sp')
            </div>

            <footer class="footer_sp">
                <a href="#page_top">ページTOPへ</a>
                <div class="copyright">copyright (c) © KOC・JAPAN, Inc. all rights reserved.</div>
                <div class="footer_black"></div>
            </footer>
        </body>
        <div id="sp-fixed-menu" class="for-sp">
            <ul>
                <li class="sp_menu_home"><a href="{{ route('index') }}">
                    @if (\Route::currentRouteName() == 'index')
                    <img src="{{ asset('img/home_ore.png') }}" class="" alt="">
                    <br><font color="orange">ホーム</font>
                    @else
                    <img src="{{ asset('img/home.png') }}" class="" alt="">
                    <br>ホーム
                    @endif
                    </a>
                </li>
                <li class="sp_menu_search"><a href="{{ route('search_sp') }}">
                    @if (\Route::currentRouteName() == 'search_sp')
                    <img src="{{ asset('img/megane_ore.png') }}" class="" alt="">
                    <br><font color="orange">検索</font>
                    @else
                    <img src="{{ asset('img/search.png') }}" class="" alt="">
                    <br>検索
                    @endif
                    </a>
                </li>
                <li class="sp_menu_phone"><a href="https://app.cpon.co.jp/" target="_blank"><img src="{{ asset('img/phone.png') }}" class="" alt=""><br>CポンWEBAPPへ</a></li>
                <li class="sp_menu_mail"><a href="https://mall.cpon.co.jp/" target="_blank"><img src="{{ asset('img/mail.png') }}" class="" alt=""><br>Cポンモールへ</a></li>
            </ul>
        </div>
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