<div class="number_select">
    <select class="number_select" name="sort" id="change_number">
        <option value="{{ route('admin.comment_list', [
            'id' => $restaurant_id,
            'number' => '10',
            'user_name' => $user_name,
            'fivestar_before' => $fivestar_before_old,
            'fivestar_after' => $fivestar_after_old,
            'created_year_before' => $created_year_before,
            'created_month_before' => $created_month_before,
            'created_day_before' => $created_day_before,
            'created_year_after' => $created_year_after,
            'created_month_after' => $created_month_after,
            'created_day_after' => $created_day_after,
            ]) }}"
        @if($number == "10") selected @endif>10件</option>
        <option value="{{ route('admin.comment_list',  [
            'id' => $restaurant_id,
            'number' => '50',
            'user_name' => $user_name,
            'fivestar_before' => $fivestar_before_old,
            'fivestar_after' => $fivestar_after_old,
            'created_year_before' => $created_year_before,
            'created_month_before' => $created_month_before,
            'created_day_before' => $created_day_before,
            'created_year_after' => $created_year_after,
            'created_month_after' => $created_month_after,
            'created_day_after' => $created_day_after,
            ]) }}"
        @if($number == "50") selected @endif>50件</option>
        <option value="{{ route('admin.comment_list',  [
            'id' => $restaurant_id,
            'number' => '100',
            'user_name' => $user_name,
            'fivestar_before' => $fivestar_before_old,
            'fivestar_after' => $fivestar_after_old,
            'created_year_before' => $created_year_before,
            'created_month_before' => $created_month_before,
            'created_day_before' => $created_day_before,
            'created_year_after' => $created_year_after,
            'created_month_after' => $created_month_after,
            'created_day_after' => $created_day_after,
            ]) }}"
        @if($number == "100") selected @endif>100件</option>
    </select>
</div>