@extends('layouts.app')
@section('content')
<div class="flexible_img_list">
    <div class="flexible_main_img">
        <a href="../../img/restaurant/71/{{ $restaurant->main_img }}" data-lightbox="group">
            <img src="../../img/restaurant/71/{{ $restaurant->main_img }}" class="main_img">
        </a>
    </div>
    <div class="flexible_sub_img">
        <a href="../../img/restaurant/71/{{ $restaurant->main_img }}" data-lightbox="group">
            <img src="../../img/restaurant/71/{{ $restaurant->sub_img1 }}" class="sub_img">
        </a>
        
        <a href="../../img/restaurant/71/{{ $restaurant->main_img }}" data-lightbox="group">
            <img src="../../img/restaurant/71/{{ $restaurant->sub_img2 }}" class="sub_img">
        </a>
        
        <a href="../../img/restaurant/71/{{ $restaurant->main_img }}" data-lightbox="group">
            <img src="../../img/restaurant/71/{{ $restaurant->sub_img3 }}" class="sub_img">
        </a>
        
        <a href="../../img/restaurant/71/{{ $restaurant->main_img }}" data-lightbox="group">
            <img src="../../img/restaurant/71/{{ $restaurant->sub_img4 }}" class="sub_img">
        </a>
    </div>
</div>

<div class="restaurant_show">
    <div class="restaurant_name">{{ $restaurant->name1 }} {{ $restaurant->name2 }} {{ $restaurant->name3 }}</div>
    <div class="restaurant_profile">
        <input type="checkbox" id="sp01"><label for="sp01" id="restaurant_profile_label"></label>
        <div>
            <div id="restaurant_profile_text">
            {{ $restaurant->profile }}
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
    　{{ $restaurant->inquiry_remarks }}
    </div>　

</div>

@yield('menu_list')
@yield('comment_form')

@endsection


@section('content_ipad')

@include('form.header_search_ipad')
<div class="body_ipad">
    <div class="flexible_img_list_ipad">
        <div class="flexible_main_img_ipad">
            <a href="../../img/restaurant/71/{{ $restaurant->main_img }}" data-lightbox="group_ipad">
                <img src="../../img/restaurant/71/{{ $restaurant->main_img }}" class="main_img_ipad">
            </a>
        </div>
        <div class="flexible_sub_img_ipad">
            <a href="../../img/restaurant/71/{{ $restaurant->main_img }}" data-lightbox="group_ipad">
                <img src="../../img/restaurant/71/{{ $restaurant->sub_img1 }}" class="sub_img_ipad">
            </a>
            
            <a href="../../img/restaurant/71/{{ $restaurant->main_img }}" data-lightbox="group_ipad">
                <img src="../../img/restaurant/71/{{ $restaurant->sub_img2 }}" class="sub_img_ipad">
            </a>
            
            <a href="../../img/restaurant/71/{{ $restaurant->main_img }}" data-lightbox="group_ipad">
                <img src="../../img/restaurant/71/{{ $restaurant->sub_img3 }}" class="sub_img_ipad">
            </a>
            
            <a href="../../img/restaurant/71/{{ $restaurant->main_img }}" data-lightbox="group_ipad">
                <img src="../../img/restaurant/71/{{ $restaurant->sub_img4 }}" class="sub_img_ipad">
            </a>
        </div>
    </div>

    <div class="restaurant_show">
        <div class="restaurant_name">{{ $restaurant->name1 }} {{ $restaurant->name2 }} {{ $restaurant->name3 }}</div>
        <div class="restaurant_profile">
            <input type="checkbox" id="ipad_label"><label for="ipad_label" id="restaurant_profile_label_ipad"></label>
            <div>
                <div id="restaurant_profile_text">
                {{ $restaurant->profile }}
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
        　{{ $restaurant->inquiry_remarks }}
        </div>　

    </div>

@yield('menu_list_ipad')
@yield('comment_form_ipad')
</div>

@endsection


@section('back_button')
<div class="back_button">
    <a href="{{ route('index') }}">←</a>
</div>
@endsection

@section('content_sp')

<div class="banner_sp">
    <ul class="restaurant_img_sp">
        @if (!empty($restaurant->main_img))
        <li><img src="../../img/restaurant/71/{{ $restaurant->main_img }}" class="banner_img" alt=""></li>
        @endif
        @if (!empty($restaurant->sub_img1))
        <li><img src="../../img/restaurant/71/{{ $restaurant->sub_img1 }}" class="banner_img" alt=""></li>
        @endif
        @if (!empty($restaurant->sub_img2))
        <li><img src="../../img/restaurant/71/{{ $restaurant->sub_img2 }}" class="banner_img" alt=""></li>
        @endif
        @if (!empty($restaurant->sub_img3))
        <li><img src="../../img/restaurant/71/{{ $restaurant->sub_img3 }}" class="banner_img" alt=""></li>
        @endif
        @if (!empty($restaurant->sub_img4))
        <li><img src="../../img/restaurant/71/{{ $restaurant->sub_img4 }}" class="banner_img" alt=""></li>
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
