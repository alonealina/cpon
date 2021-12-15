<div class="flexible-list-sidebar_sp">
    <form id="form" name="filter_form_ipad" action="{{ route('filter') }}" method="get">
        <div class="filter_form_title_ipad">絞り込み</div>
        <input type="checkbox" class="filter_open_checkbox" id="sp01"><label for="sp01" class="filter_open_label_sp"></label>
        <div class="filter_form_sp">
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
            <hr>
            <input type="checkbox" class="check_box" id="one_person" name="one_person"/>
            <label class="label" for="one_person">お一人様</label>
            <input type="checkbox" class="check_box" id="family" name="family"/>
            <label class="label" for="family">家族</label>
            <input type="checkbox" class="check_box" id="with_friend" name="with_friend"/>
            <label class="label" for="with_friend">友達と</label>
            <input type="checkbox" class="check_box" id="many_people" name="many_people"/>
            <label class="label" for="many_people">大人数</label>
            <input type="checkbox" class="check_box" id="kitty_party" name="kitty_party"/>
            <label class="label" for="kitty_party">女子会</label>
            <input type="checkbox" class="check_box" id="dating" name="dating"/>
            <label class="label" for="dating">デート</label>
            <input type="checkbox" class="check_box" id="joint_party" name="joint_party"/>
            <label class="label" for="joint_party">合コン</label>
            <input type="checkbox" class="check_box" id="reception" name="reception"/>
            <label class="label" for="reception">接待</label>
            <div class="filter_name">こだわり条件</div>
            <hr>
            <input type="checkbox" class="check_box" id="all_eat" name="all_eat"/>
            <label class="label" for="all_eat">食べ放題</label>
            <input type="checkbox" class="check_box" id="all_drink" name="all_drink"/>
            <label class="label" for="all_drink">飲み放題</label>
            <input type="checkbox" class="check_box" id="private_room" name="private_room"/>
            <label class="label" for="private_room">個室</label>
            <input type="checkbox" class="check_box" id="net_booking" name="net_booking"/>
            <label class="label" for="net_booking">ネット予約可</label>
            <input type="checkbox" class="check_box" id="stylish" name="stylish"/>
            <label class="label" for="stylish">オシャレな空間</label>
            <input type="checkbox" class="check_box" id="sofa" name="sofa"/>
            <label class="label" for="sofa">ソファー席</label>
            <input type="checkbox" class="check_box" id="smoking" name="smoking"/>
            <label class="label" for="smoking">喫煙</label>
            <input type="checkbox" class="check_box" id="no_smoking" name="no_smoking"/>
            <label class="label" for="no_smoking">禁煙</label>
            <input type="checkbox" class="check_box" id="reserved" name="reserved"/>
            <label class="label" for="reserved">貸切可</label>
            <input type="checkbox" class="check_box" id="morning" name="morning"/>
            <label class="label" for="morning">モーニング</label>
            <input type="checkbox" class="check_box" id="lunch" name="lunch"/>
            <label class="label" for="lunch">ランチ</label>
            <input type="checkbox" class="check_box" id="dinner" name="dinner"/>
            <label class="label" for="dinner">ディナー</label>
            <input type="checkbox" class="check_box" id="clean_scenery" name="clean_scenery"/>
            <label class="label" for="clean_scenery">景色が綺麗</label>
            <input type="checkbox" class="check_box" id="card" name="card"/>
            <label class="label" for="card">カード可</label>
            <input type="checkbox" class="check_box" id="celebration" name="celebration"/>
            <label class="label" for="celebration">お祝い・サプライズ</label>
            <input type="checkbox" class="check_box" id="take_out" name="take_out"/>
            <label class="label" for="take_out">テイクアウト</label>
            <input type="checkbox" class="check_box" id="bring_in" name="bring_in"/>
            <label class="label" for="bring_in">持ち込み可</label>
            <input type="checkbox" class="check_box" id="karaoke" name="karaoke"/>
            <label class="label" for="karaoke">カラオケ</label>
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
