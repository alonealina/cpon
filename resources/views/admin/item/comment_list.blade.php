<div class="restaurant_list_menu filter_flex">
    <div class="restaurant_release_text">
    一括操作
    </div>
</div>

<div class="restaurant_list_menu filter_flex">
    <div class="check_delete_button"><a href="#" onclick="clickCheckDeleteButton()">削除</a></div>
    <div class="restaurant_list_message">{{ session('message') }}</div>
    @include('admin.item.comment_number')
</div>

<div class="restaurant_list">
    <div class="restaurant_list_column">
        <div class="restaurant_list_checkbox">
            <input type="checkbox" id="all">
        </div>
        <div class="comment_list_img">
            <div class="restaurant_item_name">画像</div>
        </div>
        <div class="menu_list_name">
            <div class="restaurant_item_name">お名前</div>
        </div>
        <div class="comment_list_fivestar">
            <div class="restaurant_item_name">評価</div>
        </div>
        <div class="comment_list_content">
            <div class="restaurant_item_name">クチコミ内容</div>
        </div>
        <div class="comment_list_created">
            <div class="restaurant_item_name">登録時間</div>
        </div>
    </div>
    <form id="boxes" name="restaurant_list_form" action="{{ route('admin.comment_list_update') }}" method="get">
    {{ Form::hidden('restaurant_id', $restaurant_id) }}
        @foreach($comments as $comment)
        <div class="restaurant_list_column">
            <div class="restaurant_list_checkbox">
                <input type="checkbox" name="chk[]" value="{{ $comment->id }}">
            </div>
            <div class="comment_list_img">
                <div class="restaurant_item_name">
                    @if (!empty($comment->comment_img1))
                    <img src="../../restaurant/{{ $restaurant_id }}/comment/{{ $comment->comment_img1 }}" class="menu_img">
                    @endif
                    @if (!empty($comment->comment_img2))
                    <img src="../../restaurant/{{ $restaurant_id }}/comment/{{ $comment->comment_img2 }}" class="menu_img">
                    @endif
                    @if (!empty($comment->comment_img3))
                    <img src="../../restaurant/{{ $restaurant_id }}/comment/{{ $comment->comment_img3 }}" class="menu_img">
                    @endif
                    @if (!empty($comment->comment_img4))
                    <img src="../../restaurant/{{ $restaurant_id }}/comment/{{ $comment->comment_img4 }}" class="menu_img">
                    @endif
                    @if (!empty($comment->comment_img5))
                    <img src="../../restaurant/{{ $restaurant_id }}/comment/{{ $comment->comment_img5 }}" class="menu_img">
                    @endif
                </div>
            </div>
            <div class="menu_list_name">
                <div class="restaurant_item_name">{{ $comment->user_name }}</div>
            </div>
            <div class="comment_list_fivestar">
                <div class="restaurant_item_name">{{ $comment->fivestar }}.0</div>
            </div>
            <div class="comment_list_content">
                <div class="restaurant_item_name">{{ $comment->comment }}</div>
            </div>
            <div class="comment_list_created">
                <div class="restaurant_item_name">{{ $comment->created_at }}</div>
            </div>
            <div class="menu_list_button_blue">
                <a href="{{ route('admin.comment_detail', ['id_r' => $restaurant_id, 'id_c' => $comment->id]) }}">詳細</a>
            </div>
            <div class="menu_list_button_red">
                <a href="{{ route('admin.comment_delete', ['id_r' => $restaurant_id, 'id_c' => $comment->id]) }}" onclick="return confirm('本当に削除しますか？')">削除</a>
            </div>
        </div>
        @endforeach
    </form>
    <div class="d-flex justify-content-center">
    {{ $comments->appends(request()->query())->links('pagination::default') }}
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script>
selected = document.getElementById("change_number");
selected.onchange = function() {
window.location.href = selected.value;
};

</script>

<div id="overlay" class="overlay"></div>
<!-- モーダルウィンドウ -->
<div class="modal-window">
<div class="modal-text">本当に削除しますか？</div>
<button class="js-close button-close">クチコミ管理へ戻る</button>
</div>