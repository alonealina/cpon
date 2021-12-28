@extends('layouts.app_admin')

@section('content')
<nav class="navbar admin_header">
    <div class="content_title">店舗情報編集</div>
    @if(session('id') == 'admin')
    <div class="button_red_admin">
        <a href="{{ route('admin.restaurant_list') }}">店舗管理ページ</a>
    </div>
    @endif
</nav>

<div class="comment_form">
    <form id="form" class="restaurant_regist_form" name="regist_form" action="{{ route('admin.restaurant_update') }}" method="post" enctype="multipart/form-data">
        @csrf
        {{ Form::hidden('restaurant_id', $restaurant->id) }}
        <div class="flex_form_item">
            <div class="">
                @if($errors->has('login_id'))
                <div class="comment_error">{{ $errors->first('login_id') }}</div>
                @endif
                <div class="admin_form_name">店舗ID
                    @if(session('id') == 'admin')
                        <p class="required_mark">※必須</p>
                    @else
                        <p class="required_mark">※変更不可</p>
                    @endif
                </div>
                {{ Form::text('login_id', old('login_id', $restaurant->login_id), ['class' => 'login_id_input', 'maxlength' => 10, 
                    session('id') != 'admin' ? 'disabled' : '']) }}
            </div>

            <div class="flex_form_password">
                @if($errors->has('password'))
                <div class="comment_error">{{ $errors->first('password') }}</div>
                @endif
                <div class="admin_form_name">パスワード<p class="required_mark">※必須</p></div>
                {{ Form::text('password', old('password', $restaurant->password), ['class' => 'password_input', 'maxlength' => 12]) }}
            </div>
        </div>

        <div class="admin_form_outline">
            <div class="admin_form_title">店舗基本情報</div>

            <div class="regist_form_item">
                <div class="admin_form_name">メイン画像<p class="required_mark">※必須</p></div>
                @if($errors->has('main_img'))
                <div class="comment_error">{{ $errors->first('main_img') }}</div>
                @endif
                <div class="regist_file_button"><input type="file" id="file_btn_main" accept="image/*" onclick="fileCheckMain();" name="main_img"></div>
                <div class="img_tmb_main">
                    @if (!empty($restaurant->main_img))
                    <img src="../../../restaurant/{{ $restaurant->id }}/{{ $restaurant->main_img }}">
                    @endif
                </div>
            </div>

            <div class="regist_form_item">
                <div class="admin_form_name">サブ画像（8枚まで）</div>
                @if($errors->has('sub_img1'))
                <div class="comment_error">{{ $errors->first('sub_img1') }}</div>
                @endif
                <div class="regist_file_button"><input type="file" id="file_btn_sub" accept="image/*" onclick="fileCheckSub();" name="sub_img[]" multiple></div>
                <div class="img_tmb_sub">
                    @if (!empty($restaurant->sub_img1))
                    <img src="../../../restaurant/{{ $restaurant->id }}/{{ $restaurant->sub_img1 }}">
                    @endif
                    @if (!empty($restaurant->sub_img2))
                    <img src="../../../restaurant/{{ $restaurant->id }}/{{ $restaurant->sub_img2 }}">
                    @endif
                    @if (!empty($restaurant->sub_img3))
                    <img src="../../../restaurant/{{ $restaurant->id }}/{{ $restaurant->sub_img3 }}">
                    @endif
                    @if (!empty($restaurant->sub_img4))
                    <img src="../../../restaurant/{{ $restaurant->id }}/{{ $restaurant->sub_img4 }}">
                    @endif
                    @if (!empty($restaurant->sub_img5))
                    <img src="../../../restaurant/{{ $restaurant->id }}/{{ $restaurant->sub_img5 }}">
                    @endif
                    @if (!empty($restaurant->sub_img6))
                    <img src="../../../restaurant/{{ $restaurant->id }}/{{ $restaurant->sub_img6 }}">
                    @endif
                    @if (!empty($restaurant->sub_img7))
                    <img src="../../../restaurant/{{ $restaurant->id }}/{{ $restaurant->sub_img7 }}">
                    @endif
                    @if (!empty($restaurant->sub_img8))
                    <img src="../../../restaurant/{{ $restaurant->id }}/{{ $restaurant->sub_img8 }}">
                    @endif
                </div>
            </div>

            <div class="admin_form_name">店舗名</div>
            <div class="flex_form_item">
                <div class="regist_form_item">
                    <div class="admin_form_sub">飾り文字（前）20文字以内</div>
                    @if($errors->has('name1'))
                    <div class="comment_error">{{ $errors->first('name1') }}</div>
                    @endif
                    {{ Form::text('name1', old('name1', $restaurant->name1), ['class' => 'name1_input', 'maxlength' => 20]) }}
                </div>

                <div class="regist_form_item admin_form_name2">
                    <div class="admin_form_sub">店舗名<p class="required_mark">※必須</p>30文字以内</div>
                    @if($errors->has('name2'))
                    <div class="comment_error">{{ $errors->first('name2') }}</div>
                    @endif
                    {{ Form::text('name2', old('name2', $restaurant->name2), ['class' => 'name2_input', 'maxlength' => 20]) }}
                </div>

                <div class="regist_form_item">
                    <div class="admin_form_sub">飾り文字（後）20文字以内</div>
                    @if($errors->has('name3'))
                    <div class="comment_error">{{ $errors->first('name3') }}</div>
                    @endif
                    {{ Form::text('name3', old('name3', $restaurant->name3), ['class' => 'name3_input', 'maxlength' => 20]) }}
                </div>
            </div>

            <div class="regist_form_item">
                <div class="admin_form_name">店舗紹介文（3,000文字以内）<p class="required_mark">※必須</p></div>
                @if($errors->has('profile'))
                <div class="comment_error">{{ $errors->first('profile') }}</div>
                @endif
                {{ Form::textarea('profile', old('profile', $restaurant->profile), ['class' => 'form-control profile_input', 'rows' => 6, 'maxlength' => 3000]) }}
            </div>

            <div class="admin_form_name">所在地<p class="required_mark">※必須</p></div>
            <div class="flex_form_item">
                <div class="regist_form_item">
                    <div class="admin_form_sub">郵便番号</div>
                    @if($errors->has('zip'))
                    <div class="comment_error">{{ $errors->first('zip') }}</div>
                    @endif
                    {{ Form::text('zip', old('zip', $restaurant->zip), ['class' => 'zip_input', 'maxlength' => 8, 'placeholder' => '000-0000',
                        'onkeyup' => "AjaxZip3.zip2addr(this, '', 'pref', 'address')"]) }}
                </div>

                <div class="regist_form_item admin_form_pref">
                    <div class="admin_form_sub">都道府県</div>
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
                    <div class="admin_form_sub">市区町村</div>
                    @if($errors->has('address'))
                    <div class="comment_error">{{ $errors->first('address') }}</div>
                    @endif
                    {{ Form::text('address', old('address', $restaurant->address), ['class' => 'address_input', 'maxlength' => 50]) }}
                </div>
            </div>

            <div class="regist_form_item">
                <div class="admin_form_sub">以降の住所</div>
                @if($errors->has('address_remarks'))
                <div class="comment_error">{{ $errors->first('address_remarks') }}</div>
                @endif
                {{ Form::text('address_remarks', old('address_remarks', $restaurant->address_remarks), ['class' => 'address_remarks_input', 'maxlength' => 100]) }}
            </div>

            <div class="regist_form_item">
                <div class="admin_form_name">基本営業時間<p class="required_mark">※必須</p></div>
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
                @if($errors->has('holidays'))
                <div class="comment_error">{{ $errors->first('holidays') }}</div>
                @endif
                <div class="admin_form_name">定休日（複数選択可）<p class="required_mark">※必須</p></div>
                @include('form.holidays_edit')
            </div>

            <div class="regist_form_item">
                <div class="admin_form_name">営業時間備考欄（200文字以内）</div>
                @if($errors->has('time_remarks'))
                <div class="comment_error">{{ $errors->first('time_remarks') }}</div>
                @endif
                {{ Form::textarea('time_remarks', old('time_remarks', $restaurant->time_remarks), ['class' => 'time_remarks_input', 'rows' => 3, 'maxlength' => 200]) }}
            </div>

            <div class="regist_form_item">
                <div class="admin_form_name">電話番号<p class="required_mark">※必須</p></div>
                @if($errors->has('tel'))
                <div class="comment_error">{{ $errors->first('tel') }}</div>
                @endif
                {{ Form::text('tel', old('tel', $restaurant->tel), ['class' => 'tel_input', 'maxlength' => 20, 'placeholder' => '00-0000-0000']) }}
            </div>

            <div class="admin_form_name">予算<p class="required_mark">※必須</p></div>
                <div class="flex_form_item">
                    <div class="regist_form_item">
                        <div class="admin_form_sub">昼</div>
                        <select name="budget_lunch">
                            @foreach (config('const.BudgetLunch') as $key => $value)
                            <option value="{{ $key }}"
                            @if($value == $restaurant->budget_lunch) selected @endif >{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="regist_form_item admin_form_budget">
                        <div class="admin_form_sub">夜</div>
                        <select name="budget_dinner">
                            @foreach (config('const.BudgetDinner') as $key => $value)
                            <option value="{{ $key }}"
                            @if($value == $restaurant->budget_dinner) selected @endif >{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

            <div class="regist_form_item">
                <div class="admin_form_name">WEBページ</div>
                @if($errors->has('url'))
                <div class="comment_error">{{ $errors->first('url') }}</div>
                @endif
                {{ Form::text('url', old('url', $restaurant->url), ['class' => 'url_input', 'maxlength' => 255]) }}
            </div>
        </div>

        <div class="admin_form_outline">
            <div class="admin_form_title">アクセス情報</div>
            <div class="regist_form_item">
                <div class="admin_form_name">最寄り駅（最大5つ）</div>
                @if($errors->has('station1'))
                <div class="comment_error">{{ $errors->first('station1') }}</div>
                @endif
                <div class="flex_form_item flex_station">
                    <div class="regist_form_item">
                        <div class="admin_form_sub">駅名</div>{{ Form::text('station1', old('station1', $restaurant->station1), ['class' => 'station_input', 'maxlength' => 30]) }}
                    </div>
                    <div class="regist_form_item admin_form_route">
                        <div class="admin_form_sub">路線</div>{{ Form::text('route1', old('route1', $restaurant->route1), ['class' => 'route_input', 'maxlength' => 30]) }}
                    </div>
                </div>

                @if($errors->has('station2'))
                <div class="comment_error">{{ $errors->first('station1') }}</div>
                @endif
                <div class="flex_form_item flex_station">
                    <div class="regist_form_item">
                        <div class="admin_form_sub">駅名</div>{{ Form::text('station2', old('station2', $restaurant->station2), ['class' => 'station_input', 'maxlength' => 30]) }}
                    </div>
                    <div class="regist_form_item admin_form_route">
                        <div class="admin_form_sub">路線</div>{{ Form::text('route2', old('route2', $restaurant->route2), ['class' => 'route_input', 'maxlength' => 30]) }}
                    </div>
                </div>

                @if($errors->has('station3'))
                <div class="comment_error">{{ $errors->first('station1') }}</div>
                @endif
                <div class="flex_form_item flex_station">
                    <div class="regist_form_item">
                        <div class="admin_form_sub">駅名</div>{{ Form::text('station3', old('station3', $restaurant->station3), ['class' => 'station_input', 'maxlength' => 30]) }}
                    </div>
                    <div class="regist_form_item admin_form_route">
                        <div class="admin_form_sub">路線</div>{{ Form::text('route3', old('route3', $restaurant->route3), ['class' => 'route_input', 'maxlength' => 30]) }}
                    </div>
                </div>

                @if($errors->has('station4'))
                <div class="comment_error">{{ $errors->first('station1') }}</div>
                @endif
                <div class="flex_form_item flex_station">
                    <div class="regist_form_item">
                        <div class="admin_form_sub">駅名</div>{{ Form::text('station4', old('station4', $restaurant->station4), ['class' => 'station_input', 'maxlength' => 30]) }}
                    </div>
                    <div class="regist_form_item admin_form_route">
                        <div class="admin_form_sub">路線</div>{{ Form::text('route4', old('route4', $restaurant->route4), ['class' => 'route_input', 'maxlength' => 30]) }}
                    </div>
                </div>

                @if($errors->has('station5'))
                <div class="comment_error">{{ $errors->first('station1') }}</div>
                @endif
                <div class="flex_form_item flex_station">
                    <div class="regist_form_item">
                        <div class="admin_form_sub">駅名</div>{{ Form::text('station5', old('station5', $restaurant->station5), ['class' => 'station_input', 'maxlength' => 30]) }}
                    </div>
                    <div class="regist_form_item admin_form_route">
                        <div class="admin_form_sub">路線</div>{{ Form::text('route5', old('route5', $restaurant->route5), ['class' => 'route_input', 'maxlength' => 30]) }}
                    </div>
                </div>
            </div>

            <div class="regist_form_item">
                <div class="admin_form_name">アクセス（200文字以内）</div>
                @if($errors->has('access'))
                <div class="comment_error">{{ $errors->first('access') }}</div>
                @endif
                {{ Form::textarea('access', old('access', $restaurant->access), ['class' => 'access_input', 'rows' => 3, 'maxlength' => 200]) }}
            </div>

            <div class="regist_form_item">
                <div class="admin_form_name">駐車場（200文字以内）</div>
                @if($errors->has('parking'))
                <div class="comment_error">{{ $errors->first('parking') }}</div>
                @endif
                {{ Form::textarea('parking', old('parking', $restaurant->parking), ['class' => 'parking_input', 'rows' => 3, 'maxlength' => 200]) }}
            </div>
        </div>

        <div class="admin_form_outline">
            <div class="admin_form_title">支払い方法</div>

            <div class="regist_form_item">
                <div class="admin_form_name">クレジットカード</div>
                @include('form.cards_edit')
            </div>

            <div class="regist_form_item">
                <div class="admin_form_name">電子マネー・その他（200文字以内）</div>
                @if($errors->has('e_money'))
                <div class="comment_error">{{ $errors->first('e_money') }}</div>
                @endif
                {{ Form::textarea('e_money', old('e_money', $restaurant->e_money), ['class' => 'e_money_input', 'rows' => 3, 'maxlength' => 200]) }}
            </div>

            <p class="required_mark">※「Cポン支払可能」と言う文言は常時表示</p>
        </div>


        <div class="admin_form_outline">
            <div class="admin_form_title">設備・その他の情報</div>

            <div class="regist_form_item">
                <div class="admin_form_name">席数（200文字以内）</div>
                @if($errors->has('seats'))
                <div class="comment_error">{{ $errors->first('seats') }}</div>
                @endif
                {{ Form::textarea('seats', old('seats', $restaurant->seats), ['class' => 'seats_input', 'rows' => 3, 'maxlength' => 200]) }}
            </div>

            <div class="regist_form_item">
                <div class="admin_form_name">禁煙・喫煙（200文字以内）</div>
                @if($errors->has('smoking'))
                <div class="comment_error">{{ $errors->first('smoking') }}</div>
                @endif
                {{ Form::textarea('smoking', old('smoking', $restaurant->smoking), ['class' => 'smoking_input', 'rows' => 3, 'maxlength' => 200]) }}
            </div>

            <div class="regist_form_item">
                <div class="admin_form_name">Cポンモールへ出店されている場合は店舗詳細ページURLを記載して下さい。</div>
                @if($errors->has('cpon_mall_url'))
                <div class="comment_error">{{ $errors->first('cpon_mall_url') }}</div>
                @endif
                {{ Form::text('cpon_mall_url', old('cpon_mall_url', $restaurant->cpon_mall_url), ['class' => 'cpon_mall_url_input', 'maxlength' => 255]) }}
            </div>

            <div class="regist_form_item">
                <div class="admin_form_name">その他（500文字以内）</div>
                @if($errors->has('other'))
                <div class="comment_error">{{ $errors->first('other') }}</div>
                @endif
                {{ Form::textarea('other', old('other', $restaurant->other), ['class' => 'other_input', 'rows' => 6, 'maxlength' => 500]) }}
            </div>
        </div>

        <div class="admin_form_outline">
            <div class="admin_form_title">検索情報関連</div>

            <div class="regist_form_item">
                <div class="admin_form_name">カテゴリ<p class="required_mark">※必須</p></div>
                <select name="category_id">
                @foreach ($categories as $category)
                <option value="{{ $category->id }}"
                @if($category->id == $restaurant->category_id) selected @endif >{{ $category->name }}</option>
                @endforeach
                </select>
            </div>

            <div class="regist_form_item">
                <div class="admin_form_name">利用シーン</div>
                @include('form.scenes_edit')
            </div>

            <div class="regist_form_item">
                <div class="admin_form_name">こだわり条件</div>
                @include('form.commitments_edit')
            </div>
        </div>

        <div class="button_black">
            <a href="#" onclick="clickRegistButton()">店舗情報を更新する</a>
        </div>
    </form>
    <script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
</div>

@endsection
