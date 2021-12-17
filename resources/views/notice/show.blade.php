@extends('layouts.app')

@section('content')

<div class="notice_background">
    <div class="notice_name_title">
    Cポンポータルからのお知らせ
    </div>
    <div class="category_img">
    <img src="{{ asset('img/osirase.png') }}" alt="">
    </div>
</div>

<div class="notice_show">
    <div class="notice_content_date">{{ $notice->notice_date }}</div>
    <div class="notice_title_big">{{ $notice->title }}</div>
    <div class="notice_content">{!! nl2br(e($notice->content)) !!}</div>
</div>

<div class="notice_buttons">
    @if(!$max_flg)
    <div class="notice_button_back">
        <a href="{{ route('notice.show', ['id' => $back_id]) }}"><img src="{{ asset('img/yazi4.png') }}" alt="">　前のお知らせ　</a>
    </div>
    @endif
    @if(!$min_flg)
    <div class="notice_button_next">
        <a href="{{ route('notice.show', ['id' => $next_id]) }}">　次のお知らせ　<img src="{{ asset('img/yazi5.png') }}" alt=""></a>
    </div>
    @endif
</div>
@endsection


@section('content_ipad')


<div class="notice_background_ipad">
    <div class="notice_name_title_ipad">
    Cポンポータルからの<br>お知らせ
    </div>
    <div class="notice_img_ipad">
    <img src="{{ asset('img/osirase.png') }}" alt="">
    </div>
</div>

<div class="body_ipad">
    <div class="notice_show_ipad">
        <div class="notice_content_date">{{ $notice->notice_date }}</div>
        <div class="notice_title_big">{{ $notice->title }}</div>
        <div class="notice_content">{!! nl2br(e($notice->content)) !!}</div>
    </div>

    <div class="notice_buttons">
        @if(!$max_flg)
        <div class="notice_button_back">
            <a href="{{ route('notice.show', ['id' => $back_id]) }}"><img src="{{ asset('img/yazi4.png') }}" alt="">　前のお知らせ　</a>
        </div>
        @endif
        @if(!$min_flg)
        <div class="notice_button_next">
            <a href="{{ route('notice.show', ['id' => $next_id]) }}">　次のお知らせ　<img src="{{ asset('img/yazi5.png') }}" alt=""></a>
        </div>
        @endif
    </div>
</div>
@endsection




@section('back_button')
<div class="back_button">
    <a href="{{ route('notice.index') }}">←</a>
</div>
@endsection

@section('content_sp')

<p class="cpon_notice_title">Cポンポータルからのお知らせ</p>
<hr>
<div class="notice_show_sp">
    <div class="notice_content_date">{{ $notice->notice_date }}</div>
    <div class="notice_title_sp">{{ $notice->title }}</div>
    <div class="notice_content_sp">{!! nl2br(e($notice->content)) !!}</div>
</div>

<div class="notice_buttons">
    @if(!$max_flg)
    <div class="notice_button_back">
        <a href="{{ route('notice.show', ['id' => $back_id]) }}"><img src="{{ asset('img/yazi4.png') }}" alt="">　前のお知らせ　</a>
    </div>
    @endif
    @if(!$min_flg)
    <div class="notice_button_next">
        <a href="{{ route('notice.show', ['id' => $next_id]) }}">　次のお知らせ　<img src="{{ asset('img/yazi5.png') }}" alt=""></a>
    </div>
    @endif
</div>
@endsection