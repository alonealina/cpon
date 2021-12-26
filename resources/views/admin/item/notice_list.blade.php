
<div class="notice_list">
    <div class="restaurant_list_column">
        <div class="menu_list_name">
            <div class="restaurant_item_name">更新日時</div>
        </div>
        <div class="notice_list_title">
            <div class="restaurant_item_name">タイトル</div>
        </div>
        <div class="notice_list_status">
            <div class="restaurant_item_name">ステータス</div>
        </div>
    </div>
    @foreach($notices as $notice)
    <div class="restaurant_list_column">
        <div class="menu_list_name">
            <div class="restaurant_item_name">{{ $notice->notice_date }}</div>
        </div>
        <div class="notice_list_title">
            <div class="restaurant_item_name">{{ $notice->title }}</div>
        </div>
        <div class="notice_list_status">
            <div class="restaurant_item_name">@if($notice->release_flg == 1) 公開 @else 非公開 @endif</div>
        </div>
        <div class="menu_list_button_blue">
            <a href="{{ route('admin.notice_edit', ['id' => $notice->id]) }}">@if($notice->release_flg == 1) 非公開 @else 公開 @endif</a>
        </div>
        <div class="menu_list_button_blue">
            <a href="{{ route('admin.notice_edit', ['id' => $notice->id]) }}">編集</a>
        </div>
        <div class="menu_list_button_red">
            <a href="#" onclick="clickRegistButton()">削除</a>
        </div>
    </div>
    @endforeach
    <div class="d-flex justify-content-center">
    {{ $notices->appends(request()->query())->links('pagination::default') }}
    </div>
</div>