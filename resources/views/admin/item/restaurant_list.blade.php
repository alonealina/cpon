<div class="restaurant_list_menu filter_flex">
    <div class="restaurant_release_text">
    ステータス変更
    </div>
    <div class="restaurant_recommend_text">
    おすすめ設定（6店舗まで）
    </div>
    <div class="">
    おすすめ設定（6店舗まで）
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
    @include('admin.item.restaurant_number')
</div>

<div class="restaurant_list">
    <div class="restaurant_list_column">
        <div class="restaurant_list_checkbox">
            <input type="checkbox" id="all">
        </div>
        <div class="restaurant_list_id">
            <div class="restaurant_item_name">店舗ID</div>
        </div>
        <div class="restaurant_list_name">
            <div class="restaurant_item_name">店舗名</div>
        </div>
        <div class="restaurant_list_address">
            <div class="restaurant_item_name">住所</div>
        </div>
        <div class="restaurant_list_tel">
            <div class="restaurant_item_name">電話番号</div>
        </div>
        <div class="restaurant_list_time">
            <div class="restaurant_item_name">営業時間</div>
        </div>
        <div class="restaurant_list_fivestar">
            <div class="restaurant_item_name">評価</div>
        </div>
        <div class="restaurant_list_status">
            <div class="restaurant_item_name">ステータス</div>
        </div>
        <div class="restaurant_list_recommend">
            <div class="restaurant_item_name">おすすめ</div>
        </div>
        <div class="restaurant_list_created">
            <div class="restaurant_item_name">登録時間</div>
        </div>
        <div class="restaurant_list_updated">
            <div class="restaurant_item_name">更新時間</div>
        </div>
    </div>
    <form id="boxes" name="restaurant_list_form" action="{{ route('admin.restaurant_list_update') }}" method="get">
        @foreach($restaurants as $restaurant)
        {{ Form::hidden('restaurant_id[]', $restaurant->id) }}
        <div class="restaurant_list_column">
            <div class="restaurant_list_checkbox">
                <input type="checkbox" name="chk[]" value="{{ $restaurant->id }}">
            </div>
            <div class="restaurant_list_id">
                <div class="restaurant_item_name">{{ $restaurant->login_id }}</div>
            </div>
            <div class="restaurant_list_name">
                <div class="restaurant_item_name">{{ $restaurant->name1 }} {{ $restaurant->name2 }} {{ $restaurant->name3 }}</div>
            </div>
            <div class="restaurant_list_address">
                <div class="restaurant_item_name">{{ $restaurant->pref }}{{ $restaurant->address }}</div>
            </div>
            <div class="restaurant_list_tel">
                <div class="restaurant_item_name">{{ $restaurant->tel }}</div>
            </div>
            <div class="restaurant_list_time">
                <div class="restaurant_item_name">{{ $restaurant->open_hm }}～{{ $restaurant->close_hm }}</div>
            </div>
            <div class="restaurant_list_fivestar">
                <div class="restaurant_item_name">{{ $restaurant->avg_star }}</div>
            </div>
            <div class="restaurant_list_status">
                <div class="restaurant_item_name">@if($restaurant->release_flg == 1) 公開 @else 非公開 @endif</div>
            </div>
            <div class="restaurant_list_recommend">
                <div class="restaurant_item_name">@if($restaurant->recommend_flg == 1) 〇 @else ‐ @endif</div>
            </div>
            <div class="restaurant_list_created">
                <div class="restaurant_item_name">{{ $restaurant->created_at }}</div>
            </div>
            <div class="restaurant_list_updated">
                <div class="restaurant_item_name">{{ $restaurant->updated_at }}</div>
            </div>
            <div class="restaurant_list_button_blue">
                <a href="restaurant_edit/{{ $restaurant->id }}">編集</a>
            </div>
            <div class="restaurant_list_button_blue">
                <a href="{{ route('admin.menu_list', ['id' => $restaurant->id]) }}">メニュー<br>詳細</a>
            </div>
            <div class="restaurant_list_button_red">
                <a href="restaurant_delete/{{ $restaurant->id }}" onclick="return confirm('本当に削除しますか？')">削除</a>
            </div>
        </div>
        @endforeach
    </form>
    <div class="d-flex justify-content-center">
    {{ $restaurants->appends(request()->query())->links('pagination::default') }}
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
<form name="csv_import_form" action="{{ route('admin.restaurant_csv_import') }}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="file" id="file_btn_csv" accept=".csv" name="csv">
    <button class="js-close button-close" onclick="clickCsvImportButton()">CSVをインポートする</button>
</form>
</div>