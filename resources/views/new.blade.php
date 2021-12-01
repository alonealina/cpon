@extends('home')

@section('restaurant_list')

<p>新着店舗情報</p>
<div class="new_list">
    @foreach ($news as $new)
    <div class="new_restaurant">
    <a href="{{ route('restaurant.show', ['id' => $new->id]) }}">
        <img src="{{ asset('img/tempo1.png') }}" alt="">
        <div class="new_name">{{ $new->name }}</div>
        <div class="new_address">〒{{ $new->zip }} {{ $new->address }}</div>
        <div class="new_time">{{ $new->open_hm }} - {{ $new->close_hm }}　
            @if($new->opening_flg)
            OPEN
            @endif
        </div>
    </a>
    </div>
    @endforeach
</div>

@endsection