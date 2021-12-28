@extends('layouts.app_admin')

@section('content')
<nav class="navbar admin_header">
    <div class="content_title">お知らせ登録</div>
    <div class="button_red_admin">
        <a href="{{ route('admin.notice_list') }}">お知らせ管理ページ</a>
    </div>
</nav>

<div class="admin_content">
    <div class="notice_list">
        <form id="form" name="regist_form" action="{{ route('admin.notice_store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="flex_form_item flex_notice_title">
                <div class="felx_form_title">タイトル</div>
                <div class="felx_form_content">
                    @if($errors->has('title'))
                    <div class="comment_error">{{ $errors->first('title') }}</div>
                    @endif
                    {{ Form::text('title', old('title'), ['class' => 'notice_title_input', 'maxlength' => 20]) }}
                </div>
            </div>

            <div class="flex_form_item">
                <div class="felx_form_title">内容</div>
                <div class="felx_form_content">
                    @if($errors->has('content'))
                    <div class="comment_error">{{ $errors->first('content') }}</div>
                    @endif
                    {{ Form::textarea('content', old('content'), ['class' => 'form-control notice_content_input', 'rows' => 10, 'maxlength' => 3000]) }}
                </div>
            </div>

            <div class="regist_button">
                <a href="#" onclick="clickRegistButton()">お知らせを登録する</a>
            </div>
        </form>
    </div>
</div>

@endsection


@section('content_ipad')

@endsection

