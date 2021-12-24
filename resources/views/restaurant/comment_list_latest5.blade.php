<div class="comment_list" id="comment_list">
    <div class="comment_list_header">
        <p class="comment_list_title">最新のクチコミ</p>
        <div class="button_comment">
            <a href="{{ route('restaurant.comment_form', ['id' => $restaurant_id]) }}">クチコミを投稿する</a>
        </div>
    </div>
    <div class="number">
        <b>最新の5件を表示</b>
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
            <div class="comment_box">
                <input type="checkbox" id="pc{{ $comment->id }}" class="comment_checkbox"><label for="pc{{ $comment->id }}" id="" class="comment_label"></label>
                <div class="comment_content">{!! nl2br(e($comment->comment)) !!}</div>
            </div>
            @if (!empty($comment->filename))
            <a href="../../uploads/{{ $comment->filename }}" data-lightbox="group{{ $comment->id }}{{ $version }}">
                <img src="../../uploads/{{ $comment->filename }}" width="100px" height="100px">
            </a>
            @endif
        </div>
        <hr>
        @endforeach
    </div>
    
    @if($comments->total() > 5)
    <div class="button_black">
        <a href="{{ route('restaurant.comment_list', ['id' => $restaurant_id]) }}">クチコミ一覧</a>
    </div>
    @endif

</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script>
let comment_content_list = document.getElementsByClassName('comment_content');
var array = Array.prototype.slice.call(comment_content_list);//配列に変換
array.forEach((comment_content) => {
    let client_h = comment_content.clientHeight;
    if (client_h < 65) {
        comment_content.parentElement.getElementsByClassName("comment_label")[0].style.display ="none";
    } else {
        comment_content.style.overflow = "hidden";
        $clamp(comment_content, {clamp: 3});
    }
});

$('.comment_checkbox').click(function() {
    if (this.checked) {
        this.parentElement.getElementsByClassName('comment_content')[0].style.display = "block";
    } else {
        this.parentElement.getElementsByClassName('comment_content')[0].style.display = "-webkit-box";
    }
});
</script>