@extends('home')

@section('category_background')
<div class="category_background">
    <div class="category_name_title">
    {{ $category_name }}
    </div>
    <div class="category_img">
    <img src="{{ asset('img/tyuuka.png') }}" alt="">
    </div>
</div>
@endsection

@section('restaurant_list')

<div class="search_list">
    @foreach ($restaurants as $restaurant)
    <div class="search_restaurant">
    <a href="{{ route('restaurant.show', ['id' => $restaurant->id]) }}">
        @if (empty($restaurant->main_img))
        <img src="../../img/imgerror.jpg">
        @else
        <img src="../../img/restaurant/{{ $restaurant->id }}/{{ $restaurant->main_img }}">
        @endif
        <div class="search_name">{{ $restaurant->name1 }} {{ $restaurant->name2 }} {{ $restaurant->name3 }}</div>
        <div class="search_address">〒{{ $restaurant->zip }} {{ $restaurant->pref }}{{ $restaurant->address }}</div>
        <div class="search_time">{{ $restaurant->open_hm }} - {{ $restaurant->close_hm }}　
            @if($restaurant->opening_flg)
            <div class="open_mark">OPEN</div>
            @else
            <div class="close_mark">CLOSE</div>
            @endif
        </div>
    </a>
    </div>
    @endforeach
</div>
<div class="d-flex justify-content-center">
{{ $restaurants->links('pagination::default') }}
</div>
@endsection



@section('category_background_ipad')
<div class="category_background_ipad">
    <div class="category_name_title_ipad">
    {{ $category_name }}
    </div>
    <div class="category_img_ipad">
    <img src="{{ asset('img/tyuuka.png') }}" alt="">
    </div>
</div>
@endsection

@section('restaurant_list_ipad')

<div class="search_list_ipad">
    @foreach ($restaurants as $restaurant)
    <div class="search_restaurant_ipad">
    <a href="{{ route('restaurant.show', ['id' => $restaurant->id]) }}">
        @if (empty($restaurant->main_img))
        <img src="../../img/imgerror.jpg">
        @else
        <img src="../../img/restaurant/{{ $restaurant->id }}/{{ $restaurant->main_img }}">
        @endif
        <div class="search_name">{{ $restaurant->name1 }} {{ $restaurant->name2 }} {{ $restaurant->name3 }}</div>
        <div class="search_address">〒{{ $restaurant->zip }} {{ $restaurant->pref }}{{ $restaurant->address }}</div>
        <div class="search_time">{{ $restaurant->open_hm }} - {{ $restaurant->close_hm }}　
            @if($restaurant->opening_flg)
            <div class="open_mark">OPEN</div>
            @else
            <div class="close_mark">CLOSE</div>
            @endif
        </div>
    </a>
    </div>
    @endforeach
</div>
<div class="d-flex justify-content-center">
{{ $restaurants->links('pagination::default') }}
</div>
@endsection



@section('back_button')
<div class="back_button">
    <a href="{{ route('index') }}">←</a>
</div>
@endsection

@section('restaurant_list_sp')

@foreach ($restaurants as $restaurant)
<div class="search_restaurant_sp">
    <a href="{{ route('restaurant.show', ['id' => $restaurant->id]) }}">
        @if (empty($restaurant->main_img))
        <img src="../../img/imgerror.jpg">
        @else
        <img src="../../img/restaurant/{{ $restaurant->id }}/{{ $restaurant->main_img }}">
        @endif
        <div class="search_name restaurant_name_sp">{{ $restaurant->name1 }} {{ $restaurant->name2 }} {{ $restaurant->name3 }}</div>
        <div class="search_address_sp">〒{{ $restaurant->zip }} {{ $restaurant->pref }}{{ $restaurant->address }}</div>
        <div class="search_time">{{ $restaurant->open_hm }} - {{ $restaurant->close_hm }}　</div>
        @if($restaurant->opening_flg)
        <div class="open_mark">OPEN</div>
        @else
        <div class="close_mark">CLOSE</div>
        @endif
    </a>
</div>
@endforeach
<div class="d-flex justify-content-center">
{{ $restaurants->links('pagination::default') }}
</div>
@endsection