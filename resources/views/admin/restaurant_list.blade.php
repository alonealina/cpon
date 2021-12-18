@extends('layouts.app_admin')

@section('content')

<nav class="navbar admin_header">
    <div class="content_title">店舗管理</div>
    <div class="button_red_admin">
        <a href="#" onclick="clickRegistButton()">店舗新規登録</a>
    </div>
</nav>
<div class="admin_content">
    @include('form.admin_restaurant_search')

</div>

@endsection


