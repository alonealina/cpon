@extends('restaurant.show')

@section('comment_form')

<div class="comment_form">
    <form id="form" name="comment_form" action="{{ route('restaurant.comment_store') }}" method="post" enctype="multipart/form-data">
        @csrf
        {{ Form::hidden('restaurant_id', $restaurant_id) }}
        <div class="comment_form_title">コメントの投稿</div>

        <div class="user_name_form">
            <div class="user_name_title">お名前</div>
            @if($errors->has('user_name'))
            <div class="comment_error">{{ $errors->first('user_name') }}</div>
            @endif
            {{ Form::text('user_name', old('user_name'), ['class' => 'user_name_input', 'maxlength' => 20]) }}
        </div>

        @if($errors->has('fivestar'))
        <div class="comment_error_fivestar">{{ $errors->first('fivestar') }}</div>
        @endif
        <div class="fivestar_title">注文の評価</div>
        <div class="rate-form rate-form_pc">
            <input id="star5" type="radio" name="fivestar" value="5" {{ old('fivestar') == 5 ? 'checked' : '' }}>
            <label for="star5">★</label>
            <input id="star4" type="radio" name="fivestar" value="4" {{ old('fivestar') == 4 ? 'checked' : '' }}>
            <label for="star4">★</label>
            <input id="star3" type="radio" name="fivestar" value="3" {{ old('fivestar') == 3 ? 'checked' : '' }}>
            <label for="star3">★</label>
            <input id="star2" type="radio" name="fivestar" value="2" {{ old('fivestar') == 2 ? 'checked' : '' }}>
            <label for="star2">★</label>
            <input id="star1" type="radio" name="fivestar" value="1" {{ old('fivestar') == 1 ? 'checked' : '' }}>
            <label for="star1">★</label>
        </div>
        <div class="comment_create_title">コメント記載</div>
        @if($errors->has('comment'))
            <div class="comment_error">{{ $errors->first('comment') }}</div>
        @endif
        {{ Form::textarea('comment', old('comment'), ['class' => 'form-control comment_input', 'rows' => 6]) }}
        @if($errors->has('comment_img'))
            <div class="comment_error">{{ $errors->first('comment_img') }}</div>
        @endif
        <div class="file_button"><input type="file" name="comment_img"></div>
        <div class="button_black">
            <a href="#" onclick="clickCommentButton()">コメントを投稿する<div class="yazi3"><img src="{{ asset('img/yazi3.png') }}" alt=""></div></a>
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


@section('comment_form_ipad')

<div class="comment_form">
    <form id="form" name="comment_form_ipad" action="{{ route('restaurant.comment_store') }}" method="post" enctype="multipart/form-data">
        @csrf
        {{ Form::hidden('restaurant_id', $restaurant_id) }}
        <div class="comment_form_title">コメントの投稿</div>

        <div class="user_name_form">
            <div class="user_name_title">お名前</div>
            @if($errors->has('user_name'))
            <div class="comment_error">{{ $errors->first('user_name') }}</div>
            @endif
            {{ Form::text('user_name', old('user_name'), ['class' => 'user_name_input', 'maxlength' => 20]) }}
        </div>

        @if($errors->has('fivestar'))
        <div class="comment_error_fivestar">{{ $errors->first('fivestar') }}</div>
        @endif
        <div class="fivestar_title">注文の評価</div>
        <div class="rate-form rate-form_ipad">
            <input id="star5_ipad" type="radio" name="fivestar" value="5" {{ old('fivestar') == 5 ? 'checked' : '' }}>
            <label for="star5_ipad">★</label>
            <input id="star4_ipad" type="radio" name="fivestar" value="4" {{ old('fivestar') == 4 ? 'checked' : '' }}>
            <label for="star4_ipad">★</label>
            <input id="star3_ipad" type="radio" name="fivestar" value="3" {{ old('fivestar') == 3 ? 'checked' : '' }}>
            <label for="star3_ipad">★</label>
            <input id="star2_ipad" type="radio" name="fivestar" value="2" {{ old('fivestar') == 2 ? 'checked' : '' }}>
            <label for="star2_ipad">★</label>
            <input id="star1_ipad" type="radio" name="fivestar" value="1" {{ old('fivestar') == 1 ? 'checked' : '' }}>
            <label for="star1_ipad">★</label>
        </div>
        <div class="comment_create_title">コメント記載</div>
        @if($errors->has('comment'))
            <div class="comment_error">{{ $errors->first('comment') }}</div>
        @endif
        {{ Form::textarea('comment', old('comment'), ['class' => 'form-control comment_input', 'rows' => 6]) }}
        @if($errors->has('comment_img'))
            <div class="comment_error">{{ $errors->first('comment_img') }}</div>
        @endif
        <div class="file_button"><input type="file" name="comment_img"></div>
        <div class="button_black">
            <a href="#" onclick="clickCommentButtonIpad()">コメントを投稿する<div class="yazi3"><img src="{{ asset('img/yazi3.png') }}" alt=""></div></a>
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



