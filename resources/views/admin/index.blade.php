@extends('layouts.app_admin')

@section('content')

<nav class="navbar admin_header">
    <div class="content_title">店舗管理ページ</div>
</nav>
<div class="admin_button_list">
    <!-- 後で変更 -->
    @if(false)
    <div class="admin_button">
        <a href="{{ route('admin.restaurant_list') }}">店舗管理</a>
    </div>
    <div class="admin_button">
        <a href="{{ route('admin.notice_list') }}">お知らせ管理</a>
    </div>
    <div class="admin_button">
        <a href="{{ route('admin.banner_list') }}">画像管理</a>
    </div>
    <div class="admin_button">
        <a href="{{ route('admin.setting_list') }}">各種設定</a>
    </div>
    @else
    <div class="admin_button">
        <!-- 後で変更 -->
        <a href="restaurant_edit/71">店舗情報編集</a>
    </div>
    <div class="admin_button">
        <!-- 後で変更 -->
        <a href="{{ route('admin.menu_list', ['id' => 71]) }}">メニュー管理</a>
    </div>
    <div class="admin_button">
        <a href="{{ route('admin.comment_list', ['id' => 71]) }}">クチコミ管理</a>
    </div>
    <div class="admin_button">
        <a href="#">マニュアルダウンロード</a>
    </div>
    @endif
</div>

@endsection


