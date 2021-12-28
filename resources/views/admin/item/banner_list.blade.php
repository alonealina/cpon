
<div class="notice_list">
    <div class="restaurant_list_column border_bottom_column">
        <div class="restaurant_item_name">画像一覧（20枚まで）</div>
    </div>
    <div class="restaurant_list_column border_bottom_column">
        <div class="banner_list_title">
            <div class="restaurant_item_name">画像</div>
        </div>
        <div class="banner_list_url">
            <div class="restaurant_item_name">URL</div>
        </div>
        <div class="notice_list_status">
            <div class="restaurant_item_name">ステータス</div>
        </div>
    </div>
    @foreach($banners as $banner)
    <div class="restaurant_list_column">
        <div class="banner_list_title">
            <img src="../../banner/{{ $banner->img }}" class="menu_img">
        </div>
        <div class="banner_list_url">
            <div class="restaurant_item_name">{{ $banner->url }}</div>
        </div>
        <div class="notice_list_status">
            <div class="restaurant_item_name">@if($banner->priority == 7) 非公開 @else {{ $banner->priority }} @endif</div>
        </div>
        <div class="menu_list_button_blue">
            <a href="{{ route('admin.banner_edit', ['id' => $banner->id]) }}">編集</a>
        </div>
        <div class="menu_list_button_red">
            <a href="{{ route('admin.banner_delete', ['id' => $banner->id]) }}" onclick="return confirm('本当に削除しますか？')">削除</a>
        </div>
    </div>
    @endforeach
</div>