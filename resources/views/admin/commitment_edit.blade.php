@extends('layouts.app_admin')

@section('content')
<nav class="navbar admin_header">
    <div class="content_title">こだわり条件登録</div>
    <div class="button_red_admin">
        <a href="{{ route('admin.notice_list') }}">各種設定ページ</a>
    </div>
</nav>

<div class="admin_content">
    <div class="notice_list">
        <form id="form" name="regist_form" action="{{ route('admin.commitment_update') }}" method="post" enctype="multipart/form-data">
            @if($errors->has('name'))
            <div class="comment_error">{{ $errors->first('name') }}</div>
            @endif

            @csrf
            {{ Form::hidden('id', $commitment->id) }}
            <div class="flex_form_item flex_notice_title">
                <div class="felx_form_title">タイトル</div>
                <div class="felx_form_content">
                {{ Form::text('name', old('name', $commitment->name), ['class' => 'setting_name_input', 'maxlength' => 20]) }}
                </div>
            </div>

            <div class="regist_button">
                <a href="#" onclick="clickRegistButton()">こだわり条件を更新する</a>
            </div>
        </form>
    </div>
</div>

@endsection


@section('content_ipad')

@endsection

