@extends('layouts.app')
@section('content')
<div class="flexible_img_list">
    <div class="flexible_main_img">
        @if (empty($restaurant->main_img))
        <img src="../../img/imgerror.jpg" class="main_img">
        @else
        <a href="../../restaurant/{{ $restaurant->id }}/{{ $restaurant->main_img }}" data-lightbox="group">
            <img src="../../restaurant/{{ $restaurant->id }}/{{ $restaurant->main_img }}" class="main_img">
        </a>
        @endif
    </div>
    <div class="flexible_sub_img">
        @if (empty($restaurant->sub_img1))
        <img src="../../img/imgerror.jpg" class="sub_img">
        @else
        <a href="../../restaurant/{{ $restaurant->id }}/{{ $restaurant->main_img }}" data-lightbox="group">
            <img src="../../restaurant/{{ $restaurant->id }}/{{ $restaurant->sub_img1 }}" class="sub_img">
        </a>
        @endif

        @if (empty($restaurant->sub_img2))
        <img src="../../img/imgerror.jpg" class="sub_img">
        @else
        <a href="../../restaurant/{{ $restaurant->id }}/{{ $restaurant->main_img }}" data-lightbox="group">
            <img src="../../restaurant/{{ $restaurant->id }}/{{ $restaurant->sub_img2 }}" class="sub_img">
        </a>
        @endif

        @if (empty($restaurant->sub_img3))
        <img src="../../img/imgerror.jpg" class="sub_img">
        @else
        <a href="../../restaurant/{{ $restaurant->id }}/{{ $restaurant->main_img }}" data-lightbox="group">
            <img src="../../restaurant/{{ $restaurant->id }}/{{ $restaurant->sub_img3 }}" class="sub_img">
        </a>
        @endif

        @if (empty($restaurant->sub_img4))
        <img src="../../img/imgerror.jpg" class="sub_img">
        @else
        <a href="../../restaurant/{{ $restaurant->id }}/{{ $restaurant->main_img }}" data-lightbox="group">
            <img src="../../restaurant/{{ $restaurant->id }}/{{ $restaurant->sub_img4 }}" class="sub_img">
        </a>
        @endif

        @if (empty($restaurant->sub_img5))
        <img src="../../img/imgerror.jpg" class="sub_img">
        @else
        <a href="../../restaurant/{{ $restaurant->id }}/{{ $restaurant->main_img }}" data-lightbox="group">
            <img src="../../restaurant/{{ $restaurant->id }}/{{ $restaurant->sub_img5 }}" class="sub_img">
        </a>
        @endif

        @if (empty($restaurant->sub_img6))
        <img src="../../img/imgerror.jpg" class="sub_img">
        @else
        <a href="../../restaurant/{{ $restaurant->id }}/{{ $restaurant->main_img }}" data-lightbox="group"><img src="../../restaurant/{{ $restaurant->id }}/{{ $restaurant->sub_img6 }}" class="sub_img">
        </a>
        @endif

        @if (empty($restaurant->sub_img7))
        <img src="../../img/imgerror.jpg" class="sub_img">
        @else
        <a href="../../restaurant/{{ $restaurant->id }}/{{ $restaurant->main_img }}" data-lightbox="group"><img src="../../restaurant/{{ $restaurant->id }}/{{ $restaurant->sub_img7 }}" class="sub_img">
        </a>
        @endif

        @if (empty($restaurant->sub_img8))
        <img src="../../img/imgerror.jpg" class="sub_img">
        @else
        <a href="../../restaurant/{{ $restaurant->id }}/{{ $restaurant->main_img }}" data-lightbox="group">
            <img src="../../restaurant/{{ $restaurant->id }}/{{ $restaurant->sub_img8 }}" class="sub_img">
        </a>
        @endif

        @if (empty($restaurant->sub_img9))
        <img src="../../img/imgerror.jpg" class="sub_img">
        @else
        <a href="../../restaurant/{{ $restaurant->id }}/{{ $restaurant->main_img }}" data-lightbox="group">
            <img src="../../restaurant/{{ $restaurant->id }}/{{ $restaurant->sub_img9 }}" class="sub_img">
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
        <a href="{{ $restaurant->cpon_mall_url }}">Cポンモール出店中</a>
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
            <li class="info_basic current"><a><img src="{{ asset('img/icon/ie.png') }}" alt=""> 店舗基本情報</a></li>
            <li class="info_access"><a><img src="{{ asset('img/icon/access.png') }}" alt=""> アクセス情報</a></li>
            <li class="info_pay"><a><img src="{{ asset('img/icon/siharai.png') }}" alt=""> 支払い方法</a></li>
            <li class="info_other"><a><img src="{{ asset('img/icon/haguruma.png') }}" alt=""> 設備・その他の情報</a></li>
        </ul>
    </nav>
    <div class="info_list">
        <div id="info_list_basic">
            　所在地：〒{{ $restaurant->zip }}　{{ $restaurant->pref }}{{ $restaurant->address }}
            <a href="https://www.google.com/maps/dir/{{ $restaurant->pref }}{{ $restaurant->address }}" target=”_blank”>地図アプリで見る</a><br>
            電話番号：{{ $restaurant->tel }}<br>
            営業時間：{{ $restaurant->open_hm }}～{{ $restaurant->close_hm }}<br>
            {!! nl2br(e($restaurant->time_remarks)) !!}<br>
            　定休日：{{ $restaurant_holidays }}<br>
            　　予算：昼　{{ $restaurant->budget_lunch }}<br>
            　　　　　夜　{{ $restaurant->budget_dinner }}<br>
            　　評価：{{ $avg_star }} ({{ $comments->total() }} 評価)<br>
            WEBページ：<a href="{{ $restaurant->url }}" target=”_blank”>{{ $restaurant->url }}</a>
        </div>
        <div id="info_list_access" hidden>
            最寄り駅：あ<br>
            アクセス：あ<br>
            　駐車場：あ
        </div>
        <div id="info_list_pay" hidden>
            　クレジットカード：あ<br>
            電子マネー・その他：あ<br>
        </div>
        <div id="info_list_other" hidden>
            　　席数：あ<br>
            禁煙・喫煙：あ<br>
            Cポンモール：<a href="{{ $restaurant->url }}" target=”_blank”>{{ $restaurant->cpon_mall_url }}</a><br>
            　その他：あ
        </div>
    </div>

    <div class="restaurant_address">
        
        〒{{ $restaurant->zip }}　{{ $restaurant->pref }}{{ $restaurant->address }}
        <a href="https://www.google.com/maps/dir/{{ $restaurant->pref }}{{ $restaurant->address }}" target=”_blank”>地図アプリで見る</a><br>
        {{ $restaurant->address_remarks }}
    </div>
    <img src="{{ asset('img/icon/tokei.png') }}" alt="">　
    <!-- @if($restaurant->opening_flg)
    <div class="open_mark">OPEN</div>
    @else
    <div class="close_mark">CLOSE</div>
    @endif -->
    <div class="restaurant_time">
        　{{ $restaurant->open_hm }}～{{ $restaurant->close_hm }}　{{ $restaurant->time_remarks }}
    </div>
    <div class="restaurant_comment">
    <img src="{{ asset('img/icon/star.png') }}" alt="">　
    {{ $avg_star }} ({{ $comments->total() }} 評価)
    </div>
    <div class="restaurant_inquiry">
    <img src="{{ asset('img/icon/yotei.png') }}" alt="">　
    ご予約・お問合せ　<a href="{{ $restaurant->url }}" target=”_blank”>{{ $restaurant->url }}</a>　{{ $restaurant->tel }}
    </div>　

</div>

@yield('menu_list')
@yield('comment_form')
<script>
let profile_text = document.getElementById('restaurant_profile_text');
let client_h = profile_text.clientHeight;
if (client_h < 70) {
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
    <div class="flexible_img_list_ipad">
        <div class="flexible_main_img_ipad">
            @if (empty($restaurant->main_img))
            <img src="../../img/imgerror.jpg" class="main_img_ipad">
            @else
            <a href="../../restaurant/{{ $restaurant->id }}/{{ $restaurant->main_img }}" data-lightbox="group_ipad">
                <img src="../../restaurant/{{ $restaurant->id }}/{{ $restaurant->main_img }}" class="main_img_ipad">
            </a>
            @endif
        </div>
        <div class="flexible_sub_img_ipad">
            @if (empty($restaurant->sub_img1))
            <img src="../../img/imgerror.jpg" class="sub_img_ipad">
            @else
            <a href="../../restaurant/{{ $restaurant->id }}/{{ $restaurant->main_img }}" data-lightbox="group_ipad">
                <img src="../../restaurant/{{ $restaurant->id }}/{{ $restaurant->sub_img1 }}" class="sub_img_ipad">
            </a>
            @endif

            @if (empty($restaurant->sub_img2))
            <img src="../../img/imgerror.jpg" class="sub_img_ipad">
            @else
            <a href="../../restaurant/{{ $restaurant->id }}/{{ $restaurant->main_img }}" data-lightbox="group_ipad">
                <img src="../../restaurant/{{ $restaurant->id }}/{{ $restaurant->sub_img2 }}" class="sub_img_ipad">
            </a>
            @endif

            @if (empty($restaurant->sub_img3))
            <img src="../../img/imgerror.jpg" class="sub_img_ipad">
            @else
            <a href="../../restaurant/{{ $restaurant->id }}/{{ $restaurant->main_img }}" data-lightbox="group_ipad">
                <img src="../../restaurant/{{ $restaurant->id }}/{{ $restaurant->sub_img3 }}" class="sub_img_ipad">
            </a>
            @endif

            @if (empty($restaurant->sub_img4))
            <img src="../../img/imgerror.jpg" class="sub_img_ipad">
            @else
            <a href="../../restaurant/{{ $restaurant->id }}/{{ $restaurant->main_img }}" data-lightbox="group_ipad">
                <img src="../../restaurant/{{ $restaurant->id }}/{{ $restaurant->sub_img4 }}" class="sub_img_ipad">
            </a>
            @endif
        </div>
    </div>

    <div class="restaurant_show">
        <div class="restaurant_name">{{ $restaurant->name1 }} {{ $restaurant->name2 }} {{ $restaurant->name3 }}</div>
        <div class="restaurant_profile">
            <input type="checkbox" id="ipad_label"><label for="ipad_label" id="restaurant_profile_label_ipad"></label>
            <div>
                <div id="restaurant_profile_text_ipad">
                {!! nl2br(e($restaurant->profile)) !!}
                </div>
            </div>
        </div>
        <div class="restaurant_address">
            <img src="{{ asset('img/icon/tizu.png') }}" alt="">　
            〒{{ $restaurant->zip }}　{{ $restaurant->pref }}{{ $restaurant->address }}
            <a href="https://www.google.com/maps/dir/{{ $restaurant->pref }}{{ $restaurant->address }}" target=”_blank”>地図アプリで見る</a><br>
            {{ $restaurant->address_remarks }}
        </div>
        <img src="{{ asset('img/icon/tokei.png') }}" alt="">　
        @if($restaurant->opening_flg)
        <div class="open_mark">OPEN</div>
        @else
        <div class="close_mark">CLOSE</div>
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
        </div>　

    </div>

@yield('menu_list_ipad')
@yield('comment_form_ipad')
</div>

<script>
let client_h_ipad = document.getElementById('restaurant_profile_text_ipad').clientHeight;
if (client_h_ipad < 120) {
    document.getElementById('restaurant_profile_label_ipad').style.display ="none";
}
</script>
@endsection


@section('back_button')
<div class="back_button">
    <a href="{{ route('index') }}">←</a>
</div>
@endsection

@section('content_sp')

<div class="banner_sp">
    <ul class="restaurant_img_sp">
        @if (empty($restaurant->main_img))
        <li><img src="../../img/imgerror.jpg" class="banner_img" alt=""></li>
        @else
        <li><img src="../../restaurant/{{ $restaurant->id }}/{{ $restaurant->main_img }}" class="banner_img" alt=""></li>
        @endif
        @if (!empty($restaurant->sub_img1))
        <li><img src="../../restaurant/{{ $restaurant->id }}/{{ $restaurant->sub_img1 }}" class="banner_img" alt=""></li>
        @endif
        @if (!empty($restaurant->sub_img2))
        <li><img src="../../restaurant/{{ $restaurant->id }}/{{ $restaurant->sub_img2 }}" class="banner_img" alt=""></li>
        @endif
        @if (!empty($restaurant->sub_img3))
        <li><img src="../../restaurant/{{ $restaurant->id }}/{{ $restaurant->sub_img3 }}" class="banner_img" alt=""></li>
        @endif
        @if (!empty($restaurant->sub_img4))
        <li><img src="../../restaurant/{{ $restaurant->id }}/{{ $restaurant->sub_img4 }}" class="banner_img" alt=""></li>
        @endif
    </ul>
</div>

<div class="restaurant_show">
    <div class="restaurant_show_name">{{ $restaurant->name1 }} {{ $restaurant->name2 }} {{ $restaurant->name3 }}</div>
    <a href="{{ route('restaurant.detail', ['id' => $restaurant->id]) }}">
        <img src="{{ asset('img/icon/star.png') }}" alt="" class="star_img_sp">
        <div class="restaurant_fivestar_sp">
            {{ $avg_star }} ({{ $comments->total() }} 評価)・{{ $category->name }}
        </div>
        <br>
        <div class="restaurant_address_sp">
            {{ $restaurant->pref }}{{ $restaurant->address }}
        </div>
        <div class="restaurant_detail_link">
            タップして営業時間、所在地などを確認
        </div>
        <img src="{{ asset('img/yazi2.png') }}" alt="" class="link_img_sp">
    </a>
</div>

@yield('menu_list_sp')


@endsection