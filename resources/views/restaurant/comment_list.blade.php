@extends('layouts.app')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

@section('content')
<div class="restaurant_show">
    <div class="restaurant_category">{{ $category->name }}</div>
    <div class="restaurant_name">{{ $restaurant->name1 }} {{ $restaurant->name2 }} {{ $restaurant->name3 }}</div>
    <div class="scene_commitment">
        @foreach ($restaurant_scenes as $name)
        <label class="label">{{ $name }}</label>
        @endforeach
        @foreach ($restaurant_commitments as $name)
        <label class="label">{{ $name }}</label>
        @endforeach
    </div>
    @if(!empty($restaurant->cpon_mall_url))
    <div class="cpon_mall_url">
        <a href="{{ $restaurant->cpon_mall_url }}">Cポンモール出店中</a>
    </div>
    @endif
</div>

<div class="comment_list" id="comment_list">
    <div class="comment_list_header">
        <p class="comment_list_title">クチコミ一覧</p>
        <div class="button_comment">
            <a href="{{ route('restaurant.comment_form', ['id' => $restaurant_id]) }}">クチコミを投稿する</a>
        </div>
    </div>
    <div class="number">
        @if ($comments->total() != 0)
        <b>{{ ($comments->currentPage() -1) * $comments->perPage() + 1}}</b> ～ 
        <b>{{ (($comments->currentPage() -1) * $comments->perPage() + 1) + (count($comments) -1) }}</b>件を表示 ／ 
        @endif
        全<b>{{ $comments->total() }}</b>件
        <select class="comment_sort_select" name="sort" id="change_sort_pc">
            <option value="{{ route('restaurant.comment_list', ['id' => $restaurant_id, 'column' => 'created_at', 'sort' => 'desc']) }}"
            @if($column == "created_at" && $sort == "desc") selected @endif>投稿日時（降順）</option>
            <option value="{{ route('restaurant.comment_list', ['id' => $restaurant_id, 'column' => 'created_at', 'sort' => 'asc']) }}"
            @if($column == "created_at" && $sort == "asc") selected @endif>投稿日時（昇順）</option>
            <option value="{{ route('restaurant.comment_list', ['id' => $restaurant_id, 'column' => 'fivestar', 'sort' => 'desc']) }}"
            @if($column == "fivestar" && $sort == "desc") selected @endif>評価（降順）</option>
            <option value="{{ route('restaurant.comment_list', ['id' => $restaurant_id, 'column' => 'fivestar', 'sort' => 'asc']) }}"
            @if($column == "fivestar" && $sort == "asc") selected @endif>評価（昇順）</option>
        </select>
    </div>
    <hr>
    <div>
        @foreach ($comments as $comment)
        <div class="comment_list_content">
            <b>{{ $comment->user_name }}</b>さんのクチコミ　<div class="comment_datetime">{{ $comment->created_at }}</div><br>
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
            <b>{{ $comment->fivestar }}.0</b>
            </div>
            <div class="comment_content">{!! nl2br(e($comment->comment)) !!}</div>
            @if (!empty($comment->filename))
            <a href="../../uploads/{{ $comment->filename }}" data-lightbox="group{{ $comment->id }}pc">
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
    <div class="button_black">
        <a href="{{ route('restaurant.show', ['id' => $restaurant_id]) }}">店舗詳細ページへ戻る</a>
    </div>
</div>
<script>
    selected_pc = document.getElementById("change_sort_pc");
    selected_pc.onchange = function() {
    window.location.href = selected_pc.value;
    };
</script>


@endsection


@section('content_ipad')

@include('form.header_search_ipad')
<div class="body_ipad">
<div class="restaurant_show">
    <div class="restaurant_category">{{ $category->name }}</div>
    <div class="restaurant_name">{{ $restaurant->name1 }} {{ $restaurant->name2 }} {{ $restaurant->name3 }}</div>
    <div class="scene_commitment">
        @foreach ($restaurant_scenes as $name)
        <label class="label">{{ $name }}</label>
        @endforeach
        @foreach ($restaurant_commitments as $name)
        <label class="label">{{ $name }}</label>
        @endforeach
    </div>
    @if(!empty($restaurant->cpon_mall_url))
    <div class="cpon_mall_url">
        <a href="{{ $restaurant->cpon_mall_url }}">Cポンモール出店中</a>
    </div>
    @endif
</div>

<div class="comment_list" id="comment_list">
    <div class="comment_list_header">
        <p class="comment_list_title">最新のクチコミ</p>
        <div class="button_comment">
            <a href="{{ route('restaurant.comment_form', ['id' => $restaurant_id]) }}">クチコミを投稿する</a>
        </div>
    </div>
    <div class="number">
        @if ($comments->total() != 0)
        <b>{{ ($comments->currentPage() -1) * $comments->perPage() + 1}}</b> ～ 
        <b>{{ (($comments->currentPage() -1) * $comments->perPage() + 1) + (count($comments) -1) }}</b>件を表示 ／ 
        @endif
        全<b>{{ $comments->total() }}</b>件
        <select class="comment_sort_select" name="sort" id="change_sort_ipad">
            <option value="{{ route('restaurant.comment_list', ['id' => $restaurant_id, 'column' => 'created_at', 'sort' => 'desc']) }}"
            @if($column == "created_at" && $sort == "desc") selected @endif>投稿日時（降順）</option>
            <option value="{{ route('restaurant.comment_list', ['id' => $restaurant_id, 'column' => 'created_at', 'sort' => 'asc']) }}"
            @if($column == "created_at" && $sort == "asc") selected @endif>投稿日時（昇順）</option>
            <option value="{{ route('restaurant.comment_list', ['id' => $restaurant_id, 'column' => 'fivestar', 'sort' => 'desc']) }}"
            @if($column == "fivestar" && $sort == "desc") selected @endif>評価（降順）</option>
            <option value="{{ route('restaurant.comment_list', ['id' => $restaurant_id, 'column' => 'fivestar', 'sort' => 'asc']) }}"
            @if($column == "fivestar" && $sort == "asc") selected @endif>評価（昇順）</option>
        </select>
    </div>
    <hr>
    <div>
        @foreach ($comments as $comment)
        <div class="comment_list_content">
            <b>{{ $comment->user_name }}</b>さんのクチコミ　<div class="comment_datetime">{{ $comment->created_at }}</div><br>
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
            <b>{{ $comment->fivestar }}.0</b>
            </div>
            <div class="comment_content">{!! nl2br(e($comment->comment)) !!}</div>
            @if (!empty($comment->filename))
            <a href="../../uploads/{{ $comment->filename }}" data-lightbox="group{{ $comment->id }}ipad">
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
<script>
    selected_ipad = document.getElementById("change_sort_ipad");
    selected_ipad.onchange = function() {
    window.location.href = selected_ipad.value;
    };
</script>

@endsection


@section('back_button')
<div class="back_button">
    <a href="{{ route('index') }}">←</a>
</div>
@endsection

@section('content_sp')


@yield('menu_list_sp')


@endsection













