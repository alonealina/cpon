@extends('layouts.app_admin')

@section('content')
<nav class="navbar admin_header">
    <div class="content_title">メニュー情報編集</div>
    <div class="button_red_admin">
        <a href="{{ route('admin.menu_list', ['id' => $restaurant_id]) }}">メニュー管理ページ</a>
    </div>
</nav>

<div class="menu_form">
    <form id="form" name="regist_form" action="{{ route('admin.menu_update') }}" method="post" enctype="multipart/form-data">
        @csrf
        {{ Form::hidden('restaurant_id', $restaurant_id) }}
        {{ Form::hidden('menu_id', $menu_id) }}

        <div class="regist_form_item">
            <div class="admin_form_name">画像（正方形300px以上を推奨）</div>
            @if($errors->has('img'))
            <div class="comment_error">{{ $errors->first('img') }}</div>
            @endif
            <div class="regist_file_button"><input type="file" id="file_btn_main" accept="image/*" onclick="fileCheckMain();" name="img"></div>
            <div class="img_tmb_main">
                @if (!empty($menu->img))
                <img src="../../../restaurant/{{ $restaurant_id }}/comment/menu/{{ $menu->img }}">
                @endif
            </div>
        </div>

        <div class="regist_form_item">
            <div class="admin_form_name">メニュー名<p class="required_mark">※必須</p></div>
            @if($errors->has('name'))
            <div class="comment_error">{{ $errors->first('name') }}</div>
            @endif
            {{ Form::text('name', old('name', $menu->name), ['class' => 'name_input', 'maxlength' => 20]) }}
        </div>

        <div class="regist_form_item">
            <div class="admin_form_name">値段</div>
            @if($errors->has('price'))
            <div class="comment_error">{{ $errors->first('price') }}</div>
            @endif
            {{ Form::text('price', old('price', $menu->price), ['class' => 'price_input', 'maxlength' => 20]) }}　円
        </div>

        <div class="regist_form_item">
            <div class="admin_form_name">メニュー説明文（30文字まで）</div>
            @if($errors->has('explain'))
            <div class="comment_error">{{ $errors->first('explain') }}</div>
            @endif
            {{ Form::text('explain', old('explain', $menu->explain), ['class' => 'explain_input', 'maxlength' => 30]) }}
        </div>


        <div class="button_black">
            <a href="#" onclick="clickRegistButton()">メニュー情報を更新する</a>
        </div>
    </form>
    <script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
</div>

@endsection


