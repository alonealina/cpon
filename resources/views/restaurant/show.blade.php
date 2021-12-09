@extends('layouts.app')
@section('content')

<p class="cpon_notice">店舗画像</p>

<div class="restaurant_show">
    <div class="restaurant_name">{{ $restaurant->name1 }} {{ $restaurant->name2 }} {{ $restaurant->name3 }}</div>
    
    <div class="restaurant_address">
        <img src="{{ asset('img/icon/tizu.png') }}" alt="">　
        〒{{ $restaurant->zip }}　{{ $restaurant->pref }}{{ $restaurant->address }}
        <a href="https://www.google.com/maps/dir/{{ $restaurant->pref }}{{ $restaurant->address }}" target=”_blank”>地図アプリで見る</a><br>
        {{ $restaurant->address_remarks }}
    </div>
    <img src="{{ asset('img/icon/tokei.png') }}" alt="">　
    @if($restaurant->opening_flg)
    <div class="open_mark">OPEN</div>
    @endif
    <div class="restaurant_time">
        　{{ $restaurant->open_hm }}～{{ $restaurant->close_hm }}　{{ $restaurant->time_remarks }}
    </div>
    <div class="restaurant_comment">
    <img src="{{ asset('img/icon/star.png') }}" alt="">　
    {{ $avg_star }} ({{ $comments->total() }} 評価)・{{ $category->name }}
    </div>
    <div class="restaurant_inquiry">
    <img src="{{ asset('img/icon/yotei.png') }}" alt="">　
    ご予約・お問合せ　<a href="{{ $restaurant->url }}" target=”_blank”>{{ $restaurant->url }}</a>　{{ $restaurant->tel }}
    　{{ $restaurant->inquiry_remarks }}
    </div>　

</div>

@yield('menu_list')
@yield('comment_form')

@endsection