@extends('layouts.app_admin')

@section('content')
<nav class="navbar admin_header">
    <div class="content_title">クチコミ詳細</div>
    <div class="button_red_admin">
        <a href="{{ route('admin.notice_list') }}">クチコミ一覧ページ</a>
    </div>
</nav>

<div class="admin_content">
    <div class="comment_detail">
        <div class="flex_form_item">
            <div class="felx_form_title">お名前</div>
            <div class="felx_form_content">
                {{ $comment->user_name }}
            </div>
        </div>
        <hr class="comment_hr">
        <div class="flex_form_item">
            <div class="felx_form_title">評価</div>
            <div class="felx_form_content">
                {{ $comment->fivestar }}.0
            </div>
        </div>
        <hr class="comment_hr">
        <div class="flex_form_item">
            <div class="felx_form_title">クチコミ内容</div>
            <div class="felx_form_content comment_detail_content">
                {{ $comment->comment }}
            </div>
        </div>
        <hr class="comment_hr">
        <div class="flex_form_item">
            <div class="felx_form_title">画像</div>
            <div class="felx_form_content comment_detail_content">
                @if (!empty($comment->comment_img1))
                <img src="../../../restaurant/{{ $restaurant_id }}/comment/{{ $comment->comment_img1 }}" class="comment_detail_img">
                @endif
                @if (!empty($comment->comment_img2))
                <img src="../../../restaurant/{{ $restaurant_id }}/comment/{{ $comment->comment_img2 }}" class="comment_detail_img">
                @endif
                @if (!empty($comment->comment_img3))
                <img src="../../../restaurant/{{ $restaurant_id }}/comment/{{ $comment->comment_img3 }}" class="comment_detail_img">
                @endif
                @if (!empty($comment->comment_img4))
                <img src="../../../restaurant/{{ $restaurant_id }}/comment/{{ $comment->comment_img4 }}" class="comment_detail_img">
                @endif
                @if (!empty($comment->comment_img5))
                <img src="../../../restaurant/{{ $restaurant_id }}/comment/{{ $comment->comment_img5 }}" class="comment_detail_img">
                @endif
            </div>
        </div>
        <hr class="comment_hr">
        <div class="flex_form_item">
            <div class="felx_form_title">登録日時</div>
            <div class="felx_form_content comment_detail_content">
                {{ $comment->created_at }}
            </div>
        </div>

        <div class="button_black">
            <a href="{{ route('admin.comment_delete', ['id_r' => $restaurant_id, 'id_c' => $comment->id]) }}" onclick="return confirm('本当に削除しますか？')">クチコミを削除する</a>
        </div>
    </div>
</div>

@endsection


@section('content_ipad')

@endsection

