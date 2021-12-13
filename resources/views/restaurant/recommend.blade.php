@extends('restaurant.show')

@section('menu_list')

<nav class="menu_list_bar menu_list_bar_pc">
    <ul>
        <li class="menu_recommend current"><a href="#">イチオシメニュー</a></li>
        <li class="menu_all"><a href="{{ route('restaurant.show_allmenu', ['id' => $restaurant_id]) }}">メニュー一覧</a></li>
    </ul>
</nav>

<div id="menu_list_recommend">
    @foreach ($recommend_menus as $recommend_menu)
    <div class="menu_detail">
        <img src="{{ asset('img/shohin.png') }}" alt="">
        <div class="menu_name">{{ $recommend_menu->name }}</div>
        <div class="menu_price">￥{{ number_format($recommend_menu->price) }}</div>
        <div class="menu_explain">{{ $recommend_menu->explain }}</div>
        @if($recommend_menu->recommend_flg)
        <div class="recommend_mark">
        人気
        </div>
        @endif
    </div>
    @endforeach
</div>

@include('restaurant.comment_list', ['version' => 'pc'])

@endsection


@section('menu_list_ipad')

<nav class="menu_list_bar menu_list_bar_ipad">
    <ul>
        <li class="menu_recommend current"><a href="#">イチオシメニュー</a></li>
        <li class="menu_all"><a href="{{ route('restaurant.show_allmenu', ['id' => $restaurant_id]) }}">メニュー一覧</a></li>
    </ul>
</nav>

<div id="menu_list_recommend">
    @foreach ($recommend_menus as $recommend_menu)
    <div class="menu_detail_ipad">
        <img src="{{ asset('img/shohin.png') }}" alt="">
        <div class="menu_name">{{ $recommend_menu->name }}</div>
        <div class="menu_price">￥{{ number_format($recommend_menu->price) }}</div>
        <div class="menu_explain">{{ $recommend_menu->explain }}</div>
        @if($recommend_menu->recommend_flg)
        <div class="recommend_mark">
        人気
        </div>
        @endif
    </div>
    @endforeach
</div>

@include('restaurant.comment_list', ['version' => 'ipad'])

@endsection


