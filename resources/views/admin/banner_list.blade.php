@extends('layouts.app_admin')

@section('content')

<nav class="navbar admin_header">
    <div class="content_title">ヘッダーバナー画像管理</div>
    <div class="button_red_admin">
        <a href="{{ route('admin.banner_regist') }}">バナー登録</a>
    </div>
</nav>
<div class="admin_content">
    @include('admin.item.banner_list')
</div>

@endsection


