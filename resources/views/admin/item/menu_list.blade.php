<div class="restaurant_list_menu filter_flex">
    <div class="restaurant_release_text">
    ステータス変更
    </div>
    <div class="restaurant_recommend_text">
    イチオシ設定（12個まで）
    </div>
</div>

<div class="restaurant_list_menu filter_flex">
    <div class="release_on_button"><a href="#" onclick="clickReleaseOnButton()">公開</a></div>
    <div class="release_off_button"><a href="#" onclick="clickReleaseOffButton()">非公開</a></div>
    <div class="recommend_on_button"><a href="#" onclick="clickRecommendOnButton()">設定</a></div>
    <div class="recommend_off_button"><a href="#" onclick="clickRecommendOffButton()">解除</a></div>
    <div class="csv_button"><a href="#" onclick="openCsvImportButton()">CSVインポート</a></div>
    <div class="csv_button"><a href="#" onclick="clickCsvExportButton()">CSVエクスポート</a></div>
    <div class="restaurant_list_message">{{ session('message') }}</div>
    @include('admin.item.menu_number')
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
        {{ Form::hidden('menu_id[]', $menu->id) }}
        <div class="restaurant_list_column">
            <div class="restaurant_list_checkbox">
                <input type="checkbox" name="chk[]" value="{{ $menu->id }}">
            </div>
            <div class="restaurant_list_id">
                <div class="restaurant_item_name">
                    @if (empty($menu->img))
                    <img src="../../img/imgerror.jpg" class="menu_img">
                    @else
                    <img src="../../restaurant/{{ $restaurant_id }}/menu/{{ $menu->img }}" class="menu_img">
                    @endif
                </div>
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
                <a href="{{ route('admin.menu_edit', ['id_r' => $restaurant_id, 'id_m' => $menu->id]) }}" onclick="clickRegistButton()">編集</a>
            </div>
            <div class="menu_list_button_red">
                <a href="{{ route('admin.menu_delete', ['id_r' => $restaurant_id, 'id_m' => $menu->id]) }}" onclick="return confirm('本当に削除しますか？')">削除</a>
            </div>
        </div>
        @endforeach
    </form>
    <div class="d-flex justify-content-center">
    {{ $menus->appends(request()->query())->links('pagination::default') }}
    </div>
</div>
<script>
selected = document.getElementById("change_number");
selected.onchange = function() {
window.location.href = selected.value;
};
</script>

<div id="overlay" class="overlay" onclick="modalClose()"></div>
<!-- モーダルウィンドウ -->
<div class="modal-window">
<form name="csv_import_form" action="{{ route('admin.menu_csv_import') }}" method="post" enctype="multipart/form-data">
{{ Form::hidden('restaurant_id', $restaurant_id) }}
    @csrf
    <input type="file" id="file_btn_csv" accept=".csv" name="csv">
    <button class="js-close button-close" onclick="clickCsvImportButton()">CSVをインポートする</button>
</form>
</div>