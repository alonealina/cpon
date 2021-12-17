<div class="flexible-list-sidebar">
    <form id="form" name="filter_form" action="{{ route('filter') }}" method="get">
        <div class="filter_form_title">絞り込み</div>
        <hr>
        <div class="search_radio_list">
            <input type="radio" name="search_radio" class="search_radio" value="area" onchange="searchFormChange();"> 地域から探す<br>
            <div id="pref_list">
                <select name="pref">
                @foreach (config('const.Prefs') as $name)
                <option value="{{ $name }}">{{ $name }}</option>
                @endforeach
                </select>
            </div>
            <input type="radio" name="search_radio" class="search_radio" value="open_only" onchange="searchFormChange();"> OPENのみ<br>
            <input type="radio" name="search_radio" class="search_radio" value="4_or_more" onchange="searchFormChange();"> 高評価(4.0以上)<br>
        </div>

        <div class="filter_name">利用シーン</div>
        @include('form.scenes')

        <div class="filter_name">こだわり条件</div>
        @include('form.commitments')

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
        <div class="search_button">
        <a href="#" onclick="clickFilterButton()">検索</a>
        </div>
    </form>
</div>
