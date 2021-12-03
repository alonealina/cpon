@extends('restaurant.show')

@section('comment_form')

<div class="comment_form">
    <form id="form" name="comment_form" action="{{ route('restaurant.comment_store') }}" method="post">
        @csrf
        {{ Form::hidden('restaurant_id', $restaurant_id) }}
        <div class="comment_form_title">コメントの投稿</div>
        <div class="fivestar_title">注文の評価</div>
        <div class="rate-form">
            <input id="star5" type="radio" name="fivestar" value="5">
            <label for="star5">★</label>
            <input id="star4" type="radio" name="fivestar" value="4">
            <label for="star4">★</label>
            <input id="star3" type="radio" name="fivestar" value="3">
            <label for="star3">★</label>
            <input id="star2" type="radio" name="fivestar" value="2">
            <label for="star2">★</label>
            <input id="star1" type="radio" name="fivestar" value="1">
            <label for="star1">★</label>
        </div>
        <div class="comment_create_title">コメント記載</div>
        {{ Form::textarea('comment', null, ['class' => 'form-control', 'rows' => 6]) }}
        <div class="button_black">
            <a href="#" onclick="clickCommentButton()">コメントを投稿する</a>
        </div>
    </form>
</div>




@if(Session::has('flashmessage'))

<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script>
window.onload = function () {
    $('#overlay, .modal-window').fadeIn();
  $('.js-close').click(function () {
    window.location.href = '/';
  });
};
</script>

@endif

<div id="overlay" class="overlay"></div>
<!-- モーダルウィンドウ -->
<div class="modal-window">
<div class="modal-text">コメントの投稿が完了しました</div>
<button class="js-close button-close">TOPへ戻る</button>
</div>

@endsection