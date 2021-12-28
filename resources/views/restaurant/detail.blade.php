@extends('layouts.app')

@section('back_button')
<div class="back_button">
    <a href="{{ route('restaurant.show', ['id' => $restaurant->id]) }}">←</a>
</div>
@endsection

@section('content_sp')

<div class="restaurant_show">
    <div style="width:350px;"><div style="float:left;" class="restaurant_category_sp">{{ $category->name }}</div><br>
    <div style="width:350px;"><div class="restaurant_name_sp2">{{ $restaurant->name1 }} {{ $restaurant->name2 }} {{ $restaurant->name3 }}</div></div>
    <div class="scene_commitment">
        @foreach ($restaurant_scenes as $name)
        <div style="text-align:left;"><label class="label">{{ $name }}</label></div>
        @endforeach
        @foreach ($restaurant_commitments as $name)
        <div style="text-align:left;"><label class="label">{{ $name }}</label></div>
        @endforeach
    </div>
    @if(!empty($restaurant->cpon_mall_url))
    <div style="width:350px;text-align:left;"><div class="cpon_mall_url_sp">
        <a href="{{ $restaurant->cpon_mall_url }}" target="_blank">Cポンモール出店中</a>
    </div></div>
    @endif
<br>
    <nav class="info_list_bar info_list_bar_sp">
        <ul>
            <li class="info_basic current"><a>
                <img src="{{ asset('img/icon/ie.png') }}" id="img_basic" hidden>
                <img src="{{ asset('img/icon/ie_c.png') }}" id="img_basic_current"> 店舗基本情報</a></li>
            <li class="info_access"><a>
                <img src="{{ asset('img/icon/access.png') }}" id="img_access">
                <img src="{{ asset('img/icon/access_c.png') }}" id="img_access_current" hidden> アクセス情報</a></li>
            <li class="info_pay"><a>
                <img src="{{ asset('img/icon/siharai.png') }}" id="img_siharai">
                <img src="{{ asset('img/icon/siharai_c.png') }}" id="img_siharai_current" hidden> 支払い方法</a></li>
            <li class="info_other"><a>
                <img src="{{ asset('img/icon/haguruma.png') }}" id="img_haguruma">
                <img src="{{ asset('img/icon/haguruma_c.png') }}" id="img_haguruma_current" hidden> 設備・その他の情報</a></li>
        </ul>
    </nav>
    <div class="info_list_sp">
        <div id="info_list_basic">
            　所在地：〒{{ $restaurant->zip }}　{{ $restaurant->pref }}{{ $restaurant->address }}
            <br><a href="https://www.google.com/maps/dir/{{ $restaurant->zip }}{{ $restaurant->pref }}{{ $restaurant->address }}" target="_blank">地図アプリで見る</a><br>
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
<br>

@include('restaurant.comment_list_latest5', ['version' => 'sp', 'px' => '60px'])

<script src="{{ asset('js/info.js') }}"></script>
@endsection
