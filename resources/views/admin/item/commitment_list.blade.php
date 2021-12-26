
<div class="notice_list">
    <div class="setting_list_column">
        <div class="setting_list_title">こだわり条件一覧（20個まで）</div>
        @if($commitments->count() < 20)
        <div class="button_red_admin">
            <a href="{{ route('admin.commitment_regist') }}">こだわり条件登録登録</a>
        </div>
        @endif
    </div>
    @foreach($commitments as $commitment)
    <div class="setting_list_column">
        <div class="setting_list_name">
            <div class="restaurant_item_name">{{ $commitment->name }}</div>
        </div>
        <div class="menu_list_button_blue">
            <a href="{{ route('admin.commitment_edit', ['id' => $commitment->id]) }}">編集</a>
        </div>
        <div class="menu_list_button_red">
            <a href="{{ route('admin.commitment_delete', ['id' => $commitment->id]) }}" onclick="return confirm('本当に削除しますか？')" onclick="clickRegistButton()">削除</a>
        </div>
    </div>
    @endforeach
</div>