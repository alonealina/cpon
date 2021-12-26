@extends('layouts.app_admin')

@section('content')

<nav class="navbar admin_header">
    <div class="content_title">お知らせ管理</div>
    <div class="button_red_admin">
        <a href="{{ route('admin.notice_regist') }}">お知らせ登録</a>
    </div>
</nav>
<div class="admin_content">
    @include('admin.item.notice_list')
</div>

@endsection


