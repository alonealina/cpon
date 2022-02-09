@extends('layouts.app')

@section('back_button')
<div class="back_button">
    <a href="{{ route('restaurant.comment_list_sp', ['id' => $restaurant->id]) }}">←</a>
</div>
@endsection

@section('content_sp')

<div class="restaurant_show">
<div style="width:350px;"><div style="float:left;" class="restaurant_category_sp">{{ $category->name }}</div></div><br>
<div style="width:350px;"><div class="restaurant_name_sp2">{{ $restaurant->name1 }} {{ $restaurant->name2 }} {{ $restaurant->name3 }}</div></div>
<div style="width:350px;"><div class="scene_commitment" style="width:350px; text-align:left;">
        @foreach ($restaurant_scenes as $name)
        <label class="label">{{ $name }}</label>
        @endforeach
        @foreach ($restaurant_commitments as $name)
        <label class="label">{{ $name }}</label>
        @endforeach
    </div></div>
    @if(!empty($restaurant->cpon_mall_url))
    <div style="width:350px;text-align:left;"><div class="cpon_mall_url_sp">
        <a href="{{ $restaurant->cpon_mall_url }}" target="_blank">Cポンモール出店中</a>
    </div></div>
    @endif
</div>

<div class="comment_form">
    <form id="form" name="comment_form_sp" action="{{ route('restaurant.comment_store') }}" method="post" enctype="multipart/form-data">
        @csrf
        {{ Form::hidden('restaurant_id', $restaurant_id) }}
        {{ Form::hidden('sp_flg', true) }}
        <div style="text-align:left;"><div class="comment_form_title_sp">クチコミの投稿</div></div>

        <div class="user_name_form_sp">
            <div class="user_name_title_sp">お名前</div>
            @if($errors->has('user_name'))
            <div class="comment_error">{{ $errors->first('user_name') }}</div>
            @endif
            {{ Form::text('user_name', old('user_name'), ['class' => 'user_name_input_sp', 'maxlength' => 20]) }}
        </div>

        @if($errors->has('fivestar'))
        <div class="comment_error_fivestar">{{ $errors->first('fivestar') }}</div>
        @endif
        <div class="fivestar_title_sp">注文の評価</div><br>
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
        <div class="comment_create_title_sp">クチコミ記載</div>
        @if($errors->has('comment'))
            <div class="comment_error">{{ $errors->first('comment') }}</div>
        @endif
        {{ Form::textarea('comment', old('comment'), ['class' => 'form-control comment_input comment_input_sp', 'rows' => 6]) }}
        @if($errors->has('comment_img'))
            <div class="comment_error">{{ $errors->first('comment_img') }}</div>
        @endif
        <div class="comment_create_title_sp">イメージ画像（最大5枚、各1MBまで）</div>
        <div class="file_button"><input type="file" id="file_btn_pc" accept="image/*" name="comment_img[]" onclick="fileCheck();" multiple></div>
        <div class="img_tmb"></div>
        <div class="button_black_sp">
            <a href="#" onclick="clickCommentButtonSp()">クチコミを投稿する</a>
        </div>
    </form>
</div>

@if(Session::has('flashmessage'))

<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script>
window.onload = function () {
    $('#overlay, .modal-window_sp').fadeIn();
  $('.js-close').click(function () {
    window.location.href = '/restaurants/' + document.comment_form_sp.restaurant_id.value + '/show';
  });
};
</script>

@endif

<div id="overlay" class="overlay"></div>
<!-- モーダルウィンドウ -->
<div class="modal-window_sp">
<div class="modal-text_sp">クチコミの投稿が完了しました。</div>
<button class="js-close button-close_sp">店舗ページへ戻る</button>
</div>


@endsection



