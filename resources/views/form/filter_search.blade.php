
<div class="filter_form_title">絞り込み</div>
<div class="flexible-list-sidebar">
    <form id="form" name="filter_form" action="{{ route('filter') }}" method="get">
        <div class="search_radio_list">
            <input type="checkbox" name="area" class="search_radio" value="area" @if(isset($area)) checked @endif> 都道府県<br>
            <div id="pref_list">
                <select name="pref">
                @foreach (config('const.Prefs') as $name)
                <option value="{{ $name }}" @if(isset($filter_pref) && $filter_pref == $name) selected @endif>{{ $name }}</option>
                @endforeach
                </select>
            </div>
            <input type="checkbox" name="open_only" class="search_radio" value="open_only" @if(isset($open_only)) checked @endif> OPEN<br>
            <input type="checkbox" name="highly_rated" class="search_radio" value="highly_rated" @if(isset($highly_rated)) checked @endif> 高評価<br>
        </div>

        <div class="filter_name">利用シーン</div>
        @include('form.scenes')

        <div class="filter_name">こだわり条件</div>
        @include('form.commitments')

        <div class="filter_name">キーワード</div>
        {!! Form::text('freeword' ,isset($filter_freeword) ? $freeword : null , ['class' => 'filter_freeword', 'placeholder' => '入力してください'] ) !!}
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
        <div class="search_button">
        <a href="#" onclick="clickFilterButton()">検索</a>
        </div>
    </form>
</div>
