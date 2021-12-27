@extends('layouts.app_admin')

@section('content')
<nav class="navbar admin_header">
    <div class="content_title">利用シーン登録</div>
    <div class="button_red_admin">
        <a href="{{ route('admin.notice_list') }}">各種設定ページ</a>
    </div>
</nav>

<div class="admin_content">
    <div class="notice_list">
        <form id="form" name="regist_form" action="{{ route('admin.scene_update') }}" method="post" enctype="multipart/form-data">
            @csrf
            {{ Form::hidden('id', $scene->id) }}
            <div class="flex_form_item">
                <div class="felx_form_title">タイトル</div>
                <div class="felx_form_content">
                @if($errors->has('name'))
                <div class="comment_error">{{ $errors->first('name') }}</div>
                @endif
                {{ Form::text('name', old('name', $scene->name), ['class' => 'name_input', 'maxlength' => 20]) }}
                </div>
            </div>

            <div class="button_black">
                <a href="#" onclick="clickRegistButton()">利用シーンを更新する</a>
            </div>
        </form>
    </div>
</div>

@endsection


@section('content_ipad')

@endsection
