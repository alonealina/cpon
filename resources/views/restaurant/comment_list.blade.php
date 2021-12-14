<div class="comment_list" id="comment_list">
    <div class="comment_list_header">
        <p class="comment_list_title">コメント一覧</p>
        <div class="button_comment">
            <a href="{{ route('restaurant.comment_form', ['id' => $restaurant_id]) }}">コメントを投稿する</a>
        </div>
    </div>
    <div class="number">
        @if ($comments->total() != 0)
        <b>{{ ($comments->currentPage() -1) * $comments->perPage() + 1}}</b> ～ 
        <b>{{ (($comments->currentPage() -1) * $comments->perPage() + 1) + (count($comments) -1) }}</b>件を表示 ／ 
        @endif
        全<b>{{ $comments->total() }}</b>件
        <select class="comment_sort_select" name="sort" id="change_sort_{{ $version }}">
            @if($pagename == 'show')
                <option value="{{ route('restaurant.show', ['id' => $restaurant_id, 'column' => 'created_at', 'sort' => 'desc']) }}"
                @if($column == "created_at" && $sort == "desc") selected @endif>投稿日時（降順）</option>
                <option value="{{ route('restaurant.show', ['id' => $restaurant_id, 'column' => 'created_at', 'sort' => 'asc']) }}"
                @if($column == "created_at" && $sort == "asc") selected @endif>投稿日時（昇順）</option>
                <option value="{{ route('restaurant.show', ['id' => $restaurant_id, 'column' => 'fivestar', 'sort' => 'desc']) }}"
                @if($column == "fivestar" && $sort == "desc") selected @endif>評価（降順）</option>
                <option value="{{ route('restaurant.show', ['id' => $restaurant_id, 'column' => 'fivestar', 'sort' => 'asc']) }}"
                @if($column == "fivestar" && $sort == "asc") selected @endif>評価（昇順）</option>
            @else
                <option value="{{ route('restaurant.show_allmenu', ['id' => $restaurant_id, 'column' => 'created_at', 'sort' => 'desc', 'menupage' => $menupage]) }}"
                @if($column == "created_at" && $sort == "desc") selected @endif>投稿日時（降順）</option>
                <option value="{{ route('restaurant.show_allmenu', ['id' => $restaurant_id, 'column' => 'created_at', 'sort' => 'asc', 'menupage' => $menupage]) }}"
                @if($column == "created_at" && $sort == "asc") selected @endif>投稿日時（昇順）</option>
                <option value="{{ route('restaurant.show_allmenu', ['id' => $restaurant_id, 'column' => 'fivestar', 'sort' => 'desc', 'menupage' => $menupage]) }}"
                @if($column == "fivestar" && $sort == "desc") selected @endif>評価（降順）</option>
                <option value="{{ route('restaurant.show_allmenu', ['id' => $restaurant_id, 'column' => 'fivestar', 'sort' => 'asc', 'menupage' => $menupage]) }}"
                @if($column == "fivestar" && $sort == "asc") selected @endif>評価（昇順）</option>
            @endif
        </select>
    </div>
    <hr>
    <div>
        @foreach ($comments as $comment)
        <div class="comment_list_content">
            <b>{{ $comment->user_name }}</b>さんの口コミ　<div class="comment_datetime">{{ $comment->created_at }}</div><br>
            <div class="fivestar">
            @if ($comment->fivestar == 1)
                {{ '★☆☆☆☆' }}
            @elseif ($comment->fivestar == 2)
                {{ '★★☆☆☆' }}
            @elseif ($comment->fivestar == 3)
                {{ '★★★☆☆' }}
            @elseif ($comment->fivestar == 4)
                {{ '★★★★☆' }}
            @elseif ($comment->fivestar == 5)
                {{ '★★★★★' }}
            @endif
            <b>{{ $comment->fivestar }}</b>
            </div>
            <div class="comment_content"><b>{{ $comment->comment }}</b></div>
            @if (!empty($comment->filename))
            <a href="../../uploads/{{ $comment->filename }}" data-lightbox="group{{ $comment->id }}{{ $version }}">
                <img src="../../uploads/{{ $comment->filename }}" width="100px" height="100px">
            </a>
            @endif
        </div>
        <hr>
        @endforeach
    </div>
    <div class="d-flex justify-content-center">
    {{ $comments->links('pagination::comment_list') }}
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script>
    if ("{{ $version }}" == "pc") {
        selected_pc = document.getElementById("change_sort_{{ $version }}");
        selected_pc.onchange = function() {
        window.location.href = selected_pc.value;
    }};
    if ("{{ $version }}" == "ipad") {
        selected_ipad = document.getElementById("change_sort_{{ $version }}");
        selected_ipad.onchange = function() {
        window.location.href = selected_ipad.value;
    }};
</script>