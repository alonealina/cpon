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
    <div style="width:350px;"><div class="scene_commitment" style="width:350px; text-align:left;">
        @foreach ($restaurant_scenes as $name)
        <label class="label">{{ $name }}</label>
        @endforeach
        @foreach ($restaurant_commitments as $name)
        <label class="label">{{ $name }}</label>
        @endforeach
    </div></div>
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
            <div class="info_list_basic_sp">　所在地：〒{{ $restaurant->zip }}　{{ $restaurant->pref }}{{ $restaurant->address }}{{ $restaurant->address_remarks }}
            <br><a href="https://www.google.com/maps/dir/{{ $restaurant->zip }}{{ $restaurant->pref }}{{ $restaurant->address }}{{ $restaurant->address_remarks }}" target="_blank">地図アプリで見る</a></div>
            電話番号：{{ $restaurant->tel }}<br>
            営業時間：{{ $restaurant->open_hm }}～{{ $restaurant->close_hm }}<br>
            <div class="info_list_basic_sp">　　　　　{!! nl2br(e($restaurant->time_remarks)) !!}</div>
            <div class="info_list_basic_sp">　定休日：{{ $restaurant_holidays }}</div>
            　　予算：昼　{{ $restaurant->budget_lunch }}<br>
            　　　　　夜　{{ $restaurant->budget_dinner }}<br>
            　　評価：{{ $avg_star }} ({{ $comments->total() }} 評価)<br>
            <div class="info_list_web_sp">WEBページ</div>：<a href="{{ $restaurant->url }}" target="_blank">{{ $restaurant->url }}</a>
        </div>
        <div id="info_list_access" hidden>
            <div class="info_list_access_sp">最寄り駅：{{ $restaurant_stations }}</div>
            <div class="info_list_access_sp">アクセス：{!! nl2br(e($restaurant->access)) !!}</div>
            <div class="info_list_access_sp">　駐車場：{!! nl2br(e($restaurant->parking)) !!}</div>
        </div>
        <div id="info_list_pay" hidden>
            <div class="info_list_pay_sp">　クレジットカード：{{ $restaurant_cards }}</div>
            <div class="info_list_pay_sp">電子マネー・その他：{!! nl2br(e($restaurant->e_money)) !!}</div>
            Cポンまたはクーポン券支払可能
        </div>
        <div id="info_list_other" hidden>
            <div class="info_list_other_sp">　　　席数：{!! nl2br(e($restaurant->seats)) !!}</div>
            <div class="info_list_other_sp">禁煙・喫煙：{!! nl2br(e($restaurant->smoking)) !!}</div>
            <div class="info_list_mall_sp">Cポンモール</div>：<a href="{{ $restaurant->cpon_mall_url }}" target="_blank">{{ $restaurant->cpon_mall_url }}</a><br>
            <div class="info_list_other_sp">　　その他：{!! nl2br(e($restaurant->other)) !!}</div>
        </div>
    </div>
</div>
<br>

@include('restaurant.comment_list_latest5', ['version' => 'sp', 'px' => '60px'])

<script src="../../../js/info.js"></script>
@endsection
