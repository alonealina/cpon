@extends('layouts.app')

@section('content')
<br>
<p class="footer_item_title">ヘルプ・お問い合わせ</p>
<div class="help_content">
    <div class="help_text">
    CポンやCポンモール(本サイト)全体に関するご質問等がございましたら、下記QRコードを読み取って<br>
    LINE公式アカウントを登録して頂き、お問合せをお願い致します。専門スタッフからご回答をさせて頂きます。
    </div>
    <div class="line_url">
        <a href="#">LINE公式アカウント</a>
    </div>
    <img src="{{ asset('img/qrcode.png') }}" class="qr_code" alt="">
</div>
@endsection

@section('content_ipad')
@include('form.header_search_ipad')
<br>
<div class="body_ipad">
    <p class="footer_item_title_ipad">ヘルプ・お問い合わせ</p>
    <div class="help_content">
        <div class="help_text">
        CポンやCポンモール(本サイト)全体に関するご質問等がございましたら、下記QRコードを読み取って<br>
        LINE公式アカウントを登録して頂き、お問合せをお願い致します。専門スタッフからご回答をさせて頂きます。
        </div>
        <div class="line_url">
            <a href="#">LINE公式アカウント</a>
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
<br>
<p class="footer_item_title_sp">ヘルプ・お問い合わせ</p>
<div class="help_content">
    <div class="help_text">
    CポンやCポンモール(本サイト)全体に関するご質問等がございましたら、下記QRコードを読み取ってLINE公式アカウントを登録して頂き、お問合せをお願い致します。専門スタッフからご回答をさせて頂きます。
    </div>
    <div class="line_url">
        <a href="#">LINE公式アカウント</a>
    </div>
    <img src="{{ asset('img/qrcode.png') }}" class="qr_code_sp" alt="">
</div>
@endsection