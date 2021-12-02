<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>Cポンポータル</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>

    <body>
        <header class="mb-4">
            <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
                <a class="navbar-brand" href="/">Cポンポータル</a>

                <form id="form" action="{{ route('search') }}" method="get">
                    {!! Form::text('freeword' ,'', ['class' => 's', 'placeholder' => '店舗名・商品で検索'] ) !!}
                    <button type="submit" id="sbtn2"><i class="fas fa-search"></i></button>
                </form>
            </nav>
        </header>

        <div class="container">
            @yield('content')
        </div>

        <footer>
            <table>
                <tr>
                <td><a href ="/">ヘルプ・お問い合わせ</a></td>
                <td><a href ="/">プライバシーポリシー</a></td>
                <td><a href ="/">CポンWEBAPP</a></td>
                </tr>
                <tr>
                <td><a href ="/">利用規約</a></td>
                <td></td>
                <td><a href ="/">Cポンモール</a></td>
                </tr>
            </table>
            <p>Cポンポータル</p>
            <p>copyright (c) © KOC・JAPAN, Inc. all rights reserved.</p>
        </footer>
        
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>