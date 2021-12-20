<div class="flexible-list-sidebar_ipad">
    <form id="form" name="filter_form_ipad" action="{{ route('filter') }}" method="get">
        <div class="filter_form_title_ipad">絞り込み</div>
        <input type="checkbox" class="filter_open_checkbox" id="sp01"><label for="sp01" class="filter_open_label"></label>
        <div class="filter_form_ipad">
            <hr>
            <div class="search_radio_list_ipad filter_flex_ipad_left">
                <input type="radio" name="search_radio_ipad" class="search_radio" value="area" onchange="searchFormChangeIpad();"> 地域から探す<br>
                <div id="pref_list_ipad">
                    <select name="pref">
                    @foreach (config('const.Prefs') as $name)
                    <option value="{{ $name }}">{{ $name }}</option>
                    @endforeach
                    </select>
                </div>
                <input type="radio" name="search_radio_ipad" class="search_radio" value="open_only" onchange="searchFormChangeIpad();"> OPENのみ<br>
                <input type="radio" name="search_radio_ipad" class="search_radio" value="4_or_more" onchange="searchFormChangeIpad();"> 高評価(4.0以上)<br>
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
                <div class="filter_name">キーワード</div>
                {!! Form::text('freeword' ,'', ['class' => 'filter_freeword', 'placeholder' => '入力してください'] ) !!}
                <div class="filter_name">オープン時間</div>
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
            </div>
            <div class="search_button">
            <a href="#" onclick="clickFilterButtonIpad()">検索</a>
            </div>
        </div>
    </form>
</div>
