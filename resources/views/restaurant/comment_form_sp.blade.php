@extends('layouts.app')

@section('content_sp')

<div class="banner_sp">
    <ul class="restaurant_img_sp">
        @if (!empty($restaurant->main_img))
        <li><img src="../../img/restaurant/71/{{ $restaurant->main_img }}" class="banner_img" alt=""></li>
        @endif
        @if (!empty($restaurant->sub_img1))
        <li><img src="../../img/restaurant/71/{{ $restaurant->sub_img1 }}" class="banner_img" alt=""></li>
        @endif
        @if (!empty($restaurant->sub_img2))
        <li><img src="../../img/restaurant/71/{{ $restaurant->sub_img2 }}" class="banner_img" alt=""></li>
        @endif
        @if (!empty($restaurant->sub_img3))
        <li><img src="../../img/restaurant/71/{{ $restaurant->sub_img3 }}" class="banner_img" alt=""></li>
        @endif
        @if (!empty($restaurant->sub_img4))
        <li><img src="../../img/restaurant/71/{{ $restaurant->sub_img4 }}" class="banner_img" alt=""></li>
        @endif
    </ul>
</div>

<div class="comment_form">
    <form id="form" name="comment_form_sp" action="{{ route('restaurant.comment_store') }}" method="post" enctype="multipart/form-data">
        @csrf
        {{ Form::hidden('restaurant_id', $restaurant_id) }}
        {{ Form::hidden('sp_flg', true) }}
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
        <div class="rate-form rate-form_sp">
            <input id="star5_sp" type="radio" name="fivestar" value="5" {{ old('fivestar') == 5 ? 'checked' : '' }}>
            <label for="star5_sp">★</label>
            <input id="star4_sp" type="radio" name="fivestar" value="4" {{ old('fivestar') == 4 ? 'checked' : '' }}>
            <label for="star4_sp">★</label>
            <input id="star3_sp" type="radio" name="fivestar" value="3" {{ old('fivestar') == 3 ? 'checked' : '' }}>
            <label for="star3_sp">★</label>
            <input id="star2_sp" type="radio" name="fivestar" value="2" {{ old('fivestar') == 2 ? 'checked' : '' }}>
            <label for="star2_sp">★</label>
            <input id="star1_sp" type="radio" name="fivestar" value="1" {{ old('fivestar') == 1 ? 'checked' : '' }}>
            <label for="star1_sp">★</label>
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
        <div class="button_black_sp">
            <a href="#" onclick="clickCommentButtonSp()">コメントを投稿する<div class="yazi3"></div></a>
        </div>
    </form>
</div>

@if(Session::has('flashmessage'))

<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script>
window.onload = function () {
    $('#overlay, .modal-window_sp').fadeIn();
  $('.js-close').click(function () {
    window.location.href = '/';
  });
};
</script>

@endif

<div id="overlay" class="overlay"></div>
<!-- モーダルウィンドウ -->
<div class="modal-window_sp">
<div class="modal-text_sp">コメントの投稿が完了しました。</div>
<button class="js-close button-close_sp">TOPへ戻る</button>
</div>


@endsection



