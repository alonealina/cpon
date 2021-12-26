@extends('layouts.app_admin')

@section('content')
<nav class="navbar admin_header">
    <div class="content_title">バナー登録</div>
    <div class="button_red_admin">
        <a href="{{ route('admin.notice_list') }}">画像管理ページ</a>
    </div>
</nav>

<div class="admin_content">
    <div class="notice_list">
        <form id="form" name="regist_form" action="{{ route('admin.banner_store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="flex_form_item">
                <div class="felx_form_title">画像アップロード</div>
                @if($errors->has('img'))
                <div class="comment_error">{{ $errors->first('img') }}</div>
                @endif
                <div class="felx_form_content">
                    <div class="regist_file_button"><input type="file" id="file_btn_banner" accept="image/*" onclick="fileCheckBanner();" name="img"></div>
                    <div class="img_tmb_banner"></div>
                </div>
            </div>

            <div class="flex_form_item">
                <div class="felx_form_title">URL</div>
                @if($errors->has('url'))
                <div class="comment_error">{{ $errors->first('url') }}</div>
                @endif
                <div class="felx_form_content">
                {{ Form::text('url', old('url'), ['class' => 'banner_url_input', 'maxlength' => 255]) }}
                </div>
            </div>

            <div class="flex_form_item">
                <div class="felx_form_title">表示順位</div>
                <div class="felx_form_content">
                    <select name="priority">
                        @foreach (config('const.Priority') as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="button_black">
                <a href="#" onclick="clickRegistButton()">画像を登録する</a>
            </div>
        </form>
    </div>
</div>

@endsection


@section('content_ipad')

@endsection

