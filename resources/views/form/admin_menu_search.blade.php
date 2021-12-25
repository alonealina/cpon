
<form id="form" name="filter_form" action="{{ route('admin.restaurant_menu_list', ['id' => $restaurant_id]) }}" method="get">
    <div class="filter_flex">
        <div class="filter_flex_left">


            <div class="filter_name">メニュー名</div>
            @if($errors->has('name'))
            <div class="comment_error">{{ $errors->first('name') }}</div>
            @endif
            {{ Form::text('name', $name, ['class' => 'filter_name_input']) }}


            <div class="filter_name">値段</div>
            {!! Form::text('price_before', $price_before, ['class' => 'filter_price_before_input'] ) !!}円
            　～　
            {!! Form::text('price_after', $price_after, ['class' => 'filter_price_after_input'] ) !!}円


            <div class="filter_name">ステータス</div>
            <div class="filter_status">
                <select name="status">
                    @foreach (config('const.StatusM') as $key => $value)
                    <option value="{{ $key }}" @if($key == $status) selected @endif>{{ $value }}</option>
                    @endforeach
                </select>
            </div>
        </div>


        <div class="filter_flex_right">
            <div class="filter_name">登録日</div>
            <div class="filter_created">
                {!! Form::selectRange('created_year_before', 2021, 2050, $created_year_before, ['placeholder'=>'年']) !!}
                {!! Form::selectRange('created_month_before', 1, 12, $created_month_before, ['placeholder'=>'月']) !!}
                {!! Form::selectRange('created_day_before', 1, 31, $created_day_before, ['placeholder'=>'日']) !!}
                　～　
                {!! Form::selectRange('created_year_after', 2021, 2050, $created_year_after, ['placeholder'=>'年']) !!}
                {!! Form::selectRange('created_month_after', 1, 12, $created_month_after, ['placeholder'=>'月']) !!}
                {!! Form::selectRange('created_day_after', 1, 31, $created_day_after, ['placeholder'=>'日']) !!}
            </div>
            <div class="filter_name">更新日</div>
            <div class="filter_updated">
                {!! Form::selectRange('updated_year_before', 2021, 2050, $updated_year_before, ['placeholder'=>'年']) !!}
                {!! Form::selectRange('updated_month_before', 1, 12, $updated_month_before, ['placeholder'=>'月']) !!}
                {!! Form::selectRange('updated_day_before', 1, 31, $updated_day_before, ['placeholder'=>'日']) !!}
                　～　
                {!! Form::selectRange('updated_year_after', 2021, 2050, $updated_year_after, ['placeholder'=>'年']) !!}
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
            検索結果：{{ $menus->total() }}件が該当しました
            </div>
        </div>
    </div>
</form>
<script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
