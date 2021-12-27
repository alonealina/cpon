@extends('layouts.app')

@section('content')

<p class="footer_item_title">ヘルプ・お問い合わせ</p>
<div class="help_content">
    <div class="help_text">
    Cポンお店ナビ(本サイト)に関するご質問等がございましたら、<br>
    下記QRコードを読み取ってLINE公式アカウントを登録して頂き、お問い合わせをお願い致します。
    </div>
    <div class="line_url">
        <a href="https://liff.line.me/1656420340-x4VZMLXg/landing?follow=%40010okbuc&lp=PCFYfV&liff_id=1656420340-x4VZMLXg">LINE公式アカウント</a>
    </div>
    <img src="{{ asset('img/qrcode.png') }}" class="qr_code" alt="">
</div>
@endsection

@section('content_ipad')
@include('form.header_search_ipad')
<div class="body_ipad">
    <p class="footer_item_title_ipad">ヘルプ・お問い合わせ</p>
    <div class="help_content">
        <div class="help_text">
        Cポンお店ナビ(本サイト)に関するご質問等がございましたら、<br>
        下記QRコードを読み取ってLINE公式アカウントを登録して頂き、お問い合わせをお願い致します。
        </div>
        <div class="line_url">
            <a href="https://liff.line.me/1656420340-x4VZMLXg/landing?follow=%40010okbuc&lp=PCFYfV&liff_id=1656420340-x4VZMLXg">LINE公式アカウント</a>
        </div>
        <img src="{{ asset('img/qrcode.png') }}" class="qr_code" alt="">
    </div>
</div>
@endsection

@section('back_button')
<div class="back_button">
    <a href="{{ route('index') }}">←</a>
</div>
@endsection

@section('content_sp')
<p class="footer_item_title_sp">ヘルプ・お問い合わせ</p>
<div class="help_content">
    <div class="help_text">
    Cポンお店ナビ(本サイト)に関するご質問等がございましたら、下記QRコードを読み取ってLINE公式アカウントを登録して頂き、お問い合わせをお願い致します。
    </div>
    <div class="line_url">
        <a href="https://liff.line.me/1656420340-x4VZMLXg/landing?follow=%40010okbuc&lp=PCFYfV&liff_id=1656420340-x4VZMLXg">LINE公式アカウント</a>
    </div>
    <img src="{{ asset('img/qrcode.png') }}" class="qr_code_sp" alt="">
</div>
@endsection