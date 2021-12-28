@extends('layouts.app_admin')

@section('content')
<nav class="navbar admin_header">
    <div class="content_title">バナー編集</div>
    <div class="button_red_admin">
        <a href="{{ route('admin.notice_list') }}">画像管理ページ</a>
    </div>
</nav>

<div class="admin_content">
    <div class="notice_list">
        <form id="form" name="regist_form" action="{{ route('admin.banner_update') }}" method="post" enctype="multipart/form-data">
            @csrf
            {{ Form::hidden('id', $banner->id) }}
            <div class="flex_form_item flex_notice_title">
                <div class="felx_form_title">画像アップロード</div>
                <div class="felx_form_content">
                    @if($errors->has('img'))
                    <div class="comment_error">{{ $errors->first('img') }}</div>
                    @endif
                    <div class="regist_file_button"><input type="file" id="file_btn_banner" accept="image/*" onclick="fileCheckBanner();" name="img"></div>
                    <div class="img_tmb_banner"><img src="../../../banner/{{ $banner->img }}"></div>
                </div>
            </div>

            <div class="flex_form_item">
                <div class="felx_form_title">URL</div>
                <div class="felx_form_content">
                    @if($errors->has('url'))
                    <div class="comment_error">{{ $errors->first('url') }}</div>
                    @endif
                    {{ Form::text('url', old('url', $banner->url), ['class' => 'notice_title_input', 'maxlength' => 255]) }}
                </div>
            </div>

            <div class="flex_form_item">
                <div class="felx_form_title">表示順位</div>
                <div class="felx_form_content">
                    @if($errors->has('priority'))
                    <div class="comment_error">{{ $errors->first('priority') }}</div>
                    @endif
                    <select name="priority" class="flex_form_priority">
                        @foreach (config('const.Priority') as $key => $value)
                        <option value="{{ $key }}" @if(old('priority', $banner->priority) == $key) selected @endif>{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="regist_button">
                <a href="#" onclick="clickRegistButton()">画像を更新する</a>
            </div>
        </form>
    </div>
</div>

@endsection


@section('content_ipad')

@endsection

