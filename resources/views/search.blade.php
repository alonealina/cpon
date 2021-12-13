@extends('home')

@section('restaurant_list')

<div class="search_list">
    @foreach ($restaurants as $restaurant)
    <div class="search_restaurant">
    <a href="{{ route('restaurant.show', ['id' => $restaurant->id]) }}">
        <img src="{{ asset('img/tempo1.png') }}" alt="">
        <div class="search_name">{{ $restaurant->name1 }} {{ $restaurant->name2 }} {{ $restaurant->name3 }}</div>
        <div class="search_address">〒{{ $restaurant->zip }} {{ $restaurant->pref }}{{ $restaurant->address }}</div>
        <div class="search_time">{{ $restaurant->open_hm }} - {{ $restaurant->close_hm }}　
            @if($restaurant->opening_flg)
            OPEN
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


@section('restaurant_list_ipad')

<div class="search_list_ipad">
    @foreach ($restaurants as $restaurant)
    <div class="search_restaurant_ipad">
    <a href="{{ route('restaurant.show', ['id' => $restaurant->id]) }}">
        <img src="{{ asset('img/tempo1.png') }}" alt="">
        <div class="search_name">{{ $restaurant->name1 }} {{ $restaurant->name2 }} {{ $restaurant->name3 }}</div>
        <div class="search_address">〒{{ $restaurant->zip }} {{ $restaurant->pref }}{{ $restaurant->address }}</div>
        <div class="search_time">{{ $restaurant->open_hm }} - {{ $restaurant->close_hm }}　
            @if($restaurant->opening_flg)
            OPEN
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