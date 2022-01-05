<div class="flexible-list-sidebar_sp">
    <form id="form" name="filter_form_ipad" action="{{ route('filter') }}" method="get">
        <div class="filter_form_title_ipad">絞り込み</div>
        <input type="checkbox" class="filter_open_checkbox" id="sp01"><label for="sp01" class="filter_open_label_sp" style="border:none;"></label>
        <div class="filter_form_sp">
            <hr>
            <div class="search_radio_list">
                <input type="checkbox" name="search_radio" class="search_radio" value="area"> 都道府県
                <input type="checkbox" name="search_radio" class="search_radio" value="open_only"> OPEN
                <input type="checkbox" name="search_radio" class="search_radio" value="highly_rated"> 高評価
                <div id="pref_list">
                    <select name="pref">
                    @foreach (config('const.Prefs') as $name)
                    <option value="{{ $name }}">{{ $name }}</option>
                    @endforeach
                    </select>
                </div>
            </div>
            <div class="filter_name">利用シーン</div>
            <hr>
            @include('form.scenes')
            <div class="filter_name">こだわり条件</div>
            <hr>
            @include('form.commitments')
            <div class="filter_name">カテゴリ</div>
            <hr>
            <select name="category_id" class="select_category">
                <option>指定なし</option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}" @if(isset($filter_category_id) && $filter_category_id == $category->id) selected @endif >{{ $category->name }}</option>
                @endforeach
            </select>
            <div class="filter_name">キーワード</div>
            <hr>
            {!! Form::text('freeword' ,'', ['class' => 'filter_freeword', 'placeholder' => '入力してください'] ) !!}
            <div class="filter_name">オープン時間</div>
            <hr>
            <div class="filter_time">
                <select name="open">
                    @foreach (config('const.Times') as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>
                ～
                <select name="close">
                    @foreach (config('const.Times') as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>
            </div>
            <div class="search_button">
            <a href="#" onclick="clickFilterButton()">検索</a>
            </div>
        </div>
    </form>
</div>
