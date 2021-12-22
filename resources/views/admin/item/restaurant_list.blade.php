<div class="restaurant_list_menu filter_flex">
    一括操作
    <div class="release_on_button"><a href="#" onclick="clickReleaseOnButton()">公開</a></div>
    <div class="release_off_button"><a href="#" onclick="clickReleaseOffButton()">非公開</a></div>
    おすすめ
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
        <div class="restaurant_list_column">
            <div class="restaurant_list_checkbox">
                <input type="checkbox" name="chk[]" value="{{ $restaurant->id }}">
            </div>
            <div class="restaurant_list_id">
                <div class="restaurant_item_name">{{ $restaurant->id }}</div>
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
                <a href="#" onclick="clickRegistButton()">編集</a>
            </div>
            <div class="restaurant_list_button_blue">
                <a href="#" onclick="clickRegistButton()">複製</a>
            </div>
            <div class="restaurant_list_button_red">
                <a href="#" onclick="clickRegistButton()">削除</a>
            </div>
        </div>
        @endforeach
    </form>
    <div class="d-flex justify-content-center">
    {{ $restaurants->appends(request()->query())->links('pagination::default') }}
    </div>
</div>