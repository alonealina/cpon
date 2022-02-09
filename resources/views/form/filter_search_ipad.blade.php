<div class="flexible-list-sidebar_ipad">
    <form id="form" name="filter_form_ipad" action="{{ route('filter') }}" method="get">
        <div class="filter_form_title_ipad">詳細検索</div>
        <input type="checkbox" class="filter_open_checkbox" id="sp01"><label for="sp01" class="filter_open_label"><div></div></label>
        <div class="filter_form_ipad">
            <hr>
            <div class="search_radio_list_ipad filter_flex_ipad_left">
                <input type="checkbox" name="search_radio_ipad" class="search_radio" value="area" @if(isset($area)) checked @endif> 都道府県<br>
                <div id="pref_list_ipad">
                    <select name="pref">
                    @foreach (config('const.Prefs') as $name)
                    <option value="{{ $name }}" @if(isset($filter_pref) && $filter_pref == $name) selected @endif>{{ $name }}</option>
                    @endforeach
                    </select>
                </div>
                <input type="checkbox" name="search_radio_ipad" class="search_radio" value="open_only" @if(isset($open_only)) checked @endif> OPEN<br>
                <input type="checkbox" name="search_radio_ipad" class="search_radio" value="highly_rated" @if(isset($highly_rated)) checked @endif> 高評価<br>
            </div>
            <div class="filter_flex_ipad_right">
                <div class="filter_name">利用シーン</div>
                @include('form.scenes')
            </div>

            <div class="filter_flex_ipad_left">
                <div class="filter_name">こだわり条件</div>
                @include('form.commitments')
            </div>

            <div class="filter_flex_ipad_right">
                <div class="filter_name">カテゴリ</div>
                <select name="category_id" class="select_category">
                    <option>指定なし</option>
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @if(isset($filter_category_id) && $filter_category_id == $category->id) selected @endif >{{ $category->name }}</option>
                    @endforeach
                </select>
                <div class="filter_name">キーワード</div>
                {!! Form::text('freeword' ,isset($filter_freeword) ? $freeword : null, ['class' => 'filter_freeword', 'placeholder' => '入力してください'] ) !!}
                <div class="filter_name">オープン時間</div>
                <div class="filter_time">
                    <select name="open">
                        @foreach (config('const.Times') as $key => $value)
                        <option value="{{ $key }}" @if(isset($filter_open) && $filter_open == $value) selected @endif>{{ $value }}</option>
                        @endforeach
                    </select>
                    ～
                    <select name="close">
                        @foreach (config('const.Times') as $key => $value)
                        <option value="{{ $key }}" @if(isset($filter_close) && $filter_close == $value) selected @endif>{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="search_button">
            <a href="#" onclick="clickFilterButtonIpad()">検索</a>
            </div>
        </div>
    </form>
</div>
