@extends('layouts.app')

@section('content')
<div class="comment_form">
    <form id="form" name="regist_form" action="{{ route('admin.notice_store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="comment_form_title">お知らせの登録</div>

        <div class="regist_form_item">
            <div class="user_name_title">タイトル<p class="required_mark">必須</p></div>
            @if($errors->has('title'))
            <div class="comment_error">{{ $errors->first('title') }}</div>
            @endif
            {{ Form::text('title', old('title'), ['class' => 'title_input', 'maxlength' => 20]) }}
        </div>

        <div class="regist_form_item">
            <div class="user_name_title">本文<p class="required_mark">必須</p></div>
            @if($errors->has('content'))
            <div class="comment_error">{{ $errors->first('content') }}</div>
            @endif
            {{ Form::textarea('content', old('content'), ['class' => 'form-control content_input', 'rows' => 6]) }}
        </div>

        <div class="regist_form_item">
        <div class="user_name_title">お知らせ日時<p class="required_mark">必須</p></div>
            @if($errors->has('notice_date'))
            <div class="comment_error">{{ $errors->first('notice_date') }}</div>
            @endif
            {{ Form::date('notice_date', old('notice_date'), ['class' => 'notice_date_input']) }}
        </div>

        <div class="button_black">
            <a href="#" onclick="clickRegistButton()">確認画面へ</a>
        </div>
    </form>
</div>

@endsection


@section('content_ipad')

@endsection

