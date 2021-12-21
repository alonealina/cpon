
<form id="form" name="filter_form" action="{{ route('admin.restaurant_list') }}" method="get">
    <div class="filter_flex">
        <div class="filter_flex_left">
            <div class="filter_flex">
                <div class="filter_flex_name">
                    <div class="filter_name">店舗名</div>
                    {!! Form::text('name', $name, ['class' => 'filter_name_input'] ) !!}
                </div>
                <div class="filter_flex_id">
                    <div class="filter_name">店舗ID</div>
                    {!! Form::text('id', $id, ['class' => 'filter_id_input'] ) !!}
                </div>
            </div>
            <div class="filter_name">住所</div>
            <div class="filter_flex">
                <div class="filter_flex_address_zip">
                    <div class="filter_name_address">郵便番号</div>
                    @if($errors->has('zip'))
                    <div class="comment_error">{{ $errors->first('zip') }}</div>
                    @endif
                    {{ Form::text('zip', $zip, ['class' => 'filter_zip_input', 'maxlength' => 8, 'placeholder' => '000-0000',
                        'onkeyup' => "AjaxZip3.zip2addr(this, '', 'pref', 'address')"]) }}
                </div>
                <div class="filter_flex_address_pref">
                    <div class="filter_name_address">都道府県</div>
                    <div id="pref_list_admin">
                        <select name="pref">
                        <option value="">指定なし</option>
                        @foreach (config('const.Prefs') as $name)
                        <option value="{{ $name }}" @if($name == $pref) selected @endif>{{ $name }}</option>
                        @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="filter_name_address">住所</div>
            @if($errors->has('address'))
            <div class="comment_error">{{ $errors->first('address') }}</div>
            @endif
            {{ Form::text('address', $address, ['class' => 'filter_address_input']) }}
        </div>

        <div class="filter_flex_center">
            <div class="filter_name">電話番号</div>
            {!! Form::text('tel' ,$tel, ['class' => 'filter_tel_input'] ) !!}
            <div class="filter_name">営業時間</div>
            <div class="filter_time">
                <select name="open">
                    @foreach (config('const.Times') as $key => $value)
                    <option value="{{ $key }}" @if($key == $open) selected @endif>{{ $value }}</option>
                    @endforeach
                </select>
                　～　
                <select name="close">
                    @foreach (config('const.Times') as $key => $value)
                    <option value="{{ $key }}" @if($key == $close) selected @endif>{{ $value }}</option>
                    @endforeach
                </select>
            </div>
            <div class="filter_name">評価</div>
            <div class="filter_fivestar">
                <select name="fivestar_before">
                    @foreach (config('const.Fivestar') as $key => $value)
                    <option value="{{ $key }}" @if($key === $fivestar_before_old) selected @endif>{{ $value }}</option>
                    @endforeach
                </select>
                　～　
                <select name="fivestar_after">
                    @foreach (config('const.Fivestar') as $key => $value)
                    <option value="{{ $key }}" @if($key === $fivestar_after_old) selected @endif>{{ $value }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="filter_flex_right">
            <div class="filter_name">登録日</div>
            <div class="filter_created">
                {!! Form::selectRange('created_year_before', 2020, 2040, $created_year_before, ['placeholder'=>'年']) !!}
                {!! Form::selectRange('created_month_before', 1, 12, $created_month_before, ['placeholder'=>'月']) !!}
                {!! Form::selectRange('created_day_before', 1, 31, $created_day_before, ['placeholder'=>'日']) !!}
                　～　
                {!! Form::selectRange('created_year_after', 2020, 2040, $created_year_after, ['placeholder'=>'年']) !!}
                {!! Form::selectRange('created_month_after', 1, 12, $created_month_after, ['placeholder'=>'月']) !!}
                {!! Form::selectRange('created_day_after', 1, 31, $created_day_after, ['placeholder'=>'日']) !!}
            </div>
            <div class="filter_name">更新日</div>
            <div class="filter_updated">
                {!! Form::selectRange('updated_year_before', 2020, 2040, $updated_year_before, ['placeholder'=>'年']) !!}
                {!! Form::selectRange('updated_month_before', 1, 12, $updated_month_before, ['placeholder'=>'月']) !!}
                {!! Form::selectRange('updated_day_before', 1, 31, $updated_day_before, ['placeholder'=>'日']) !!}
                　～　
                {!! Form::selectRange('updated_year_after', 2020, 2040, $updated_year_after, ['placeholder'=>'年']) !!}
                {!! Form::selectRange('updated_month_after', 1, 12, $updated_month_after, ['placeholder'=>'月']) !!}
                {!! Form::selectRange('updated_day_after', 1, 31, $updated_day_after, ['placeholder'=>'日']) !!}
            </div>
        </div>

        <div class="filter_flex_button">
            <div class="search_button">
                <a href="#" onclick="clickFilterButtonAdmin()">検索</a>
            </div>
            <div class="clear_button">
                <a href="#" onclick="clickClearButton()">クリア</a>
            </div>
            <div class="search_result_count">
            検索結果：{{ $restaurants->total() }}件が該当しました
            </div>
        </div>
    </div>
</form>
<script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
