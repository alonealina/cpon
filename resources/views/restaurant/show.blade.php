@extends('layouts.app')
@section('content')

<p class="cpon_notice">店舗画像</p>

<div class="restaurant_show">
    <div class="restaurant_name">{{ $restaurant->name }}</div>
    <div class="restaurant_address">〒{{ $restaurant->zip }}　{{ $restaurant->address }}　
        <a href="https://www.google.com/maps/dir/{{ $restaurant->address }}" target=”_blank”>地図アプリで見る</a>
    </div>
    <div class="restaurant_time">
        @if($restaurant->opening_flg)
        OPEN
        @endif
        {{ $restaurant->open_hm }}～{{ $restaurant->close_hm }}
    </div>
    <div class="restaurant_comment">{{ $avg_star }} ({{ $comments->total() }} 評価)・{{ $category->name }}</div>
    <div class="restaurant_inquiry">ご予約・お問合せ　<a href="{{ $restaurant->url }}" target=”_blank”>{{ $restaurant->url }}</a>　{{ $restaurant->tel }}</div>
</div>

@yield('menu_list')
@yield('comment_form')

@endsection