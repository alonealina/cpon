<input type="checkbox" class="check_box" id="one_person" name="one_person"
@if($scene->one_person) checked @endif />
<label class="label" for="one_person">お一人様</label>
<input type="checkbox" class="check_box" id="family" name="family"
@if($scene->family) checked @endif />
<label class="label" for="family">家族</label>
<input type="checkbox" class="check_box" id="with_friend" name="with_friend"
@if($scene->with_friend) checked @endif />
<label class="label" for="with_friend">友達と</label>
<input type="checkbox" class="check_box" id="many_people" name="many_people"
@if($scene->many_people) checked @endif />
<label class="label" for="many_people">大人数</label>
<input type="checkbox" class="check_box" id="kitty_party" name="kitty_party"
@if($scene->kitty_party) checked @endif />
<label class="label" for="kitty_party">女子会</label>
<input type="checkbox" class="check_box" id="dating" name="dating"
@if($scene->dating) checked @endif />
<label class="label" for="dating">デート</label>
<input type="checkbox" class="check_box" id="joint_party" name="joint_party"
@if($scene->joint_party) checked @endif />
<label class="label" for="joint_party">合コン</label>
<input type="checkbox" class="check_box" id="reception" name="reception"
@if($scene->reception) checked @endif />
<label class="label" for="reception">接待</label>