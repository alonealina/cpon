@extends('restaurant.show')

@section('menu_list')

<nav class="menu_list_bar">
    <ul>
        <li class="menu_recommend"><a href="{{ route('restaurant.show', ['id' => $restaurant_id]) }}">あなたへのおすすめ</a></li>
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
        @if($menu->recommend_flg)
        <div class="recommend_mark">
        人気
        </div>
        @endif
    </div>
    @endforeach
</div>

<div class="d-flex justify-content-center">
{{ $menus->links('pagination::bootstrap-4') }}
</div>

@include('restaurant.comment_list')

@endsection