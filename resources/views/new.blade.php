@extends('home')

@section('restaurant_list')

<p class="restaurant_list_title"><img src="{{ asset('img/icon/new.png') }}" alt="">新着店舗情報</p>
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
@if($news_count > 6)
<div class="d-flex justify-content-center">
{{ $news->links('pagination::default') }}
</div>
@endif
@endsection


@section('restaurant_list_ipad')

<p class="restaurant_list_title_ipad"><img src="{{ asset('img/icon/new.png') }}" alt="">新着店舗情報</p>
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
@if($news_count > 6)
<div class="d-flex justify-content-center">
{{ $news->links('pagination::default') }}
</div>
@endif
@endsection



@section('back_button')
<div class="back_button">
    <a href="{{ route('index') }}">←</a>
</div>
@endsection

@section('restaurant_list_sp')

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
@if($news_count > 6)
<div class="d-flex justify-content-center">
{{ $news->links('pagination::default') }}
</div>
@endif
<div class="button_black_sp">
    <a href="{{ route('index') }}">TOPに戻る</a>
</div>
@endsection