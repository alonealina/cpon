@extends('layouts.app')

@section('back_button')
<div class="back_button">
    <a href="{{ route('restaurant.detail', ['id' => $restaurant->id]) }}">←</a>
</div>
@endsection

@section('content_sp')

<div class="banner_sp">
    <ul class="restaurant_img_sp">
        @if (!empty($restaurant->main_img))
        <li><img src="../../restaurant/{{ $restaurant->id }}/{{ $restaurant->main_img }}" class="banner_img" alt=""></li>
        @endif
        @if (!empty($restaurant->sub_img1))
        <li><img src="../../restaurant/{{ $restaurant->id }}/{{ $restaurant->sub_img1 }}" class="banner_img" alt=""></li>
        @endif
        @if (!empty($restaurant->sub_img2))
        <li><img src="../../restaurant/{{ $restaurant->id }}/{{ $restaurant->sub_img2 }}" class="banner_img" alt=""></li>
        @endif
        @if (!empty($restaurant->sub_img3))
        <li><img src="../../restaurant/{{ $restaurant->id }}/{{ $restaurant->sub_img3 }}" class="banner_img" alt=""></li>
        @endif
        @if (!empty($restaurant->sub_img4))
        <li><img src="../../restaurant/{{ $restaurant->id }}/{{ $restaurant->sub_img4 }}" class="banner_img" alt=""></li>
        @endif
    </ul>
</div>

<div class="comment_list" id="comment_list">
    <div class="comment_list_header">
        <p class="comment_list_title">コメント一覧</p>
        <div class="button_comment">
            <a href="{{ route('restaurant.comment_form_sp', ['id' => $restaurant_id]) }}">コメントを投稿する</a>
        </div>
    </div>
    <div class="number_sp">
        @if ($comments->total() != 0)
        <b>{{ ($comments->currentPage() -1) * $comments->perPage() + 1}}</b> ～ 
        <b>{{ (($comments->currentPage() -1) * $comments->perPage() + 1) + (count($comments) -1) }}</b>件を表示 ／ 
        @endif
        全<b>{{ $comments->total() }}</b>件
        <select class="comment_sort_select" name="sort" id="change_sort_sp">
            <option value="{{ route('restaurant.comment_list_sp', ['id' => $restaurant_id, 'column' => 'created_at', 'sort' => 'desc']) }}"
            @if($column == "created_at" && $sort == "desc") selected @endif>投稿日時（降順）</option>
            <option value="{{ route('restaurant.comment_list_sp', ['id' => $restaurant_id, 'column' => 'created_at', 'sort' => 'asc']) }}"
            @if($column == "created_at" && $sort == "asc") selected @endif>投稿日時（昇順）</option>
            <option value="{{ route('restaurant.comment_list_sp', ['id' => $restaurant_id, 'column' => 'fivestar', 'sort' => 'desc']) }}"
            @if($column == "fivestar" && $sort == "desc") selected @endif>評価（降順）</option>
            <option value="{{ route('restaurant.comment_list_sp', ['id' => $restaurant_id, 'column' => 'fivestar', 'sort' => 'asc']) }}"
            @if($column == "fivestar" && $sort == "asc") selected @endif>評価（昇順）</option>
        </select>
    </div>
    <div>
        @foreach ($comments as $comment)
        <div class="comment_list_content_sp">
            <div class="comment_name_sp"><b>{{ $comment->user_name }}</b>さんの口コミ</div>
            <div class="comment_datetime_sp">{{ $comment->created_at }}</div>
            <br>
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
            <a href="../../uploads/{{ $comment->filename }}" data-lightbox="group{{ $comment->id }}sp">
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
selected = document.getElementById("change_sort_sp");
selected.onchange = function() {
    window.location.href = selected.value;
};
</script>
@endsection
