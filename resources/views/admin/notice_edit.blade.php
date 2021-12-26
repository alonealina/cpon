@extends('layouts.app_admin')

@section('content')
<nav class="navbar admin_header">
    <div class="content_title">お知らせ情報更新</div>
    <div class="button_red_admin">
        <a href="{{ route('admin.notice_list') }}">お知らせ管理ページ</a>
    </div>
</nav>

<div class="admin_content">
    <div class="notice_list">
        <form id="form" name="regist_form" action="{{ route('admin.notice_update') }}" method="post" enctype="multipart/form-data">
            @csrf
            {{ Form::hidden('id', $notice->id) }}
            <div class="comment_form_title">お知らせの編集</div>

            <div class="regist_form_item">
                <div class="user_name_title">タイトル</div>
                @if($errors->has('title'))
                <div class="comment_error">{{ $errors->first('title') }}</div>
                @endif
                {{ Form::text('title', old('title', $notice->title), ['class' => 'title_input', 'maxlength' => 20]) }}
            </div>

            <div class="regist_form_item">
                <div class="user_name_title">本文</div>
                @if($errors->has('content'))
                <div class="comment_error">{{ $errors->first('content') }}</div>
                @endif
                {{ Form::textarea('content', old('content', $notice->content), ['class' => 'form-control content_input', 'rows' => 10]) }}
            </div>

            <div class="button_black">
                <a href="#" onclick="clickRegistButton()">お知らせを更新する</a>
            </div>
        </form>
    </div>
</div>

@endsection


@section('content_ipad')

@endsection

