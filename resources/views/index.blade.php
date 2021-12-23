@extends('home')

@section('banner')
<div class="banner">
    <ul class="slider_banner">
        @foreach($banners as $banner)
        <li><a href="{{ $banner->url }}"><img src="{{ asset('img/banner/'. $banner->img) }}" class="banner_img" alt=""></a></li>
        @endforeach
    </ul>
</div>
@endsection

@section('banner_ipad')
<div class="banner_ipad">
    <ul class="slider_banner_ipad">
        @foreach($banners as $banner)
        <li><a href="{{ $banner->url }}"><img src="{{ asset('img/banner/'. $banner->img) }}" class="banner_img" alt=""></a></li>
        @endforeach
    </ul>
</div>
@endsection

@section('banner_sp')
<div class="banner_sp">
    <ul class="slider_banner_sp">
        @foreach($banners as $banner)
        <li><a href="{{ $banner->url }}"><img src="{{ asset('img/banner/'. $banner->img) }}" class="banner_img" alt=""></a></li>
        @endforeach
    </ul>
</div>
@endsection




@section('restaurant_list')
<p class="restaurant_list_title">Cポンお店ナビからのおすすめ</p>
<div class="recommend_list">
    @foreach ($recommends as $recommend)
    <div class="recommend_restaurant">
    <a href="{{ route('restaurant.show', ['id' => $recommend->id]) }}">
        @if (empty($recommend->main_img))
        <img src="../../img/imgerror.jpg">
        @else
        <img src="../../restaurant/{{ $recommend->id }}/{{ $recommend->main_img }}">
        @endif
        <div class="recommend_name">{{ $recommend->name1 }} {{ $recommend->name2 }} {{ $recommend->name3 }}</div>
        <div class="recommend_address">〒{{ $recommend->zip }} {{ $recommend->pref }}{{ $recommend->address }}</div>
        <div class="recommend_time">営業時間　{{ $recommend->open_hm }} - {{ $recommend->close_hm }}　</div>
        @if($recommend->opening_flg)
        <div class="open_mark">OPEN</div>
        @else
        <div class="close_mark">CLOSE</div>
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
        @if (empty($new->main_img))
        <img src="../../img/imgerror.jpg">
        @else
        <img src="../../restaurant/{{ $new->id }}/{{ $new->main_img }}">
        @endif
        <div class="new_name">{{ $new->name1 }} {{ $new->name2 }} {{ $new->name3 }}</div>
        <div class="new_address">〒{{ $new->zip }} {{ $new->pref }}{{ $new->address }}</div>
        <div class="new_time">営業時間　{{ $new->open_hm }} - {{ $new->close_hm }}　</div>
        @if($new->opening_flg)
        <div class="open_mark">OPEN</div>
        @else
        <div class="close_mark">CLOSE</div>
        @endif
    </a>
    </div>
    @endforeach
</div>
<div class="button_black">
    <a href="{{ route('new') }}">新着店舗一覧</a>
</div>

<p class="center">Cポンお店ナビからのお知らせ</p>
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



@section('restaurant_list_ipad')
<p class="restaurant_list_title_ipad">Cポンお店ナビからのおすすめ</p>
<div class="recommend_list_ipad">
    @foreach ($recommends as $recommend)
    <div class="recommend_restaurant_ipad">
    <a href="{{ route('restaurant.show', ['id' => $recommend->id]) }}">
        @if (empty($recommend->main_img))
        <img src="../../img/imgerror.jpg">
        @else
        <img src="../../restaurant/{{ $recommend->id }}/{{ $recommend->main_img }}">
        @endif
        <div class="recommend_name">{{ $recommend->name1 }} {{ $recommend->name2 }} {{ $recommend->name3 }}</div>
        <div class="recommend_address">〒{{ $recommend->zip }} {{ $recommend->pref }}{{ $recommend->address }}</div>
        <div class="recommend_time">営業時間　{{ $recommend->open_hm }} - {{ $recommend->close_hm }}　</div>
        @if($recommend->opening_flg)
        <div class="open_mark">OPEN</div>
        @else
        <div class="close_mark">CLOSE</div>
        @endif
    </a>
    </div>
    @endforeach
</div>
<p class="restaurant_list_title_ipad">新着店舗情報</p>
<div class="new_list_ipad">
    @foreach ($news as $new)
    <div class="new_restaurant_ipad">
    <a href="{{ route('restaurant.show', ['id' => $new->id]) }}">
        @if (empty($new->main_img))
        <img src="../../img/imgerror.jpg">
        @else
        <img src="../../restaurant/{{ $new->id }}/{{ $new->main_img }}">
        @endif
        <div class="new_name">{{ $new->name1 }} {{ $new->name2 }} {{ $new->name3 }}</div>
        <div class="new_address">〒{{ $new->zip }} {{ $new->pref }}{{ $new->address }}</div>
        <div class="new_time">営業時間　{{ $new->open_hm }} - {{ $new->close_hm }}　</div>
        @if($new->opening_flg)
        <div class="open_mark">OPEN</div>
        @else
        <div class="close_mark">CLOSE</div>
        @endif
    </a>
    </div>
    @endforeach
</div>
<div class="button_black">
    <a href="{{ route('new') }}">新着店舗一覧</a>
</div>

<p class="center">Cポンお店ナビからのお知らせ</p>
<div class="notice_home_ipad">
    <hr>
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



@section('restaurant_list_sp')
<p class="restaurant_list_title_sp">Cポンお店ナビからのおすすめ</p>

@foreach ($recommends as $recommend)
<div class="recommend_restaurant_sp">
<a href="{{ route('restaurant.show', ['id' => $recommend->id]) }}">
    @if (empty($recommend->main_img))
    <img src="../../img/imgerror.jpg">
    @else
    <img src="../../restaurant/{{ $recommend->id }}/{{ $recommend->main_img }}">
    @endif
    <div class="recommend_name restaurant_name_sp">{{ $recommend->name1 }} {{ $recommend->name2 }} {{ $recommend->name3 }}</div>
    <div class="recommend_address_sp">〒{{ $recommend->zip }} {{ $recommend->pref }}{{ $recommend->address }}</div>
    <div class="recommend_time">営業時間　{{ $recommend->open_hm }} - {{ $recommend->close_hm }}　</div>
    @if($recommend->opening_flg)
    <div class="open_mark">OPEN</div>
    @else
    <div class="close_mark">CLOSE</div>
    @endif
</a>
</div>
@endforeach

<p class="restaurant_list_title_sp">新着店舗情報</p>

@foreach ($news as $new)
<div class="new_restaurant_sp">
<a href="{{ route('restaurant.show', ['id' => $new->id]) }}">
    @if (empty($new->main_img))
    <img src="../../img/imgerror.jpg">
    @else
    <img src="../../restaurant/{{ $new->id }}/{{ $new->main_img }}">
    @endif
    <div class="new_name restaurant_name_sp">{{ $new->name1 }} {{ $new->name2 }} {{ $new->name3 }}</div>
    <div class="new_address_sp">〒{{ $new->zip }} {{ $new->pref }}{{ $new->address }}</div>
    <div class="new_time">営業時間　{{ $new->open_hm }} - {{ $new->close_hm }}　</div>
    @if($new->opening_flg)
    <div class="open_mark">OPEN</div>
    @else
    <div class="close_mark">CLOSE</div>
    @endif
</a>
</div>
@endforeach

<div class="button_black_sp">
    <a href="{{ route('new') }}">新着店舗一覧</a>
</div>

<p class="index_notice_title_sp">Cポンお店ナビからのお知らせ</p>
<div class="notice_home_sp">
    <hr>
    @foreach ($notices as $notice)
    <a class="notice_home_list" href="{{ route('notice.show', ['id' => $notice->id]) }}">
        <div class="notice_date_sp">{{ $notice->notice_date }}</div>
        <div class="notice_title_sp">{{ $notice->title }}</div>
    </a>
    <hr>
    @endforeach
</div>
<div class="button_black_sp">
    <a href="{{ route('notice.index') }}">お知らせ一覧</a>
</div>
@endsection