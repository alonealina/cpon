@extends('layouts.app_admin')

@section('content')

<nav class="navbar admin_header">
    <div class="content_title">「{{ $restaurant_name }}」のメニュー一覧</div>
    <div class="button_red_admin">
        <a href="{{ route('admin.menu_regist', ['id' => $restaurant_id]) }}">新規メニュー登録</a>
    </div>
</nav>
<div class="admin_content">
    @include('form.admin_menu_search')

    @include('admin.item.menu_list')
</div>

@endsection


