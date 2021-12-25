@extends('layouts.app')

@section('content')

<div class="notice_background">
    <div class="notice_name_title">
    Cポンお店ナビからのお知らせ
    </div>
    <div class="category_img">
    <img src="{{ asset('img/osirase.png') }}" alt="">
    <div class="notice_name_line"></div>
    </div>
</div>

<hr>
<div class="notice_home">
    @foreach ($notices as $notice)
    <a href="{{ route('notice.show', ['id' => $notice->id]) }}">
        <div class="notice_date">{{ $notice->notice_date }}</div>
        <div class="notice_title">{{ $notice->title }}</div>
    </a>
    <hr>
    @endforeach
</div>
<div class="d-flex justify-content-center">
{{ $notices->links('pagination::default') }}
</div>

@endsection


@section('content_ipad')

<div class="notice_background_ipad">
    <div class="notice_name_title_ipad">
    Cポンお店ナビからの<br>お知らせ
    </div>
    <div class="notice_img_ipad">
    <img src="{{ asset('img/osirase.png') }}" alt="">
    </div>
</div>

<div class="body_ipad">
    <hr>
    <div class="notice_home">
        @foreach ($notices as $notice)
        <a href="{{ route('notice.show', ['id' => $notice->id]) }}">
            <div class="notice_date">{{ $notice->notice_date }}</div>
            <div class="notice_title">{{ $notice->title }}</div>
        </a>
        <hr>
        @endforeach
    </div>
    <div class="d-flex justify-content-center">
    {{ $notices->links('pagination::default') }}
    </div>
</div>
@endsection




@section('back_button')
<div class="back_button">
    <a href="{{ route('index') }}">←</a>
</div>
@endsection

@section('content_sp')

<p class="cpon_notice_title">Cポンお店ナビからのお知らせ</p>
<hr>
<div class="notice_home_sp">
    @foreach ($notices as $notice)
    <a href="{{ route('notice.show', ['id' => $notice->id]) }}">
        <div class="notice_date_sp">{{ $notice->notice_date }}</div>
        <div class="notice_title_sp">{{ $notice->title }}</div>
    </a>
    <hr>
    @endforeach
</div>
<div class="d-flex justify-content-center">
{{ $notices->links('pagination::default') }}
</div>

<div class="button_black_sp">
    <a href="{{ route('index') }}">TOPに戻る</a>
</div>
@endsection