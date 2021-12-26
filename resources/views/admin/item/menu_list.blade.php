<div class="restaurant_list_menu filter_flex">
    ステータス変更
    <div class="release_on_button"><a href="#" onclick="clickReleaseOnButton()">公開</a></div>
    <div class="release_off_button"><a href="#" onclick="clickReleaseOffButton()">非公開</a></div>
    イチオシ設定（12個まで）
    <div class="recommend_on_button"><a href="#" onclick="clickRecommendOnButton()">設定</a></div>
    <div class="recommend_off_button"><a href="#" onclick="clickRecommendOffButton()">解除</a></div>
    <div class="restaurant_list_message">{{ session('message') }}</div>
</div>

<div class="restaurant_list">
    <div class="restaurant_list_column">
        <div class="restaurant_list_checkbox">
            <input type="checkbox" id="all">
        </div>
        <div class="restaurant_list_id">
            <div class="restaurant_item_name">画像</div>
        </div>
        <div class="menu_list_name">
            <div class="restaurant_item_name">メニュー名</div>
        </div>
        <div class="menu_list_price">
            <div class="restaurant_item_name">値段</div>
        </div>
        <div class="menu_list_explain">
            <div class="restaurant_item_name">説明文</div>
        </div>
        <div class="restaurant_list_status">
            <div class="restaurant_item_name">ステータス</div>
        </div>
        <div class="restaurant_list_recommend">
            <div class="restaurant_item_name">イチオシ</div>
        </div>
        <div class="restaurant_list_created">
            <div class="restaurant_item_name">登録時間</div>
        </div>
        <div class="restaurant_list_updated">
            <div class="restaurant_item_name">更新時間</div>
        </div>
    </div>
    <form id="boxes" name="restaurant_list_form" action="{{ route('admin.menu_list_update') }}" method="get">
    {{ Form::hidden('restaurant_id', $restaurant_id) }}
        @foreach($menus as $menu)
        <div class="restaurant_list_column">
            <div class="restaurant_list_checkbox">
                <input type="checkbox" name="chk[]" value="{{ $menu->id }}">
            </div>
            <div class="restaurant_list_id">
                <div class="restaurant_item_name">{{ $menu->login_id }}</div>
            </div>
            <div class="menu_list_name">
                <div class="restaurant_item_name">{{ $menu->name }}</div>
            </div>
            <div class="menu_list_price">
                <div class="restaurant_item_name">{{ number_format($menu->price) }}円</div>
            </div>
            <div class="menu_list_explain">
                <div class="restaurant_item_name">{{ $menu->explain }}</div>
            </div>
            <div class="restaurant_list_status">
                <div class="restaurant_item_name">@if($menu->release_flg == 1) 公開 @else 非公開 @endif</div>
            </div>
            <div class="restaurant_list_recommend">
                <div class="restaurant_item_name">@if($menu->recommend_flg == 1) 〇 @else ‐ @endif</div>
            </div>
            <div class="restaurant_list_created">
                <div class="restaurant_item_name">{{ $menu->created_at }}</div>
            </div>
            <div class="restaurant_list_updated">
                <div class="restaurant_item_name">{{ $menu->updated_at }}</div>
            </div>
            <div class="menu_list_button_blue">
                <a href="restaurant_edit/{{ $menu->id }}" onclick="clickRegistButton()">編集</a>
            </div>
            <div class="menu_list_button_red">
                <a href="#" onclick="clickRegistButton()">削除</a>
            </div>
        </div>
        @endforeach
    </form>
    <div class="d-flex justify-content-center">
    {{ $menus->appends(request()->query())->links('pagination::default') }}
    </div>
</div>