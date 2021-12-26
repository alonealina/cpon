@extends('layouts.app_admin')

@section('content')

<nav class="navbar admin_header">
    <div class="content_title">店舗管理ページ</div>
</nav>
<div class="admin_button_list">
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
    <div class="admin_button">
        <a href="#">店舗情報編集</a>
    </div>
    <div class="admin_button">
        <a href="#">メニュー管理</a>
    </div>
    <div class="admin_button">
        <a href="#">クチコミ管理</a>
    </div>
    <div class="admin_button">
        <a href="#">マニュアルダウンロード</a>
    </div>
</div>

@endsection


