@extends('layouts.app')

@section('back_button')
<div class="back_button">
    <a href="{{ route('restaurant.show', ['id' => $restaurant->id]) }}">←</a>
</div>
@endsection

@section('content_sp')

<div class="restaurant_show">
    <div class="restaurant_category">{{ $category->name }}</div>
    <div class="restaurant_name">{{ $restaurant->name1 }} {{ $restaurant->name2 }} {{ $restaurant->name3 }}</div>
    <div class="scene_commitment">
        @foreach ($restaurant_scenes as $name)
        <label class="label">{{ $name }}</label>
        @endforeach
        @foreach ($restaurant_commitments as $name)
        <label class="label">{{ $name }}</label>
        @endforeach
    </div>
    @if(!empty($restaurant->cpon_mall_url))
    <div class="cpon_mall_url">
        <a href="{{ $restaurant->cpon_mall_url }}" target="_blank">Cポンモール出店中</a>
    </div>
    @endif

    <nav class="info_list_bar info_list_bar_sp">
        <ul>
            <li class="info_basic current"><a><img src="{{ asset('img/icon/ie.png') }}" alt=""> 店舗基本情報</a></li>
            <li class="info_access"><a><img src="{{ asset('img/icon/access.png') }}" alt=""> アクセス情報</a></li>
            <li class="info_pay"><a><img src="{{ asset('img/icon/siharai.png') }}" alt=""> 支払い方法</a></li>
            <li class="info_other"><a><img src="{{ asset('img/icon/haguruma.png') }}" alt=""> 設備・その他の情報</a></li>
        </ul>
    </nav>
    <div class="info_list">
        <div id="info_list_basic">
            　所在地：〒{{ $restaurant->zip }}　{{ $restaurant->pref }}{{ $restaurant->address }}
            <a href="https://www.google.com/maps/dir/{{ $restaurant->pref }}{{ $restaurant->address }}" target="_blank">地図アプリで見る</a><br>
            電話番号：{{ $restaurant->tel }}<br>
            営業時間：{{ $restaurant->open_hm }}～{{ $restaurant->close_hm }}<br>
            {!! nl2br(e($restaurant->time_remarks)) !!}<br>
            　定休日：{{ $restaurant_holidays }}<br>
            　　予算：昼　{{ $restaurant->budget_lunch }}<br>
            　　　　　夜　{{ $restaurant->budget_dinner }}<br>
            　　評価：{{ $avg_star }} ({{ $comments->total() }} 評価)<br>
            WEBページ：<a href="{{ $restaurant->url }}" target="_blank">{{ $restaurant->url }}</a>
        </div>
        <div id="info_list_access" hidden>
            最寄り駅：{{ $restaurant_stations }}<br>
            アクセス：{!! nl2br(e($restaurant->access)) !!}<br>
            　駐車場：{!! nl2br(e($restaurant->parking)) !!}
        </div>
        <div id="info_list_pay" hidden>
            　クレジットカード：{{ $restaurant_cards }}<br>
            電子マネー・その他：{!! nl2br(e($restaurant->e_money)) !!}<br>
        </div>
        <div id="info_list_other" hidden>
            　　席数：{!! nl2br(e($restaurant->seats)) !!}<br>
            禁煙・喫煙：{!! nl2br(e($restaurant->smoking)) !!}<br>
            Cポンモール：<a href="{{ $restaurant->url }}" target="_blank">{{ $restaurant->cpon_mall_url }}</a><br>
            　その他：{!! nl2br(e($restaurant->other)) !!}
        </div>
    </div>
</div>
@include('restaurant.comment_list_latest5', ['version' => 'sp', 'px' => '60px'])

<script src="{{ asset('js/info.js') }}"></script>
@endsection
