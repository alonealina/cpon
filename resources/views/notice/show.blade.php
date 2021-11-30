@extends('layouts.app')

@section('content')

<p class="cpon_notice">Cポンポータルからのお知らせ</p>

<div class="notice_show">
    <div class="notice_date">{{ $notice->notice_date }}</div>
    <div class="notice_title_big">{{ $notice->title }}</div>
    <div class="notice_content">{{ $notice->content }}</div>
</div>

@endsection