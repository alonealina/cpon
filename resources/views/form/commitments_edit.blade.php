<input type="checkbox" class="check_box" id="all_eat" name="all_eat"
@if($commitment->all_eat) checked @endif />
<label class="label" for="all_eat">食べ放題</label>
<input type="checkbox" class="check_box" id="all_drink" name="all_drink"
@if($commitment->all_drink) checked @endif />
<label class="label" for="all_drink">飲み放題</label>
<input type="checkbox" class="check_box" id="private_room" name="private_room"
@if($commitment->private_room) checked @endif />
<label class="label" for="private_room">個室</label>
<input type="checkbox" class="check_box" id="net_booking" name="net_booking"
@if($commitment->net_booking) checked @endif />
<label class="label" for="net_booking">ネット予約可</label>
<input type="checkbox" class="check_box" id="stylish" name="stylish"
@if($commitment->stylish) checked @endif />
<label class="label" for="stylish">オシャレな空間</label>
<input type="checkbox" class="check_box" id="sofa" name="sofa"
@if($commitment->sofa) checked @endif />
<label class="label" for="sofa">ソファー席</label>
<input type="checkbox" class="check_box" id="smoking" name="smoking"
@if($commitment->smoking) checked @endif />
<label class="label" for="smoking">喫煙</label>
<input type="checkbox" class="check_box" id="no_smoking" name="no_smoking"
@if($commitment->no_smoking) checked @endif />
<label class="label" for="no_smoking">禁煙</label>
<input type="checkbox" class="check_box" id="reserved" name="reserved"
@if($commitment->reserved) checked @endif />
<label class="label" for="reserved">貸切可</label>
<input type="checkbox" class="check_box" id="morning" name="morning"
@if($commitment->morning) checked @endif />
<label class="label" for="morning">モーニング</label>
<input type="checkbox" class="check_box" id="lunch" name="lunch"
@if($commitment->lunch) checked @endif />
<label class="label" for="lunch">ランチ</label>
<input type="checkbox" class="check_box" id="dinner" name="dinner"
@if($commitment->dinner) checked @endif />
<label class="label" for="dinner">ディナー</label>
<input type="checkbox" class="check_box" id="clean_scenery" name="clean_scenery"
@if($commitment->clean_scenery) checked @endif />
<label class="label" for="clean_scenery">景色が綺麗</label>
<input type="checkbox" class="check_box" id="card" name="card"
@if($commitment->card) checked @endif />
<label class="label" for="card">カード可</label>
<input type="checkbox" class="check_box" id="celebration" name="celebration"
@if($commitment->celebration) checked @endif />
<label class="label" for="celebration">お祝い・サプライズ</label>
<input type="checkbox" class="check_box" id="take_out" name="take_out"
@if($commitment->take_out) checked @endif />
<label class="label" for="take_out">テイクアウト</label>
<input type="checkbox" class="check_box" id="bring_in" name="bring_in"
@if($commitment->bring_in) checked @endif />
<label class="label" for="bring_in">持ち込み可</label>
<input type="checkbox" class="check_box" id="karaoke" name="karaoke"
@if($commitment->karaoke) checked @endif />
<label class="label" for="karaoke">カラオケ</label>