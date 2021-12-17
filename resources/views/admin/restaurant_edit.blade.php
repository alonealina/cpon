@extends('layouts.app')

@section('content')
<div class="comment_form">
    <form id="form" name="regist_form" action="{{ route('admin.restaurant_update') }}" method="post" enctype="multipart/form-data">
        @csrf
        {{ Form::hidden('restaurant_id', $restaurant->id) }}
        <div class="comment_form_title">店舗の編集</div>

        <div class="regist_form_item">
            <div class="user_name_title">店舗名1<p class="required_mark">必須</p></div>
            @if($errors->has('name1'))
            <div class="comment_error">{{ $errors->first('name1') }}</div>
            @endif
            {{ Form::text('name1', old('name1', $restaurant->name1), ['class' => 'name1_input', 'maxlength' => 20]) }}
        </div>

        <div class="regist_form_item">
            <div class="user_name_title">店舗名2</div>
            @if($errors->has('name2'))
            <div class="comment_error">{{ $errors->first('name2') }}</div>
            @endif
            {{ Form::text('name2', old('name2', $restaurant->name2), ['class' => 'name2_input', 'maxlength' => 20]) }}
        </div>

        <div class="regist_form_item">
            <div class="user_name_title">店舗名3</div>
            @if($errors->has('name3'))
            <div class="comment_error">{{ $errors->first('name3') }}</div>
            @endif
            {{ Form::text('name3', old('name3', $restaurant->name3), ['class' => 'name3_input', 'maxlength' => 20]) }}
        </div>

        <div class="regist_form_item">
            <div class="user_name_title">プロフィール<p class="required_mark">必須</p></div>
            @if($errors->has('profile'))
            <div class="comment_error">{{ $errors->first('profile') }}</div>
            @endif
            {{ Form::textarea('profile', old('profile', $restaurant->profile), ['class' => 'form-control profile_input', 'rows' => 6]) }}
        </div>

        <div class="regist_form_item">
            <div class="user_name_title">都道府県<p class="required_mark">必須</p></div>
            <div id="pref_list_admin">
                <select name="pref">
                @foreach (config('const.Prefs') as $name)
                <option value="{{ $name }}"
                @if($name == $restaurant->pref) selected @endif >{{ $name }}</option>
                @endforeach
                </select>
            </div>
        </div>

        <div class="regist_form_item">
            <div class="user_name_title">郵便番号<p class="required_mark">必須</p></div>
            @if($errors->has('zip'))
            <div class="comment_error">{{ $errors->first('zip') }}</div>
            @endif
            〒{{ Form::text('zip', old('zip', $restaurant->zip), ['class' => 'zip_input', 'maxlength' => 8, 'placeholder' => '000-0000',
                'onkeyup' => "AjaxZip3.zip2addr(this, '', 'address', 'address')"]) }}
        </div>

        <div class="regist_form_item">
            <div class="user_name_title">住所<p class="required_mark">必須</p></div>
            @if($errors->has('address'))
            <div class="comment_error">{{ $errors->first('address') }}</div>
            @endif
            {{ Form::text('address', old('address', $restaurant->address), ['class' => 'address_input']) }}
        </div>

        <div class="regist_form_item">
            <div class="user_name_title">備考（住所）</div>
            @if($errors->has('address_remarks'))
            <div class="comment_error">{{ $errors->first('address_remarks') }}</div>
            @endif
            {{ Form::text('address_remarks', old('address_remarks', $restaurant->address_remarks), ['class' => 'address_remarks_input']) }}
        </div>

        <div class="regist_form_item">
            <div class="user_name_title">営業時間<p class="required_mark">必須</p></div>
            @if($errors->has('time'))
            <div class="comment_error">{{ $errors->first('time') }}</div>
            @endif
            <select name="open_time">
                @foreach (config('const.Times') as $name)
                @if ($name != '指定なし')
                <option value="{{ $name }}"
                @if($name == $restaurant->open_hm) selected @endif >{{ $name }}</option>
                @endif
                @endforeach
            </select>
            ～
            <select name="close_time">
                @foreach (config('const.Times') as $name)
                @if ($name != '指定なし')
                <option value="{{ $name }}"
                @if($name == $restaurant->close_hm) selected @endif >{{ $name }}</option>
                @endif
                @endforeach
            </select>
        </div>

        <div class="regist_form_item">
            <div class="user_name_title">備考（営業時間）</div>
            @if($errors->has('time_remarks'))
            <div class="comment_error">{{ $errors->first('time_remarks') }}</div>
            @endif
            {{ Form::text('time_remarks', old('time_remarks', $restaurant->time_remarks), ['class' => 'time_remarks_input']) }}
        </div>

        <div class="regist_form_item">
            <div class="user_name_title">カテゴリー<p class="required_mark">必須</p></div>
            <select name="category_id">
            @foreach ($categories as $category)
            <option value="{{ $category->id }}"
            @if($category->id == $restaurant->category_id) selected @endif >{{ $category->name }}</option>
            @endforeach
            </select>
        </div>

        <div class="regist_form_item">
            <div class="user_name_title">URL</div>
            @if($errors->has('url'))
            <div class="comment_error">{{ $errors->first('url') }}</div>
            @endif
            {{ Form::text('url', old('url', $restaurant->url), ['class' => 'url_input']) }}
        </div>

        <div class="regist_form_item">
            <div class="user_name_title">TEL</div>
            @if($errors->has('tel'))
            <div class="comment_error">{{ $errors->first('tel') }}</div>
            @endif
            {{ Form::text('tel', old('tel', $restaurant->tel), ['class' => 'tel_input', 'maxlength' => 20, 'placeholder' => '00-0000-0000']) }}
        </div>

        <div class="regist_form_item">
            <div class="user_name_title">備考（お問合せ）</div>
            @if($errors->has('inquiry_remarks'))
            <div class="comment_error">{{ $errors->first('inquiry_remarks') }}</div>
            @endif
            {{ Form::text('inquiry_remarks', old('inquiry_remarks', $restaurant->inquiry_remarks), ['class' => 'inquiry_remarks_input']) }}
        </div>

        <div class="regist_form_item">
            <div class="user_name_title">オプション</div>
            <input type="checkbox" class="check_box" id="recommend_flg" name="recommend_flg"
            @if($restaurant->recommend_flg) checked @endif />
            <label class="label" for="recommend_flg">おすすめ</label>
            <input type="checkbox" class="check_box" id="new_flg" name="new_flg"
            @if($restaurant->new_flg) checked @endif />
            <label class="label" for="new_flg">新着店舗</label>
        </div>

        <div class="regist_form_item">
            <div class="user_name_title">利用シーン</div>
            @include('form.scenes_edit')
        </div>

        <div class="regist_form_item">
            <div class="user_name_title">こだわり条件</div>
            @include('form.commitments_edit')
        </div>

        <div class="regist_form_item">
            <div class="user_name_title">メイン画像<p class="required_mark">必須</p></div>
            @if (!empty($restaurant->main_img))
            <img src="../../../restaurant/{{ $restaurant->id }}/{{ $restaurant->main_img }}" class="edit_thumb_img">
            @endif
            @if($errors->has('main_img'))
            <div class="comment_error">{{ $errors->first('main_img') }}</div>
            @endif
            <div class="regist_file_button"><input type="file" name="main_img"></div>
        </div>

        <div class="regist_form_item">
            <div class="user_name_title">サブ画像1</div>
            @if (!empty($restaurant->sub_img1))
            <img src="../../../restaurant/{{ $restaurant->id }}/{{ $restaurant->sub_img1 }}" class="edit_thumb_img">
            @endif
            @if($errors->has('sub_img1'))
            <div class="comment_error">{{ $errors->first('sub_img1') }}</div>
            @endif
            <div class="regist_file_button"><input type="file" name="sub_img1"></div>
        </div>

        <div class="regist_form_item">
            <div class="user_name_title">サブ画像2</div>
            @if (!empty($restaurant->sub_img2))
            <img src="../../../restaurant/{{ $restaurant->id }}/{{ $restaurant->sub_img2 }}" class="edit_thumb_img">
            @endif
            @if($errors->has('sub_img2'))
            <div class="comment_error">{{ $errors->first('sub_img2') }}</div>
            @endif
            <div class="regist_file_button"><input type="file" name="sub_img2"></div>
        </div>

        <div class="regist_form_item">
            <div class="user_name_title">サブ画像3</div>
            @if (!empty($restaurant->sub_img3))
            <img src="../../../restaurant/{{ $restaurant->id }}/{{ $restaurant->sub_img3 }}" class="edit_thumb_img">
            @endif
            @if($errors->has('sub_img3'))
            <div class="comment_error">{{ $errors->first('sub_img3') }}</div>
            @endif
            <div class="regist_file_button"><input type="file" name="sub_img3"></div>
        </div>

        <div class="regist_form_item">
            <div class="user_name_title">サブ画像4</div>
            @if (!empty($restaurant->sub_img4))
            <img src="../../../restaurant/{{ $restaurant->id }}/{{ $restaurant->sub_img4 }}" class="edit_thumb_img">
            @endif
            @if($errors->has('sub_img4'))
            <div class="comment_error">{{ $errors->first('sub_img4') }}</div>
            @endif
            <div class="regist_file_button"><input type="file" name="sub_img4"></div>
        </div>


        <div class="button_black">
            <a href="#" onclick="clickRegistButton()">確認画面へ<div class="yazi3"><img src="{{ asset('img/yazi3.png') }}" alt=""></div></a>
        </div>
    </form>
    <script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
</div>

@endsection


@section('content_ipad')

@endsection




@section('back_button')
<div class="back_button">
    <a href="{{ route('index') }}">←</a>
</div>
@endsection

@section('content_sp')


@endsection