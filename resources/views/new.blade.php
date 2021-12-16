@extends('home')

@section('restaurant_list')

<p class="restaurant_list_title">新着店舗情報</p>
<div class="new_list">
    @foreach ($news as $new)
    <div class="new_restaurant">
    <a href="{{ route('restaurant.show', ['id' => $new->id]) }}">
        @if (empty($new->main_img))
        <img src="../../img/imgerror.jpg">
        @else
        <img src="../../img/restaurant/{{ $new->id }}/{{ $new->main_img }}">
        @endif
        <div class="new_name">{{ $new->name1 }} {{ $new->name2 }} {{ $new->name3 }}</div>
        <div class="new_address">〒{{ $new->zip }} {{ $new->pref }}{{ $new->address }}</div>
        <div class="new_time">{{ $new->open_hm }} - {{ $new->close_hm }}　</div>
        @if($new->opening_flg)
        <div class="open_mark">OPEN</div>
        @else
        <div class="close_mark">CLOSE</div>
        @endif
    </a>
    </div>
    @endforeach
</div>

@endsection


@section('restaurant_list_ipad')

<p class="restaurant_list_title_ipad">新着店舗情報</p>
<div class="new_list_ipad">
    @foreach ($news as $new)
    <div class="new_restaurant_ipad">
    <a href="{{ route('restaurant.show', ['id' => $new->id]) }}">
        @if (empty($new->main_img))
        <img src="../../img/imgerror.jpg">
        @else
        <img src="../../img/restaurant/{{ $new->id }}/{{ $new->main_img }}">
        @endif
        <div class="new_name">{{ $new->name1 }} {{ $new->name2 }} {{ $new->name3 }}</div>
        <div class="new_address">〒{{ $new->zip }} {{ $new->pref }}{{ $new->address }}</div>
        <div class="new_time">{{ $new->open_hm }} - {{ $new->close_hm }}　</div>
        @if($new->opening_flg)
        <div class="open_mark">OPEN</div>
        @else
        <div class="close_mark">CLOSE</div>
        @endif
    </a>
    </div>
    @endforeach
</div>

@endsection



@section('back_button')
<div class="back_button">
    <a href="{{ route('index') }}">←</a>
</div>
@endsection

@section('restaurant_list_sp')

<p class="restaurant_list_title_sp">新着店舗情報</p>
@foreach ($news_sp as $new_sp)
<div class="new_restaurant_sp">
    <a href="{{ route('restaurant.show', ['id' => $new_sp->id]) }}">
        @if (empty($new->main_img))
        <img src="../../img/imgerror.jpg">
        @else
        <img src="../../img/restaurant/{{ $new->id }}/{{ $new->main_img }}">
        @endif
        <div class="new_name restaurant_name_sp">{{ $new_sp->name1 }} {{ $new_sp->name2 }} {{ $new_sp->name3 }}</div>
        <div class="new_address_sp">〒{{ $new_sp->zip }} {{ $new_sp->pref }}{{ $new_sp->address }}</div>
        <div class="new_time">{{ $new_sp->open_hm }} - {{ $new_sp->close_hm }}　</div>
        @if($new_sp->opening_flg)
        <div class="open_mark">OPEN</div>
        @else
        <div class="close_mark">CLOSE</div>
        @endif
    </a>
</div>
@endforeach
<div class="d-flex justify-content-center">
{{ $news_sp->links('pagination::default') }}
</div>
<div class="button_black_sp">
    <a href="{{ route('index') }}">TOPに戻る</a>
</div>
@endsection