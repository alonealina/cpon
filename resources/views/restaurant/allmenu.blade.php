@extends('restaurant.show')

@section('menu_list')

<nav class="menu_list_bar menu_list_bar_pc" id="menu_list_bar">
    <ul>
        <li class="menu_recommend"><a href="{{ route('restaurant.show', ['id' => $restaurant_id]) }}">イチオシメニュー</a></li>
        <li class="menu_all current"><a href="#">メニュー一覧</a></li>
    </ul>
</nav>

<div id="menu_list_all">
    @foreach ($menus as $menu)
    <div class="menu_detail">
        <img src="{{ asset('img/shohin.png') }}" alt="">
        <div class="menu_name">{{ $menu->name }}</div>
        <div class="menu_price">￥{{ number_format($menu->price) }}</div>
        <div class="menu_explain">{{ $menu->explain }}</div>
    </div>
    @endforeach
</div>

<div class="d-flex justify-content-center">
{{ $menus->links('pagination::menu_list') }}
</div>

@include('restaurant.comment_list', ['version' => 'pc', 'pagename' => 'show_allmenu'])

@endsection


@section('menu_list_ipad')

<nav class="menu_list_bar menu_list_bar_ipad">
    <ul>
        <li class="menu_recommend"><a href="{{ route('restaurant.show', ['id' => $restaurant_id]) }}">イチオシメニュー</a></li>
        <li class="menu_all current"><a href="#">メニュー一覧</a></li>
    </ul>
</nav>

<div id="menu_list_all">
    @foreach ($menus as $menu)
    <div class="menu_detail_ipad">
        <img src="{{ asset('img/shohin.png') }}" alt="">
        <div class="menu_name">{{ $menu->name }}</div>
        <div class="menu_price">￥{{ number_format($menu->price) }}</div>
        <div class="menu_explain">{{ $menu->explain }}</div>
    </div>
    @endforeach
</div>

<div class="d-flex justify-content-center">
{{ $menus->links('pagination::menu_list') }}
</div>

@include('restaurant.comment_list', ['version' => 'ipad', 'pagename' => 'show_allmenu'])

@endsection


@section('menu_list_sp')

<nav class="menu_list_bar menu_list_bar_sp">
    <ul>
        <li class="menu_recommend"><a href="{{ route('restaurant.show', ['id' => $restaurant_id]) }}">イチオシメニュー</a></li>
        <li class="menu_all current"><a href="#">メニュー一覧</a></li>
    </ul>
</nav>

@foreach ($menus as $menu)
<div class="menu_detail_sp">
<img src="{{ asset('img/shohin.png') }}" alt="">
    <div class="menu_name_sp">{{ $menu->name }}</div>
    <div class="menu_price_sp">￥{{ number_format($menu->price) }}</div>
    <div class="menu_explain_sp">{{ $menu->explain }}</div>
</div>
@endforeach

<div class="d-flex justify-content-center">
{{ $menus->links('pagination::menu_list') }}
</div>

@endsection

