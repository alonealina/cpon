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
        <hr>
    </div>
    <div>
        @foreach ($comments as $comment)
        <div class="comment_list_content">
            {{ $comment->user_name }}さんの口コミ<br>
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
            {{ $comment->fivestar }}
            </div>
            <div class="comment_content"><b>{{ $comment->comment }}</b></div>
            @if (!empty($comment->filename))
            <a href="../../uploads/{{ $comment->filename }}" data-lightbox="group{{ $comment->id }}">
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