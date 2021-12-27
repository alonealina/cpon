<input type="hidden" name="holidays[monday]" value="0">
<input type="checkbox" class="check_box check_box_holidays" id="monday" name="holidays[monday]" value="1"
@if(old('holidays.monday') == 1) checked @endif />
<label class="label" for="monday">月曜日</label>
<input type="hidden" name="holidays[tuesday]" value="0">
<input type="checkbox" class="check_box check_box_holidays" id="tuesday" name="holidays[tuesday]" value="1"
@if(old('holidays.tuesday') == 1) checked @endif />
<label class="label" for="tuesday">火曜日</label>
<input type="hidden" name="holidays[wednesday]" value="0">
<input type="checkbox" class="check_box check_box_holidays" id="wednesday" name="holidays[wednesday]" value="1"
@if(old('holidays.wednesday') == 1) checked @endif />
<label class="label" for="wednesday">水曜日</label>
<input type="hidden" name="holidays[thursday]" value="0">
<input type="checkbox" class="check_box check_box_holidays" id="thursday" name="holidays[thursday]" value="1"
@if(old('holidays.thursday') == 1) checked @endif />
<label class="label" for="thursday">木曜日</label>
<input type="hidden" name="holidays[friday]" value="0">
<input type="checkbox" class="check_box check_box_holidays" id="friday" name="holidays[friday]" value="1"
@if(old('holidays.friday') == 1) checked @endif />
<label class="label" for="friday">金曜日</label>
<input type="hidden" name="holidays[saturday]" value="0">
<input type="checkbox" class="check_box check_box_holidays" id="saturday" name="holidays[saturday]" value="1"
@if(old('holidays.saturday') == 1) checked @endif />
<label class="label" for="saturday">土曜日</label>
<input type="hidden" name="holidays[sunday]" value="0">
<input type="checkbox" class="check_box check_box_holidays" id="sunday" name="holidays[sunday]" value="1"
@if(old('holidays.sunday') == 1) checked @endif />
<label class="label" for="sunday">日曜日</label>
<input type="hidden" name="holidays[none]" value="0">
<input type="checkbox" class="check_box" id="none" name="holidays[none]" value="1"
@if(old('holidays.none') == 1) checked @endif />
<label class="label" for="none">定休日なし</label>
