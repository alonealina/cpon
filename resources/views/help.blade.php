@extends('layouts.app')

@section('content')

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