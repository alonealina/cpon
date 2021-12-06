@extends('home')

@section('banner')
<div class="banner">
    <ul class="slider_banner">
        <li><img src="{{ asset('img/banner_test.png') }}" alt=""></li>
        <li><img src="{{ asset('img/banner_test.png') }}" alt=""></li>
        <li><img src="{{ asset('img/banner_test.png') }}" alt=""></li>
        <li><img src="{{ asset('img/banner_test.png') }}" alt=""></li>
        <li><img src="{{ asset('img/banner_test.png') }}" alt=""></li>
        <li><img src="{{ asset('img/banner_test.png') }}" alt=""></li>
    </ul>
</div>
@endsection

@section('restaurant_list')
<p class="restaurant_list_title">Cポンポータルからのおすすめ</p>
<div class="recommend_list">
    @foreach ($recommends as $recommend)
    <div class="recommend_restaurant">
    <a href="{{ route('restaurant.show', ['id' => $recommend->id]) }}">
        <img src="{{ asset('img/tempo1.png') }}" alt="">
        <div class="recommend_name">{{ $recommend->name }}</div>
        <div class="recommend_address">〒{{ $recommend->zip }} {{ $recommend->pref }}{{ $recommend->address }}</div>
        <div class="recommend_time">{{ $recommend->open_hm }} - {{ $recommend->close_hm }}　</div>
        @if($recommend->opening_flg)
        <div class="open_mark">OPEN</div>
        @endif
    </a>
    </div>
    @endforeach
</div>
<p class="restaurant_list_title">新着店舗情報</p>
<div class="new_list">
    @foreach ($news as $new)
    <div class="new_restaurant">
    <a href="{{ route('restaurant.show', ['id' => $new->id]) }}">
        <img src="{{ asset('img/tempo1.png') }}" alt="">
        <div class="new_name">{{ $new->name }}</div>
        <div class="new_address">〒{{ $new->zip }} {{ $new->pref }}{{ $new->address }}</div>
        <div class="new_time">{{ $new->open_hm }} - {{ $new->close_hm }}　</div>
        @if($new->opening_flg)
        <div class="open_mark">OPEN</div>
        @endif
    </a>
    </div>
    @endforeach
</div>
<div class="button_black">
    <a href="{{ route('new') }}">新着店舗一覧</a>
</div>

<p class="center">Cポンポータルからのお知らせ</p>
<hr>
<div class="notice_home">
    @foreach ($notices as $notice)
    <a class="notice_home_list" href="{{ route('notice.show', ['id' => $notice->id]) }}">
        <div class="notice_date">{{ $notice->notice_date }}</div>
        <div class="notice_title">{{ $notice->title }}</div>
    </a>
    <hr>
    @endforeach
</div>
<div class="button_black">
    <a href="{{ route('notice.index') }}">お知らせ一覧</a>
</div>
@endsection