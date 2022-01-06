@extends('layouts.app')
@section('content')
<div class="flexible_img_list">
    <div class="flexible_main_img">
        @if (empty($restaurant->main_img))
        <img src="../../img/imgerror.jpg" class="main_img">
        @else
        <img src="../../restaurant/{{ $restaurant->id }}/{{ $restaurant->main_img }}" class="main_img">
        @endif
    </div>
    <div class="flexible_sub_img">
        @if (empty($restaurant->main_img))
        <img src="../../img/imgerror.jpg" class="sub_img">
        @else
        <a href="../../restaurant/{{ $restaurant->id }}/{{ $restaurant->main_img }}" data-lightbox="group">
            <img src="../../restaurant/{{ $restaurant->id }}/{{ $restaurant->main_img }}" class="sub_img">
        </a>
        @endif

        @if (empty($restaurant->sub_img1))
        <img src="../../img/imgerror.jpg" class="sub_img">
        @else
        <a href="../../restaurant/{{ $restaurant->id }}/{{ $restaurant->sub_img1 }}" data-lightbox="group">
            <img src="../../restaurant/{{ $restaurant->id }}/{{ $restaurant->sub_img1 }}" class="sub_img">
        </a>
        @endif

        @if (empty($restaurant->sub_img2))
        <img src="../../img/imgerror.jpg" class="sub_img">
        @else
        <a href="../../restaurant/{{ $restaurant->id }}/{{ $restaurant->sub_img2 }}" data-lightbox="group">
            <img src="../../restaurant/{{ $restaurant->id }}/{{ $restaurant->sub_img2 }}" class="sub_img">
        </a>
        @endif

        @if (empty($restaurant->sub_img3))
        <img src="../../img/imgerror.jpg" class="sub_img">
        @else
        <a href="../../restaurant/{{ $restaurant->id }}/{{ $restaurant->sub_img3 }}" data-lightbox="group">
            <img src="../../restaurant/{{ $restaurant->id }}/{{ $restaurant->sub_img3 }}" class="sub_img">
        </a>
        @endif

        @if (empty($restaurant->sub_img4))
        <img src="../../img/imgerror.jpg" class="sub_img">
        @else
        <a href="../../restaurant/{{ $restaurant->id }}/{{ $restaurant->sub_img4 }}" data-lightbox="group">
            <img src="../../restaurant/{{ $restaurant->id }}/{{ $restaurant->sub_img4 }}" class="sub_img">
        </a>
        @endif

        @if (empty($restaurant->sub_img5))
        <img src="../../img/imgerror.jpg" class="sub_img">
        @else
        <a href="../../restaurant/{{ $restaurant->id }}/{{ $restaurant->sub_img5 }}" data-lightbox="group">
            <img src="../../restaurant/{{ $restaurant->id }}/{{ $restaurant->sub_img5 }}" class="sub_img">
        </a>
        @endif

        @if (empty($restaurant->sub_img6))
        <img src="../../img/imgerror.jpg" class="sub_img">
        @else
        <a href="../../restaurant/{{ $restaurant->id }}/{{ $restaurant->sub_img6 }}" data-lightbox="group">
            <img src="../../restaurant/{{ $restaurant->id }}/{{ $restaurant->sub_img6 }}" class="sub_img">
        </a>
        @endif

        @if (empty($restaurant->sub_img7))
        <img src="../../img/imgerror.jpg" class="sub_img">
        @else
        <a href="../../restaurant/{{ $restaurant->id }}/{{ $restaurant->sub_img7 }}" data-lightbox="group">
            <img src="../../restaurant/{{ $restaurant->id }}/{{ $restaurant->sub_img7 }}" class="sub_img">
        </a>
        @endif

        @if (empty($restaurant->sub_img8))
        <img src="../../img/imgerror.jpg" class="sub_img">
        @else
        <a href="../../restaurant/{{ $restaurant->id }}/{{ $restaurant->sub_img8 }}" data-lightbox="group">
            <img src="../../restaurant/{{ $restaurant->id }}/{{ $restaurant->sub_img8 }}" class="sub_img">
        </a>
        @endif
    </div>
</div>

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
    <div class="restaurant_profile">
        <input type="checkbox" id="sp01"><label for="sp01" id="restaurant_profile_label"></label>
        <div id="restaurant_profile_text">
        {!! nl2br(e($restaurant->profile)) !!}
        </div>
    </div>

    <nav class="info_list_bar info_list_bar_pc">
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
    <div class="info_list">
        <div id="info_list_basic">
            　所在地：〒{{ $restaurant->zip }}　{{ $restaurant->pref }}{{ $restaurant->address }}{{ $restaurant->address_remarks }}
            <a href="https://www.google.com/maps/dir/{{ $restaurant->zip }}{{ $restaurant->pref }}{{ $restaurant->address }}{{ $restaurant->address_remarks }}" target="_blank">地図アプリで見る</a><br>
            電話番号：{{ $restaurant->tel }}<br>
            営業時間：{{ $restaurant->open_hm }}～{{ $restaurant->close_hm }}<br>
            <div class="info_list_basic">　　　　　{!! nl2br(e($restaurant->time_remarks)) !!}</div>
            　定休日：{{ $restaurant_holidays }}<br>
            　　予算：昼　{{ $restaurant->budget_lunch }}<br>
            　　　　　夜　{{ $restaurant->budget_dinner }}<br>
            　　評価：{{ $avg_star }} ({{ $comments->total() }} 評価)<br>
            <div class="info_list_web">WEBページ</div>：<a href="{{ $restaurant->url }}" target="_blank">{{ $restaurant->url }}</a>
        </div>
        <div id="info_list_access" hidden>
            最寄り駅：{{ $restaurant_stations }}<br>
            <div class="info_list_access">アクセス：{!! nl2br(e($restaurant->access)) !!}</div>
            <div class="info_list_access">　駐車場：{!! nl2br(e($restaurant->parking)) !!}</div>
        </div>
        <div id="info_list_pay" hidden>
            　クレジットカード：{{ $restaurant_cards }}<br>
            <div class="info_list_pay">電子マネー・その他：{!! nl2br(e($restaurant->e_money)) !!}</div>
            Cポン（クーポン）支払可能
        </div>
        <div id="info_list_other" hidden>
            <div class="info_list_other">　　　席数：{!! nl2br(e($restaurant->seats)) !!}</div>
            <div class="info_list_other">禁煙・喫煙：{!! nl2br(e($restaurant->smoking)) !!}</div>
            <div class="info_list_mall">Cポンモール</div>：<a href="{{ $restaurant->url }}" target="_blank">{{ $restaurant->cpon_mall_url }}</a><br>
            <div class="info_list_other">　　その他：{!! nl2br(e($restaurant->other)) !!}</div>
        </div>
    </div>

    <!-- @if($restaurant->opening_flg)
    <div class="open_mark">OPEN</div>
    @else
    <div class="close_mark">CLOSE</div>
    @endif -->

</div>

@yield('menu_list')
@yield('comment_form')
<script>
let profile_text = document.getElementById('restaurant_profile_text');
let client_h = profile_text.clientHeight;
if (client_h < 80) {
    document.getElementById('restaurant_profile_label').style.display ="none";
} else {
    profile_text.style.overflow = "hidden";
    $clamp(profile_text, {clamp: 4});
}

$('#sp01').click(function() {
    if (this.checked) {
        profile_text.style.display = "block";
    } else {
        profile_text.style.display = "-webkit-box";
    }
});

</script>
<script src="{{ asset('js/info.js') }}"></script>
@endsection


@section('content_ipad')

@include('form.header_search_ipad')
<div class="body_ipad">

    <div class="banner_ipad">
        <ul class="restaurant_img_ipad">
            @if (empty($restaurant->main_img))
            <li><img src="../../img/imgerror.jpg" class="banner_img" alt=""></li>
            @else
            <li><img src="../../restaurant/{{ $restaurant->id }}/{{ $restaurant->main_img }}" class="slide_restaurant_img_ipad" alt=""></li>
            @endif
            @if (!empty($restaurant->sub_img1))
            <li><img src="../../restaurant/{{ $restaurant->id }}/{{ $restaurant->sub_img1 }}" class="slide_restaurant_img_ipad" alt=""></li>
            @endif
            @if (!empty($restaurant->sub_img2))
            <li><img src="../../restaurant/{{ $restaurant->id }}/{{ $restaurant->sub_img2 }}" class="slide_restaurant_img_ipad" alt=""></li>
            @endif
            @if (!empty($restaurant->sub_img3))
            <li><img src="../../restaurant/{{ $restaurant->id }}/{{ $restaurant->sub_img3 }}" class="slide_restaurant_img_ipad" alt=""></li>
            @endif
            @if (!empty($restaurant->sub_img4))
            <li><img src="../../restaurant/{{ $restaurant->id }}/{{ $restaurant->sub_img4 }}" class="slide_restaurant_img_ipad" alt=""></li>
            @endif
            @if (!empty($restaurant->sub_img5))
            <li><img src="../../restaurant/{{ $restaurant->id }}/{{ $restaurant->sub_img5 }}" class="slide_restaurant_img_ipad" alt=""></li>
            @endif
            @if (!empty($restaurant->sub_img6))
            <li><img src="../../restaurant/{{ $restaurant->id }}/{{ $restaurant->sub_img6 }}" class="slide_restaurant_img_ipad" alt=""></li>
            @endif
            @if (!empty($restaurant->sub_img7))
            <li><img src="../../restaurant/{{ $restaurant->id }}/{{ $restaurant->sub_img7 }}" class="slide_restaurant_img_ipad" alt=""></li>
            @endif
            @if (!empty($restaurant->sub_img8))
            <li><img src="../../restaurant/{{ $restaurant->id }}/{{ $restaurant->sub_img8 }}" class="slide_restaurant_img_ipad" alt=""></li>
            @endif
        </ul>
    </div>

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
        <div class="restaurant_profile">
            <input type="checkbox" id="ipad_label"><label for="ipad_label" id="restaurant_profile_label_ipad"></label>
            <div>
                <div id="restaurant_profile_text_ipad">
                {!! nl2br(e($restaurant->profile)) !!}
                </div>
            </div>
        </div>
        <nav class="info_list_bar info_list_bar_ipad">
            <ul>
            <li class="info_basic_ipad current"><a>
                <img src="{{ asset('img/icon/ie.png') }}" id="img_basic_ipad" hidden>
                <img src="{{ asset('img/icon/ie_c.png') }}" id="img_basic_current_ipad"> 店舗基本情報</a></li>
            <li class="info_access_ipad"><a>
                <img src="{{ asset('img/icon/access.png') }}" id="img_access_ipad">
                <img src="{{ asset('img/icon/access_c.png') }}" id="img_access_current_ipad" hidden> アクセス情報</a></li>
            <li class="info_pay_ipad"><a>
                <img src="{{ asset('img/icon/siharai.png') }}" id="img_siharai_ipad">
                <img src="{{ asset('img/icon/siharai_c.png') }}" id="img_siharai_current_ipad" hidden> 支払い方法</a></li>
            <li class="info_other_ipad"><a>
                <img src="{{ asset('img/icon/haguruma.png') }}" id="img_haguruma_ipad">
                <img src="{{ asset('img/icon/haguruma_c.png') }}" id="img_haguruma_current_ipad" hidden> 設備・その他の情報</a></li>
            </ul>
        </nav>
        <div class="info_list">
            <div id="info_list_basic_ipad">
                　所在地：〒{{ $restaurant->zip }}　{{ $restaurant->pref }}{{ $restaurant->address }}{{ $restaurant->address_remarks }}
                <a href="https://www.google.com/maps/dir/{{ $restaurant->zip }}{{ $restaurant->pref }}{{ $restaurant->address }}{{ $restaurant->address_remarks }}" target="_blank">地図アプリで見る</a><br>
                電話番号：{{ $restaurant->tel }}<br>
                営業時間：{{ $restaurant->open_hm }}～{{ $restaurant->close_hm }}<br>
                <div class="info_list_basic">　　　　　{!! nl2br(e($restaurant->time_remarks)) !!}</div>
                　定休日：{{ $restaurant_holidays }}<br>
                　　予算：昼　{{ $restaurant->budget_lunch }}<br>
                　　　　　夜　{{ $restaurant->budget_dinner }}<br>
                　　評価：{{ $avg_star }} ({{ $comments->total() }} 評価)<br>
                <div class="info_list_web">WEBページ</div>：<a href="{{ $restaurant->url }}" target="_blank">{{ $restaurant->url }}</a>
            </div>
            <div id="info_list_access_ipad" hidden>
                最寄り駅：{{ $restaurant_stations }}<br>
                <div class="info_list_access">アクセス：{!! nl2br(e($restaurant->access)) !!}</div>
                <div class="info_list_access">　駐車場：{!! nl2br(e($restaurant->parking)) !!}</div>
            </div>
            <div id="info_list_pay_ipad" hidden>
                　クレジットカード：{{ $restaurant_cards }}<br>
                <div class="info_list_pay">電子マネー・その他：{!! nl2br(e($restaurant->e_money)) !!}</div>
                Cポン（クーポン）支払可能
            </div>
            <div id="info_list_other_ipad" hidden>
                <div class="info_list_other">　　　席数：{!! nl2br(e($restaurant->seats)) !!}</div>
                <div class="info_list_other">禁煙・喫煙：{!! nl2br(e($restaurant->smoking)) !!}</div>
                <div class="info_list_mall">Cポンモール</div>：<a href="{{ $restaurant->url }}" target="_blank">{{ $restaurant->cpon_mall_url }}</a><br>
                <div class="info_list_other">　　その他：{!! nl2br(e($restaurant->other)) !!}</div>
            </div>
        </div>


    </div>

@yield('menu_list_ipad')
@yield('comment_form_ipad')
</div>

<script>

let profile_text_ipad = document.getElementById('restaurant_profile_text_ipad');
let client_h_ipad = profile_text_ipad.clientHeight;
if (client_h_ipad < 100) {
    document.getElementById('restaurant_profile_label_ipad').style.display ="none";
} else {
    profile_text_ipad.style.overflow = "hidden";
    $clamp(profile_text_ipad, {clamp: 5});
}

$('#ipad_label').click(function() {
    if (this.checked) {
        profile_text_ipad.style.display = "block";
    } else {
        profile_text_ipad.style.display = "-webkit-box";
    }
});

</script>
<script src="{{ asset('js/info_ipad.js') }}"></script>
@endsection


@section('back_button')
<div class="back_button">
    <a href="{{ route('index') }}">←</a>
</div>
@endsection

@section('content_sp')

<div class="banner_sp2">
    <ul class="restaurant_img_sp">
        @if (empty($restaurant->main_img))
        <li><img src="../../img/imgerror.jpg" class="banner_img_sp" alt=""></li>
        @else
        <li><img src="../../restaurant/{{ $restaurant->id }}/{{ $restaurant->main_img }}" class="banner_img_sp" alt=""></li>
        @endif
        @if (!empty($restaurant->sub_img1))
        <li><img src="../../restaurant/{{ $restaurant->id }}/{{ $restaurant->sub_img1 }}" class="banner_img_sp" alt=""></li>
        @endif
        @if (!empty($restaurant->sub_img2))
        <li><img src="../../restaurant/{{ $restaurant->id }}/{{ $restaurant->sub_img2 }}" class="banner_img_sp" alt=""></li>
        @endif
        @if (!empty($restaurant->sub_img3))
        <li><img src="../../restaurant/{{ $restaurant->id }}/{{ $restaurant->sub_img3 }}" class="banner_img_sp" alt=""></li>
        @endif
        @if (!empty($restaurant->sub_img4))
        <li><img src="../../restaurant/{{ $restaurant->id }}/{{ $restaurant->sub_img4 }}" class="banner_img_sp" alt=""></li>
        @endif
        @if (!empty($restaurant->sub_img5))
        <li><img src="../../restaurant/{{ $restaurant->id }}/{{ $restaurant->sub_img5 }}" class="banner_img_sp" alt=""></li>
        @endif
        @if (!empty($restaurant->sub_img6))
        <li><img src="../../restaurant/{{ $restaurant->id }}/{{ $restaurant->sub_img6 }}" class="banner_img_sp" alt=""></li>
        @endif
        @if (!empty($restaurant->sub_img7))
        <li><img src="../../restaurant/{{ $restaurant->id }}/{{ $restaurant->sub_img7 }}" class="banner_img_sp" alt=""></li>
        @endif
        @if (!empty($restaurant->sub_img8))
        <li><img src="../../restaurant/{{ $restaurant->id }}/{{ $restaurant->sub_img8 }}" class="banner_img_sp" alt=""></li>
        @endif
    </ul>
</div>

<div class="restaurant_show">
    <div style="width:350px"><div style="float:left;" class="restaurant_category_sp">{{ $category->name }}</div></div><br>
    <div style="width:350px"><div class="restaurant_name_sp2">{{ $restaurant->name1 }} {{ $restaurant->name2 }} {{ $restaurant->name3 }}</div></div>
    <div style="width:350px;"><div style="width:350px; text-align:left;" class="scene_commitment">
        @foreach ($restaurant_scenes as $name)
        <label class="label">{{ $name }}</label>
        @endforeach
        @foreach ($restaurant_commitments as $name)
        <label class="label">{{ $name }}</label>
        @endforeach
    </div></div>
    @if(!empty($restaurant->cpon_mall_url))
    <div style="width:350px;text-align:left;"><div style="" class="cpon_mall_url_sp">
        <a href="{{ $restaurant->cpon_mall_url }}" target="_blank">Cポンモール出店中</a>
    </div> </div>
    @endif
    <div class="restaurant_profile">
        <input type="checkbox" id="sp_label"><label for="sp_label" id="restaurant_profile_label_sp"></label>
        <div>
            <div id="restaurant_profile_text_sp">
            {!! nl2br(e($restaurant->profile)) !!}
            </div>
        </div>
    </div>
    <div class="button_black_sp">
        <a href="{{ route('restaurant.detail', ['id' => $restaurant->id]) }}">店舗詳細情報はこちら</a>
    </div>
</div>

@yield('menu_list_sp')

<script>

let profile_text_sp = document.getElementById('restaurant_profile_text_sp');
let client_h_sp = profile_text_sp.clientHeight;
if (client_h_sp < 140) {
    document.getElementById('restaurant_profile_label_sp').style.display ="none";
} else {
    profile_text_sp.style.overflow = "hidden";
    $clamp(profile_text_sp, {clamp: 7});
}

$('#sp_label').click(function() {
    if (this.checked) {
        profile_text_sp.style.display = "block";
    } else {
        profile_text_sp.style.display = "-webkit-box";
    }
});

</script>

@endsection