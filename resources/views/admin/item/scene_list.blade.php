
<div class="notice_list">
    <div class="setting_list_column">
        <div class="setting_list_title">利用シーン一覧（20個まで）</div>
        @if($scenes->count() < 20)
        <div class="button_red_admin">
            <a href="{{ route('admin.scene_regist') }}">利用シーン登録登録</a>
        </div>
        @endif
    </div>
    @foreach($scenes as $scene)
    <div class="setting_list_column">
        <div class="setting_list_name">
            <div class="restaurant_item_name">{{ $scene->name }}</div>
        </div>
        <div class="menu_list_button_blue">
            <a href="{{ route('admin.scene_edit', ['id' => $scene->id]) }}">編集</a>
        </div>
        <div class="menu_list_button_red">
            <a href="{{ route('admin.scene_delete', ['id' => $scene->id]) }}" onclick="return confirm('本当に削除しますか？')" onclick="clickRegistButton()">削除</a>
        </div>
    </div>
    @endforeach
</div>