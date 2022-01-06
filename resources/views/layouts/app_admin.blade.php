<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>Cポンお店ナビ</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">
        <link rel="icon" type="image/png" href="https://mall.cpon.co.jp/favicon.png">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.7.1/css/lightbox.css" rel="stylesheet">
        <link href="{{ asset('css/app_admin.css') }}" rel="stylesheet">
    </head>
    <!-- <div class="loader-wrap">
        <div class="loader"></div>
        <div class="loader_text">Loading...</div>
    </div> -->

    <body>
        @if(!empty(Session::get('login_id')))
        <header>
            <nav class="navbar">
                <a class="navbar-brand" href=""{{ route('admin.index') }}">
                    <img src="{{ asset('img/logo2.png') }}" class="cpon_logo" alt="">
                </a>
                <div class="header_user">
                    <div class="header_user_name"><img src="{{ asset('img/user.png') }}" class="" alt="">　{{ Session::get('name') }}　</div>

                    <div class="logout_button">
                        <a href="{{ route('admin.logout') }}">ログアウト</a>
                    </div>
                    
                </div>
            </nav>
        </header>
        @endif
        <div class="flexible-list">
            @if(!empty(Session::get('login_id')))
                <aside id="column-side" class="flexible-list-side">
                @include('admin.item.sidemenu')
                </aside>
            @endif
            <div class="flexible-list-main" id="flexible-list-main">
                @yield('content')
            </div>
        </div>

    </body>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.7.1/js/lightbox.min.js" type="text/javascript"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</html>