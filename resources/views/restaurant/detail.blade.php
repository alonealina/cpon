@extends('layouts.app')

@section('back_button')
<div class="back_button">
    <a href="{{ route('restaurant.show', ['id' => $restaurant->id]) }}">←</a>
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
    <div class="restaurant_profile">
        <input type="checkbox" id="sp_label"><label for="sp_label" id="restaurant_profile_label_sp"></label>
        <div>
            <div id="restaurant_profile_text_sp">
            {!! nl2br(e($restaurant->profile)) !!}
            </div>
        </div>
    </div>

    <div class="restaurant_detail">
        <div class="restaurant_detail_img"><img src="{{ asset('img/icon/tizu.png') }}" alt=""></div>
        <div class="restaurant_detail_content">
            〒{{ $restaurant->zip }}　{{ $restaurant->pref }}{{ $restaurant->address }}<br>
            <a href="https://www.google.com/maps/dir/{{ $restaurant->pref }}{{ $restaurant->address }}" target=”_blank”>地図アプリで見る</a>
            <br>
            {{ $restaurant->address_remarks }}
        </div>
    </div>

    <div class="restaurant_detail">
        <div class="restaurant_detail_img"><img src="{{ asset('img/icon/tokei.png') }}" alt=""></div>
        <div class="restaurant_detail_content">
            @if($restaurant->opening_flg)
            <div class="open_mark">OPEN</div>
            @else
            <div class="close_mark">CLOSE</div>
            @endif
            <br>
            {{ $restaurant->open_hm }}～{{ $restaurant->close_hm }}
            <br>
            {{ $restaurant->time_remarks }}
        </div>
    </div>

    <div class="restaurant_detail">
        <div class="restaurant_detail_img"><img src="{{ asset('img/icon/star.png') }}" alt=""></div>
        <div class="restaurant_detail_content">
            {{ $avg_star }} ({{ $comments->total() }} 評価)・{{ $category->name }}
            <br>
            <a href="{{ route('restaurant.comment_list_sp', ['id' => $restaurant->id]) }}">コメントを見る</a>
        </div>
    </div>

    <div class="restaurant_detail">
        <div class="restaurant_detail_img"><img src="{{ asset('img/icon/yotei.png') }}" alt=""></div>
        <div class="restaurant_detail_content">
        ご予約・お問合せ
        <br>
        <a href="{{ $restaurant->url }}" target=”_blank”>{{ $restaurant->url }}</a>
        <br>
        {{ $restaurant->tel }}
        </div>
    </div>
</div>

<script>
let client_h_sp = document.getElementById('restaurant_profile_text_sp').clientHeight;
if (client_h_sp < 120) {
    document.getElementById('restaurant_profile_label_sp').style.display ="none";
}
</script>
@endsection
