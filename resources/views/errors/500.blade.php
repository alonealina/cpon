@extends('layouts.app')

@section('content')
<br>
<p class="footer_item_title">エラー</p>
<div class="error_content">
    サーバーエラーが発生しました。
</div>
<div class="button_black button_error">
    <a href="{{ route('index') }}">TOPへ戻る</a>
</div>
@endsection

@section('content_ipad')
@include('form.header_search_ipad')
<br>
<div class="body_ipad">
    <p class="footer_item_title_ipad">エラー</p>
    <div class="error_content">
        サーバーエラーが発生しました。
    </div>
    <div class="button_black button_error">
        <a href="{{ route('index') }}">TOPへ戻る</a>
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
<p class="error_title_sp">エラー</p>
<div class="error_content">
    サーバーエラーが発生しました。
</div>
@endsection