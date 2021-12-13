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
                <input type="checkbox" class="check_box" id="one_person_ipad" name="one_person"/>
                <label class="label" for="one_person_ipad">お一人様</label>
                <input type="checkbox" class="check_box" id="family_ipad" name="family"/>
                <label class="label" for="family_ipad">家族</label>
                <input type="checkbox" class="check_box" id="with_friend_ipad" name="with_friend"/>
                <label class="label" for="with_friend_ipad">友達と</label>
                <input type="checkbox" class="check_box" id="many_people_ipad" name="many_people"/>
                <label class="label" for="many_people_ipad">大人数</label>
                <input type="checkbox" class="check_box" id="kitty_party_ipad" name="kitty_party"/>
                <label class="label" for="kitty_party_ipad">女子会</label>
                <input type="checkbox" class="check_box" id="dating_ipad" name="dating"/>
                <label class="label" for="dating_ipad">デート</label>
                <input type="checkbox" class="check_box" id="joint_party_ipad" name="joint_party"/>
                <label class="label" for="joint_party_ipad">合コン</label>
                <input type="checkbox" class="check_box" id="reception_ipad" name="reception"/>
                <label class="label" for="reception_ipad">接待</label>
            </div>

            <div class="filter_flex_ipad_left">
                <div class="filter_name">こだわり条件</div>
                <input type="checkbox" class="check_box" id="all_eat_ipad" name="all_eat"/>
                <label class="label" for="all_eat_ipad">食べ放題</label>
                <input type="checkbox" class="check_box" id="all_drink_ipad" name="all_drink"/>
                <label class="label" for="all_drink_ipad">飲み放題</label>
                <input type="checkbox" class="check_box" id="private_room_ipad" name="private_room"/>
                <label class="label" for="private_room_ipad">個室</label>
                <input type="checkbox" class="check_box" id="net_booking_ipad" name="net_booking"/>
                <label class="label" for="net_booking_ipad">ネット予約可</label>
                <input type="checkbox" class="check_box" id="stylish_ipad" name="stylish"/>
                <label class="label" for="stylish_ipad">オシャレな空間</label>
                <input type="checkbox" class="check_box" id="sofa_ipad" name="sofa"/>
                <label class="label" for="sofa_ipad">ソファー席</label>
                <input type="checkbox" class="check_box" id="smoking_ipad" name="smoking"/>
                <label class="label" for="smoking_ipad">喫煙</label>
                <input type="checkbox" class="check_box" id="no_smoking_ipad" name="no_smoking"/>
                <label class="label" for="no_smoking_ipad">禁煙</label>
                <input type="checkbox" class="check_box" id="reserved_ipad" name="reserved"/>
                <label class="label" for="reserved_ipad">貸切可</label>
                <input type="checkbox" class="check_box" id="morning_ipad" name="morning"/>
                <label class="label" for="morning_ipad">モーニング</label>
                <input type="checkbox" class="check_box" id="lunch_ipad" name="lunch"/>
                <label class="label" for="lunch_ipad">ランチ</label>
                <input type="checkbox" class="check_box" id="dinner_ipad" name="dinner"/>
                <label class="label" for="dinner_ipad">ディナー</label>
                <input type="checkbox" class="check_box" id="clean_scenery_ipad" name="clean_scenery"/>
                <label class="label" for="clean_scenery_ipad">景色が綺麗</label>
                <input type="checkbox" class="check_box" id="card_ipad" name="card"/>
                <label class="label" for="card_ipad">カード可</label>
                <input type="checkbox" class="check_box" id="celebration_ipad" name="celebration"/>
                <label class="label" for="celebration_ipad">お祝い・サプライズ</label>
                <input type="checkbox" class="check_box" id="take_out_ipad" name="take_out"/>
                <label class="label" for="take_out_ipad">テイクアウト</label>
                <input type="checkbox" class="check_box" id="bring_in_ipad" name="bring_in"/>
                <label class="label" for="bring_in_ipad">持ち込み可</label>
                <input type="checkbox" class="check_box" id="karaoke_ipad" name="karaoke"/>
                <label class="label" for="karaoke_ipad">カラオケ</label>
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
            <a href="#" onclick="clickFilterButton()">検索</a>
            </div>
        </div>
    </form>
</div>
