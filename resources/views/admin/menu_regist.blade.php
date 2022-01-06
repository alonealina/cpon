@extends('layouts.app_admin')

@section('content')
<nav class="navbar admin_header">
    <div class="content_title">メニュー登録</div>
    <div class="button_red_admin">
        <a href="{{ route('admin.menu_list', ['id' => $restaurant_id]) }}">メニュー管理ページ</a>
    </div>
</nav>

<div class="menu_form">
    @if($errors->has('img'))
    <div class="comment_error">{{ $errors->first('img') }}</div>
    @endif
    @if($errors->has('name'))
    <div class="comment_error">{{ $errors->first('name') }}</div>
    @endif
    @if($errors->has('price'))
    <div class="comment_error">{{ $errors->first('price') }}</div>
    @endif
    @if($errors->has('explain'))
    <div class="comment_error">{{ $errors->first('explain') }}</div>
    @endif

    <form id="form" name="regist_form" action="{{ route('admin.menu_store') }}" method="post" enctype="multipart/form-data">
    {{ Form::hidden('restaurant_id', $restaurant_id) }}
        @csrf

        <div class="regist_form_item">
            <div class="admin_form_name">画像（正方形300px以上を推奨）<p class="required_mark">※必須</p></div>
            <div class="regist_file_button"><input type="file" id="file_btn_main" accept="image/*" onclick="fileCheckMain();" name="img"></div>
            <div class="img_tmb_main"></div>
        </div>

        <div class="regist_form_item">
            <div class="admin_form_name">メニュー名<p class="required_mark">※必須</p></div>
            {{ Form::text('name', old('name'), ['class' => 'name_input', 'maxlength' => 20]) }}
        </div>

        <div class="regist_form_item">
            <div class="admin_form_name">値段<p class="required_mark">※必須</p></div>
            {{ Form::text('price', old('price'), ['class' => 'price_input', 'maxlength' => 10]) }}　円
        </div>

        <div class="regist_form_item">
            <div class="admin_form_name">メニュー説明文（30文字まで）</div>
            {{ Form::text('explain', old('explain'), ['class' => 'explain_input', 'maxlength' => 30]) }}
        </div>

    </form>
    <script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
</div>
<div class="regist_button menu_regist_button">
    <a href="#" onclick="clickRegistButton()">メニューを登録する</a>
</div>
@endsection
