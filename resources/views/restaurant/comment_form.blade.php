@extends('layouts.app')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

@section('content')
<br>
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
        <a href="{{ $restaurant->cpon_mall_url }}" target="_blank">Cポンモール出店中</a>
    </div>
    @endif
</div>

<div class="comment_form">
    <form id="form" name="comment_form" action="{{ route('restaurant.comment_store') }}" method="post" enctype="multipart/form-data">
        @csrf
        {{ Form::hidden('restaurant_id', $restaurant_id) }}
        {{ Form::hidden('sp_flg', false) }}
        <div class="comment_form_title">クチコミの投稿</div>

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
        <div class="comment_create_title">クチコミ記載</div>
        @if($errors->has('comment'))
            <div class="comment_error">{{ $errors->first('comment') }}</div>
        @endif
        {{ Form::textarea('comment', old('comment'), ['class' => 'form-control comment_input', 'rows' => 6]) }}
        @if($errors->has('comment_img.*'))
            <div class="comment_error">{{ $errors->first('comment_img.*') }}</div>
        @endif
        <div class="comment_create_title">イメージ画像（最大5枚、各1MBまで）</div>
        <div class="file_button"><input type="file" id="file_btn_pc" accept="image/*" name="comment_img[]" onclick="fileCheck();" multiple></div>
        <div class="img_tmb"></div>
        <div class="button_black">
            <a href="#" onclick="clickCommentButton()">クチコミを投稿する</a>
        </div>
        <div class="button_grey">
            <a href="{{ route('restaurant.show', ['id' => $restaurant_id]) }}">店舗ページへ戻る</a>
        </div>
    </form>
</div>

@if(Session::has('flashmessage'))

<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script>
window.onload = function () {
    $('#overlay, .modal-window').fadeIn();
  $('.js-close').click(function () {
    window.location.href = '/restaurants/' + document.comment_form.restaurant_id.value + '/show';
  });
};

</script>

@endif

<div id="overlay" class="overlay"></div>
<!-- モーダルウィンドウ -->
<div class="modal-window">
<div class="modal-text">クチコミの投稿が完了しました</div>
<button class="js-close button-close">店舗ページへ戻る</button>
</div>


@endsection


@section('content_ipad')

@include('form.header_search_ipad')
<div class="body_ipad">
<div class="restaurant_show_ipad">
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
        <a href="{{ $restaurant->cpon_mall_url }}" target="_blank">Cポンモール出店中</a>
    </div>
    @endif
</div>

<div class="comment_form">
    <form id="form" name="comment_form_ipad" action="{{ route('restaurant.comment_store') }}" method="post" enctype="multipart/form-data">
        @csrf
        {{ Form::hidden('restaurant_id', $restaurant_id) }}
        {{ Form::hidden('sp_flg', false) }}
        <div class="comment_form_title">クチコミの投稿</div>

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
        <div class="comment_create_title">クチコミ記載</div>
        @if($errors->has('comment'))
            <div class="comment_error">{{ $errors->first('comment') }}</div>
        @endif
        {{ Form::textarea('comment', old('comment'), ['class' => 'form-control comment_input', 'rows' => 6]) }}
        @if($errors->has('comment_img'))
            <div class="comment_error">{{ $errors->first('comment_img') }}</div>
        @endif
        <div class="comment_create_title">イメージ画像（最大5枚、各1MBまで）</div>
        <div class="file_button"><input type="file" id="file_btn_ipad" accept="image/*" onclick="fileCheckIpad();" name="comment_img[]" multiple></div>
        <div class="img_tmb_ipad"></div>
        <div class="button_black">
            <a href="#" onclick="clickCommentButtonIpad()">クチコミを投稿する</a>
        </div>
        <div class="button_grey">
            <a href="{{ route('restaurant.show', ['id' => $restaurant_id]) }}">店舗ページへ戻る</a>
        </div>
    </form>
</div>

@if(Session::has('flashmessage'))

<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

@endif

<div id="overlay" class="overlay"></div>
<!-- モーダルウィンドウ -->
<div class="modal-window">
<div class="modal-text">クチコミの投稿が完了しました</div>
<button class="js-close button-close">店舗ページへ戻る</button>
</div>

@endsection


@section('back_button')
<div class="back_button">
    <a href="{{ route('index') }}">←</a>
</div>
@endsection

@section('content_sp')


@yield('menu_list_sp')


@endsection
























