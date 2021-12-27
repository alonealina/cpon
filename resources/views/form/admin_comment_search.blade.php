
<form id="form" name="filter_form" action="{{ route('admin.comment_list', ['id' => $restaurant_id]) }}" method="get">
    <div class="filter_flex">
        <div class="filter_flex_left">
            <div class="filter_flex">
                <div class="filter_flex_name">
                    <div class="filter_name">お名前</div>
                    {!! Form::text('user_name', $user_name, ['class' => 'filter_name_input'] ) !!}
                </div>
            </div>

            <div class="filter_name">評価</div>
            <div class="filter_fivestar">
                <select name="fivestar_before">
                    @foreach (config('const.Fivestar') as $key => $value)
                    <option value="{{ $key }}" @if($key == $fivestar_before_old) selected @endif>{{ $value }}</option>
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
                {!! Form::selectRange('created_year_before', 2021, 2050, $created_year_before, ['placeholder'=>'年']) !!}
                {!! Form::selectRange('created_month_before', 1, 12, $created_month_before, ['placeholder'=>'月']) !!}
                {!! Form::selectRange('created_day_before', 1, 31, $created_day_before, ['placeholder'=>'日']) !!}
                　～　
                {!! Form::selectRange('created_year_after', 2021, 2050, $created_year_after, ['placeholder'=>'年']) !!}
                {!! Form::selectRange('created_month_after', 1, 12, $created_month_after, ['placeholder'=>'月']) !!}
                {!! Form::selectRange('created_day_after', 1, 31, $created_day_after, ['placeholder'=>'日']) !!}
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
            検索結果：{{ $comments->total() }}件が該当しました
            </div>
        </div>
    </div>
</form>
<script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
