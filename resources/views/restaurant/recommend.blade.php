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
        @if (empty($recommend_menu->img))
        <img src="../../img/imgerror.jpg">
        @else
        <img src="../../restaurant/{{ $restaurant->id }}/menu/{{ $recommend_menu->img }}" alt="">
        @endif
        <div class="menu_name">{{ $recommend_menu->name }}</div>
        <div class="menu_price">￥{{ number_format($recommend_menu->price) }}</div>
        <div class="menu_explain">{{ $recommend_menu->explain }}</div>
    </div>
    @endforeach
</div>

@include('restaurant.comment_list_latest5', ['version' => 'pc', 'px' => '100px'])

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
        @if (empty($recommend_menu->img))
        <img src="../../img/imgerror.jpg">
        @else
        <img src="../../restaurant/{{ $restaurant->id }}/menu/{{ $recommend_menu->img }}" alt="">
        @endif
        <div class="menu_name">{{ $recommend_menu->name }}</div>
        <div class="menu_price">￥{{ number_format($recommend_menu->price) }}</div>
        <div class="menu_explain">{{ $recommend_menu->explain }}</div>
    </div>
    @endforeach
</div>

@include('restaurant.comment_list_latest5', ['version' => 'ipad', 'px' => '100px'])

@endsection


@section('menu_list_sp')

<nav class="menu_list_bar menu_list_bar_sp">
    <ul>
        <li class="menu_recommend current"><a href="#">イチオシメニュー</a></li>
        <li class="menu_all"><a href="{{ route('restaurant.show_allmenu', ['id' => $restaurant_id]) }}">メニュー一覧</a></li>
    </ul>
</nav>

@foreach ($recommend_menus as $recommend_menu)
<div class="menu_detail_sp">
    @if (empty($recommend_menu->img))
    <img src="../../img/imgerror.jpg">
    @else
    <img src="../../restaurant/{{ $restaurant->id }}/menu/{{ $recommend_menu->img }}" alt="">
    @endif
    <div class="menu_name_sp">{{ $recommend_menu->name }}</div>
    <div class="menu_price_sp">￥{{ number_format($recommend_menu->price) }}</div>
    <div class="menu_explain_sp">{{ $recommend_menu->explain }}</div>
</div>
@endforeach

@endsection
